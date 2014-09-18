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

namespace Eye4webZfcUserWarningsTest\Eye4web\ZfcUser\Warnings\Factory\View\Helper;


use Eye4web\ZfcUser\Warnings\Factory\View\Helper\ZfcUserDisplayNameByUserIdFactory;

class ZfcUserDisplayNameByUserIdFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $factory;

    protected $serviceLocator;

    public function setUp()
    {
        $this->serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $this->factory = new ZfcUserDisplayNameByUserIdFactory();
    }

    public function testCreateService()
    {
        $viewHelperManager = $this->getMockBuilder('Zend\View\HelperPluginManager')
            ->disableOriginalConstructor()
            ->getMock();
        $viewHelperManager->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($this->serviceLocator));

        $mapper = $this->getMockBuilder('ZfcUser\Mapper\UserInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceLocator->expects($this->once())
            ->method('get')
            ->with('zfcuser_user_mapper')
            ->will($this->returnValue($mapper));

        $result = $this->factory->createService($viewHelperManager);

        $this->assertInstanceOf('Eye4web\ZfcUser\Warnings\View\Helper\ZfcUserDisplayNameByUserId', $result);
    }
}
