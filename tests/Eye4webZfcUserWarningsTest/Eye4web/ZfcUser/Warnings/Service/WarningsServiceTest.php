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

namespace Eye4webZfcUserWarningsTest\Eye4web\ZfcUser\Warnings\Service;

use Eye4web\ZfcUser\Warnings\Service\WarningsService;

class WarningsServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $mapper;

    protected $service;

    public function setUp()
    {
        $this->mapper = $this->getMockBuilder('Eye4web\ZfcUser\Warnings\Mapper\MapperInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new WarningsService($this->mapper);
    }

    public function testAddWarning()
    {
        $warning = $this->getMock('Eye4web\ZfcUser\Warnings\Entity\WarningInterface');

        $this->mapper->expects($this->once())
            ->method('addWarning')
            ->with($warning);

        $this->service->addWarning($warning);
    }

    public function testGetWarning()
    {
        $id = 1;

        $this->mapper->expects($this->once())
            ->method('getWarning')
            ->with($id);

        $this->service->getWarning($id);
    }

    public function testGetUserWarnings()
    {
        $user = $this->getMock('ZfcUser\Entity\UserInterface');

        $this->mapper->expects($this->once())
            ->method('getUserWarnings')
            ->with($user);

        $this->service->getUserWarnings($user);
    }
}
