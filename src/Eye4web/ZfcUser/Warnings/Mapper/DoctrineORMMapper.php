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

namespace Eye4web\ZfcUser\Warnings\Mapper;

use Doctrine\Common\Persistence\ObjectManager;
use Eye4web\ZfcUser\Warnings\Entity\WarningInterface;
use ZfcUser\Entity\UserInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class DoctrineORMMapper implements MapperInterface, EventManagerAwareInterface
{
    use EventManagerAwareTrait;
    /** @var \Doctrine\ORM\EntityManager */
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function addWarning(WarningInterface $warning, $flush = true)
    {
        $this->getEventManager()->trigger('addWarning.pre', $this, array('warning' => $warning));

        $this->objectManager->persist($warning);
        if ($flush) {
            $this->objectManager->flush();
        }

        $this->getEventManager()->trigger('addWarning.post', $this, array('warning' => $warning));

        return $warning;
    }

    public function getUserWarnings(UserInterface $user)
    {
        $repository = $this->objectManager->getRepository("Eye4web\ZfcUser\Warnings\Entity\Warning");

        return $repository->findByUser($user->getId());
    }

    public function getWarning($id)
    {
        $warning = $this->objectManager->find("Eye4web\ZfcUser\Warnings\Entity\Warning", $id);

        return $warning;
    }
}
