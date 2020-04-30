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

use HellFirePvP\Bundle\DTOGeneratorBundle\DependencyInjection\DTOGeneratorExtension;
use HellFirePvP\Bundle\DTOGeneratorBundle\DTO\DTOFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ResolveChildDefinitionsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class ContainerTestCase extends TestCase
{

    /**
     * Creates a Container with default configurations to run tests with
     *
     * @return ContainerBuilder
     */
    public function createContainer(): ContainerBuilder
    {
        $container = new ContainerBuilder(new ParameterBag([
            'kernel.name' => 'app',
            'kernel.debug' => false,
            'kernel.bundles' => [],
            'kernel.bundles_metadata' => [],
            'kernel.cache_dir' => dirname(__DIR__) . '/var/cache',
            'kernel.environment' => 'test',
            'kernel.root_dir' => dirname(__DIR__),
            'kernel.project_dir' => dirname(__DIR__),
            'container.build_id' => uniqid(),
        ]));

        $extension = new DTOGeneratorExtension();
        $container->registerExtension($extension);
        $extension->load([
            [
                'auto_loader_reference' => '%kernel.project_dir%/vendor/autoload.php',
                'dto_directory' => '%kernel.cache_dir%/dto-generator/dto',
                'dto_namespace' => 'DTOGenerator\\Generated\\'
            ]
        ], $container);

        $container->getCompilerPassConfig()->setOptimizationPasses([new ResolveChildDefinitionsPass()]);
        $container->getCompilerPassConfig()->setRemovingPasses([]);
        $container->addCompilerPass(new PublicAllCompilerPass());

        $container->compile();

        return $container;
    }

    /**
     * Enables DTO autoloading for Tests for the given DTO Factory
     *
     * @param DTOFactory $factory
     */
    public function enableDTOAutoload(DTOFactory $factory)
    {
        $autoloader = require dirname(__DIR__) . '/vendor/autoload.php';
        $autoloader->setPsr4($factory->getDtoNamespace(), [$factory->getDtoDirectory()]);
    }
}

class PublicAllCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        foreach ($container->getDefinitions() as $id => $definition) {
            if (strpos($id, 'dtogenerator') === false) {
                continue;
            }

            $definition->setPublic(true);
        }

        foreach ($container->getAliases() as $id => $alias) {
            if (strpos($id, 'dtogenerator') === false) {
                continue;
            }

            $alias->setPublic(true);
        }
    }
}
