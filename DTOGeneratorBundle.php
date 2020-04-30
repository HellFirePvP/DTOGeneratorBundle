<?php
/**
 * This file is part of the DTO Generator Bundle.
 *
 * (c) HellFirePvP <dev.hellfire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HellFirePvP\Bundle\DTOGeneratorBundle;

use Composer\Autoload\ClassLoader;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DTOGeneratorBundle extends Bundle
{

    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        /** @var string $dtoNamespace */
        $dtoNamespace = $this->container->getParameter('dto_generator.dto_namespace');
        /** @var string $dtoDirectory */
        $dtoDirectory = $this->container->getParameter('dto_generator.dto_directory');

        /** @var ClassLoader $autoLoader */
        $autoLoader = require $this->container->getParameter('dto_generator.auto_loader_reference');
        $autoLoader->setPsr4($dtoNamespace, [$dtoDirectory]);
    }
}
