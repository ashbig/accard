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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Accard core configuration.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('accard_core');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->cannotBeOverwritten()->isRequired()->cannotBeEmpty()->end()
            ->end()
        ;

        $this->addClassesSection($rootNode);
        //$this->addEmailsSection($rootNode);
        //$this->addRoutingSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds `classes` section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('diagnosis_phase')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Accard\Component\Core\Model\DiagnosisPhase')->end()
                                ->scalarNode('controller')->defaultValue('Accard\Bundle\ResourceBundle\Controller\ResourceController')->end()
                                ->scalarNode('form')->defaultValue('Accard\Bundle\CoreBundle\Form\Type\DiagnosisPhaseType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('import_patient')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Accard\Component\Core\Model\ImportPatient')->end()
                                ->scalarNode('controller')->defaultValue('Accard\Bundle\ResourceBundle\Controller\ResourceController')->end()
                                ->scalarNode('repository')->defaultValue('Accard\Bundle\CoreBundle\Doctrine\ORM\ImportPatientRepository')->end()
                                ->scalarNode('form')->defaultValue('Accard\Bundle\CoreBundle\Form\Type\ImportPatientType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('patient_phase')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Accard\Component\Core\Model\PatientPhase')->end()
                                ->scalarNode('controller')->defaultValue('Accard\Bundle\ResourceBundle\Controller\ResourceController')->end()
                                ->scalarNode('form')->defaultValue('Accard\Bundle\CoreBundle\Form\Type\PatientPhaseType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('user')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Accard\Component\Core\Model\User')->end()
                                ->scalarNode('controller')->defaultValue('Accard\Bundle\ResourceBundle\Controller\ResourceController')->end()
                                ->scalarNode('form')->defaultValue('Accard\Bundle\CoreBundle\Form\Type\UserType')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * Adds routing section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addRoutingSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('route_collection_limit')->defaultValue(0)->info('Limit the number of routes that are fetched when getting a collection, set to false to disable the limit.')->end()
                ->scalarNode('route_uri_filter_regexp')->defaultValue('')->info('Regular expression filter which is used to skip the Accard dynamic router for any request URI that matches.')->end()
                ->arrayNode('routing')->isRequired()->cannotBeEmpty()
                    ->info('Classes for which routes should be generated.')
                    ->useAttributeAsKey('class_name')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('field')->isRequired()->cannotBeEmpty()->info('Field representing the URI path.')->end()
                        ->scalarNode('prefix')->defaultValue('')->info('Prefix applied to all routes.')->end()
                        ->arrayNode('defaults')->isRequired()->cannotBeEmpty()->info('Defaults to add to the generated route.')
                            ->prototype('variable')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
