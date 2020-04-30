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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dto_generator');
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('auto_loader_reference')->defaultValue('%kernel.project_dir%/vendor/autoload.php')->end()
                ->scalarNode('dto_directory')->defaultValue('%kernel.cache_dir%/dto-generator/dto')->end()
                ->scalarNode('dto_namespace')->defaultValue('DTOGenerator\\Generated\\')->end()
            ->end();

        return $treeBuilder;
    }
}
