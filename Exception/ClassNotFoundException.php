<?php
/**
 * This file is part of the DTO Generator Bundle.
 *
 * (c) HellFirePvP <dev.hellfire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HellFirePvP\Bundle\DTOGeneratorBundle\Exception;

use RuntimeException;

/**
 * Exception to inform that a class that was expected to exist as it was passed into the generator was not found.
 *
 * @author HellFirePvP <dev.hellfire@gmail.com>
 */
class ClassNotFoundException extends RuntimeException
{

}
