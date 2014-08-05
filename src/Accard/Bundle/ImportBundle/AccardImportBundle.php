<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Accard\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Accard\Bundle\ImportBundle\DependencyInjection\Compiler\RegisterImporterPass;
use Accard\Bundle\ResourceBundle\AccardResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Accard import bundle.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class AccardImportBundle extends Bundle
{
    /**
     * Return array with currently supported drivers.
     *
     * @return array
     */
    public static function getSupportedDrivers()
    {
        return array(
            AccardResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'Accard\Bundle\ImportBundle\Model\ImportInterface' => 'accard.model.import.class',
            'Accard\Bundle\ImportBundle\Model\RecordInterface' => 'accard.model.record.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('accard_import', $interfaces));
        //$container->addCompilerPass(new RegisterImporterPass());

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Accard\Bundle\ImportBundle\Model',
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings,
                array('doctrine.orm.entity_manager'),
                'accard_import.driver.doctrine/orm'
            )
        );
    }
}
