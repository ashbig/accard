<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\CoreBundle\DependencyInjection;

use Accard\Bundle\ResourceBundle\DependencyInjection\AbstractResourceExtension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Accard core bundle extension.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class AccardCoreExtension extends AbstractResourceExtension implements PrependExtensionInterface
{
    /**
     * @var array
     */
    protected $bundles = array(
        'accard_settings',
        'accard_field',
        'accard_option',
        'accard_patient',
        'accard_diagnosis',
        'accard_phase',
        'accard_import',
    );

    /**
     * Configuration files to load.
     *
     * @var array
     */
    protected $configFiles = array('services', 'settings', 'import');


    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        list($config, $loader) = $this->configure($config, new Configuration(), $container, self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS);
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));

        foreach ($container->getExtensions() as $name => $extension) {
            if (in_array($name, $this->bundles)) {
                $container->prependExtensionConfig($name, array('driver' => $config['driver']));
            }
        }

        //$routeClasses = $controllerByClasses = $accardByClasses = array();
        //foreach ($config['routing'] as $className => $routeConfig) {
        //    $routeClasses[$className] = array(
        //        'field' => $routeConfig['field'],
        //        'prefix' => $routeConfig['prefix'],
        //    );
        //    $controllerByClasses[$className] = $routeConfig['defaults']['controller'];
        //    $accardByClasses[$className] = $routeConfig['defaults']['accard'];
        //}
        //
        //$container->setParameter('accard.route_classes', $routeClasses);
        //$container->setParameter('accard.controller_by_classes', $controllerByClasses);
        //$container->setParameter('accard.accard_by_classes', $accardByClasses);
        //$container->setParameter('accard.route_collection_limit', $config['route_collection_limit']);
        //$container->setParameter('accard.route_uri_filter_regexp', $config['route_uri_filter_regexp']);
    }
}
