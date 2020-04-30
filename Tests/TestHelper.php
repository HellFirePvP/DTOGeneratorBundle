<?php
/**
 * This file is part of the DTO Generator Bundle.
 *
 * (c) HellFirePvP <dev.hellfire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HellFirePvP\Bundle\DTOGeneratorBundle\Tests;

use HellFirePvP\Bundle\DTOGeneratorBundle\DTO\DTOFactory;

class TestHelper
{

    /**
     * @return DTOFactory
     */
    public static function createTestFactory(): DTOFactory
    {
        $dtoDirectory = $_ENV['PROJECT_ROOT_DIR'] . '/.test/dto';
        $dtoNamespace = 'DTOGenerator\\Generated\\';

        return new DTOFactory($dtoDirectory, $dtoNamespace);
    }

}
