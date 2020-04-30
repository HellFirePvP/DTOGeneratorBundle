<?php
/**
 * This file is part of the DTO Generator Bundle.
 *
 * (c) HellFirePvP <dev.hellfire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HellFirePvP\Bundle\DTOGeneratorBundle\Tests\DTO;

use HellFirePvP\Bundle\DTOGeneratorBundle\DTO\DTOFactory;
use HellFirePvP\Bundle\DTOGeneratorBundle\Tests\ContainerTestCase;

class TestClassGenerator extends ContainerTestCase
{

    public function testGenerateClass()
    {
        $container = $this->createContainer();

        /** @var DTOFactory $factory */
        $factory = $container->get('dtogenerator.factory');
        $this->enableDTOAutoload($factory);

        $dtobject = $factory->createDTO(TestDTOPerson::class);
        self::assertNotNull($dtobject);
    }

}
