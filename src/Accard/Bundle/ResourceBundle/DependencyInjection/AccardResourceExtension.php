<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Accard\Bundle\ResourceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Accard\Bundle\ResourceBundle\DependencyInjection\Driver\DatabaseDriverFactory;

/**
 * Resource system extension.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class AccardResourceExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('twig.yml');

        $classes = isset($config['resources']) ? $config['resources'] : array();

        $this->createResourceServices($classes, $container);

        if ($container->hasParameter('accard.config.classes')) {
            $classes = array_merge($classes, $container->getParameter('accard.config.classes'));
        }

        $container->setParameter('accard.config.classes', $classes);
    }

    /**
     * Creates resources from defined service definitions.
     *
     * @param array $resources
     * @param ContainerBuilder $container
     */
    private function createResourceServices(array $resources, ContainerBuilder $container)
    {
        foreach ($resources as $resource => $config) {
            list($prefix, $resourceName) = explode('.', $resource);

            DatabaseDriverFactory::get(
                $config['driver'],
                $container,
                $prefix,
                $resourceName,
                array_key_exists('templates', $config) ? $config['templates'] : null
            )->load($config['classes']);
        }
    }
}
