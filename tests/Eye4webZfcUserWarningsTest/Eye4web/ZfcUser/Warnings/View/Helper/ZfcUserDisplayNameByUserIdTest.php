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

namespace Eye4webZfcUserWarningsTest\Eye4web\ZfcUser\Warnings\View\Helper;


use Eye4web\ZfcUser\Warnings\View\Helper\ZfcUserDisplayNameByUserId;

class ZfcUserDisplayNameByUserIdTest extends \PHPUnit_Framework_TestCase
{
    protected $mapper;

    protected $helper;

    public function setUp()
    {
        $this->mapper = $this->getMockBuilder('ZfcUser\Mapper\UserInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->helper = new ZfcUserDisplayNameByUserId($this->mapper);
    }

    public function testInvoke()
    {
        $id = 1;
        $name = 'Display Name';

        $user = $this->getMock('ZfcUser\Entity\UserInterface');
        $user->expects($this->once())
            ->method('getDisplayName')
            ->will($this->returnValue($name));

        $this->mapper->expects($this->once())
            ->method('findById')
            ->with($id)
            ->will($this->returnValue($user));

        $result = $this->helper->__invoke($id);

        $this->assertSame($name, $result);
    }
}
