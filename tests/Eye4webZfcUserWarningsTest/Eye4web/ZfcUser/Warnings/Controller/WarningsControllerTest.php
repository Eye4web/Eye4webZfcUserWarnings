<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Eye4webZfcUserWarningsTest\Eye4web\ZfcUser\Warnings\Controller;

use Eye4web\ZfcUser\Warnings\Controller\WarningsController;

class WarningsControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $authService;

    protected $controller;

    protected $pluginManager;

    protected $pluginManagerPlugins = array();

    protected $redirectPlugin;

    protected $warningsService;

    public function setUp()
    {
        $this->authService = $this->getMock('Zend\Authentication\AuthenticationServiceInterface');
        $this->pluginManagerPlugins['zfcUserAuthentication'] = $this->authService;

        $this->redirectPlugin = $this->pluginManager = $this->getMock('Zend\Mvc\Controller\Plugin\Redirect');
        $this->pluginManagerPlugins['redirect'] = $this->redirectPlugin;

        $this->pluginManager = $this->getMock('Zend\Mvc\Controller\PluginManager');
        $this->pluginManager->expects($this->any())
            ->method('get')
            ->will($this->returnCallback(array($this, 'helperMockCallbackPluginManagerGet')));

        $this->warningsService = $this->getMockBuilder('Eye4web\ZfcUser\Warnings\Service\WarningsService')
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new WarningsController($this->warningsService);
        $this->controller->setPluginManager($this->pluginManager);
    }

    public function testConstruct()
    {
        $this->controller->__construct($this->warningsService);

        $class = new \ReflectionClass("Eye4web\ZfcUser\Warnings\Controller\WarningsController");
        $property = $class->getProperty("warningsService");
        $property->setAccessible(true);

        $this->assertSame($this->warningsService, $property->getValue($this->controller));
    }

    public function testUserWarningsActionNotLoggedIn()
    {
        $this->authService->expects($this->once())
            ->method('hasIdentity')
            ->will($this->returnValue(false));

        $response = $this->getMock('Zend\Stdlib\ResponseInterface');

        $this->redirectPlugin->expects($this->once())
            ->method('toRoute')
            ->with('zfcuser/login')
            ->will($this->returnValue($response));

        $result = $this->controller->userWarningsAction();

        $this->assertSame($response, $result);
    }

    public function testUserWarningsActionLoggedIn()
    {
        $this->authService->expects($this->once())
            ->method('hasIdentity')
            ->will($this->returnValue(true));

        $user = $this->getMock('ZfcUser\Entity\User');

        $this->authService->expects($this->once())
            ->method('getIdentity')
            ->will($this->returnValue($user));

        $warnings = ['warnings'];

        $this->warningsService->expects($this->once())
            ->method('getUserWarnings')
            ->with($user)
            ->will($this->returnValue($warnings));

        $result = $this->controller->userWarningsAction();

        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
        $this->assertSame($warnings, $result->warnings);
    }

    public function helperMockCallbackPluginManagerGet($key)
    {
        return (array_key_exists($key, $this->pluginManagerPlugins))
            ? $this->pluginManagerPlugins[$key]
            : null;
    }
}
