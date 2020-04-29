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

use HellFirePvP\Bundle\DTOGeneratorBundle\DTO\Generator\ClassGenerator;
use PHPUnit\Framework\TestCase;

class TestClassGenerator extends TestCase
{

    public function testGenerateClass()
    {
        $refClass = new \ReflectionClass(TestDTOPerson::class);
        $gen = new ClassGenerator('./test-classes/DTO/', 'DTO_Test');

        $gen->generateDTOFile($refClass, $gen->getDTOClassFileName($refClass));
    }

}
