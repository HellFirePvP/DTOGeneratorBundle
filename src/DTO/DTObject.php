<?php
/**
 * This file is part of the DTO Generator Bundle.
 *
 * (c) HellFirePvP <dev.hellfire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HellFirePvP\Bundle\DTOGeneratorBundle\DTO;

/**
 * The base object any generated DTO will/should subclass from.
 *
 * @author HellFirePvP <dev.hellfire@gmail.com>
 */
abstract class DTObject
{

    /**
     * Get the actual class this DTO represents.
     *
     * @return string
     */
    public abstract function getObjectClass(): string;

    /**
     * Convert the DTO into its actual object.
     *
     * @return object
     */
    public function createObject(): object
    {
        return DTOFactory::createObject($this->getObjectClass(), $this);
    }
}
