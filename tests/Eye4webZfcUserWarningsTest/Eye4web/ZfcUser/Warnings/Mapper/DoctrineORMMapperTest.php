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

namespace Eye4webZfcUserWarningsTest\Eye4web\ZfcUser\Warnings\Mapper;


use Eye4web\ZfcUser\Warnings\Mapper\DoctrineORMMapper;

class DoctrineORMMapperTest extends \PHPUnit_Framework_TestCase
{
    protected $mapper;

    protected $objectManager;

    public function setUp()
    {
        $this->objectManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new DoctrineORMMapper($this->objectManager);
    }

    public function testAddWarningWithFlush()
    {
        $warning = $this->getMock('Eye4web\ZfcUser\Warnings\Entity\WarningInterface');

        $this->objectManager->expects($this->once())
            ->method('persist')
            ->with($warning);

        $this->objectManager->expects($this->once())
            ->method('flush');

        $result = $this->mapper->addWarning($warning, true);

        $this->assertSame($result, $warning);
    }

    public function testAddWarningWithoutFlush()
    {
        $warning = $this->getMock('Eye4web\ZfcUser\Warnings\Entity\WarningInterface');

        $this->objectManager->expects($this->once())
            ->method('persist')
            ->with($warning);

        $this->objectManager->expects($this->never())
            ->method('flush');

        $result = $this->mapper->addWarning($warning, false);

        $this->assertSame($result, $warning);
    }

    public function testGetUserWarnings()
    {
        $userId = 1;
        $user = $this->getMock('ZfcUser\Entity\UserInterface');
        $user->expects($this->once())
            ->method('getId')
            ->will($this->returnValue($userId));

        $warnings = ['warnings'];

        $repository = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->setMethods(array('findByUser'))
            ->getMock();
        $repository->expects($this->once())
            ->method('findByUser')
            ->with($userId)
            ->will($this->returnValue($warnings));

        $this->objectManager->expects($this->once())
            ->method('getRepository')
            ->with('Eye4web\ZfcUser\Warnings\Entity\Warning')
            ->will($this->returnValue($repository));

        $result = $this->mapper->getUserWarnings($user);

        $this->assertSame($warnings, $result);
    }

    public function testGetWarning()
    {
        $id = 1;

        $warning = $this->getMock('Eye4web\ZfcUser\Warnings\Entity\WarningInterface');

        $this->objectManager->expects($this->once())
            ->method('find')
            ->with("Eye4web\ZfcUser\Warnings\Entity\Warning", $id)
            ->will($this->returnValue($warning));

        $result = $this->mapper->getWarning($id);
        $this->assertSame($warning, $result);
    }
}
