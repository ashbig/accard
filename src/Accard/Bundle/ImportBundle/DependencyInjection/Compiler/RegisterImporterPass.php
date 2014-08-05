<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Registers all importers.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class RegisterImporterPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('accard.import.importer_registry')) {
            return;
        }

        $registry = $container->getDefinition('accard.import.importer_registry');

        foreach ($container->findTaggedServiceIds('accard.importer') as $id => $attributes) {
            $registry->addMethodCall('registerImporter', array(new Reference($id)));
        }
    }
}
