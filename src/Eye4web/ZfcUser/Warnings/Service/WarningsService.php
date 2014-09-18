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

namespace Eye4web\ZfcUser\Warnings\Service;

use Eye4web\ZfcUser\Warnings\Entity\WarningInterface;
use Eye4web\ZfcUser\Warnings\Mapper\MapperInterface;
use ZfcUser\Entity\UserInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class WarningsService implements WarningsServiceInterface, EventManagerAwareInterface
{
    use EventManagerAwareTrait;
    /**
     * @var MapperInterface
     */
    protected $mapper;

    public function __construct(MapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function addWarning(WarningInterface $warning)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('warning' => $warning));
        $this->mapper->addWarning($warning);
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('warning' => $warning));
    }

    public function getWarning($id)
    {
        return $this->mapper->getWarning($id);
    }

    public function getUserWarnings(UserInterface $user)
    {
        return $this->mapper->getUserWarnings($user);
    }
}
