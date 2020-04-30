<?php
/**
 * This file is part of the DTO Generator Bundle.
 *
 * (c) HellFirePvP <dev.hellfire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HellFirePvP\Bundle\DTOGeneratorBundle\DependencyInjection;

use HellFirePvP\Bundle\DTOGeneratorBundle\DTO\DTOFactory;
use HellFirePvP\Bundle\DTOGeneratorBundle\DTO\Generator\ClassGenerator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Reference;

class DTOGeneratorExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);

        $container
            ->setDefinition('dtogenerator.factory', new Definition(DTOFactory::class))
            ->setArguments([
                $config['dto_directory'],
                $config['dto_namespace']
            ]);
    }
}
