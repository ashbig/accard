<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ResourceBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Events;

/**
 * Doctrine listener used to manipulate mappings.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class LoadORMMetadataSubscriber implements EventSubscriber
{
    /**
     * @var array
     */
    protected $classes;

    /**
     * @var array
     */
    protected $inheritance;

    /**
     * Constructor
     *
     * @param array $classes
     */
    public function __construct($classes, $inheritance)
    {
        $this->classes = $classes;
        $this->inheritance = $inheritance;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var ClassMetadata $metadata */
        $metadata = $eventArgs->getClassMetadata();
        $configuration = $eventArgs->getEntityManager()->getConfiguration();

        $this->setSuperclassStatus($metadata);
        $this->setCustomRepositoryClasses($metadata);

        if (!$metadata->isMappedSuperclass) {
            $this->setAssociationMappings($metadata, $configuration);
            if ($hasInheritance = $this->hasInheritanceMappings($metadata)) {
                $this->setInheritanceMappings($hasInheritance, $metadata, $configuration);
            }
        } else {
            $this->unsetAssociationMappings($metadata);
        }
    }

    private function setSuperclassStatus(ClassMetadataInfo $metadata)
    {
        foreach ($this->classes as $class) {
            if ($class['model'] === $metadata->getName()) {
                $metadata->isMappedSuperclass = false;
            }
        }
    }

    private function hasInheritanceMappings(ClassMetadataInfo $metadata)
    {
        $entityName = $metadata->getName();
        $hasMappings = false;

        foreach ($this->classes as $model => $class) {
            if ($class['model'] === $entityName && isset($class['children'])) {
                $hasMappings = $model;
            }
        }

        return $hasMappings;
    }

    private function setInheritanceMappings($model, ClassMetadataInfo $metadata, $configuration)
    {
        if (!isset($this->inheritance[$model])) {
            throw new \LogicException('Model has been found to support inheritance, but has no inheritance found.');
        }

        $inheritance = $this->inheritance[$model];

        $metadata->setInheritanceType(ClassMetadata::INHERITANCE_TYPE_JOINED);
        $metadata->setDiscriminatorColumn(array(
            'name' => 'discriminator',
            'type' => 'string',
            'length' => 120,
        ));
        $metadata->setDiscriminatorMap($inheritance);
        $metadata->setSubclasses(array_values($inheritance));
    }

    private function setCustomRepositoryClasses(ClassMetadataInfo $metadata)
    {
        foreach ($this->classes as $class) {
            if ($class['model'] === $metadata->getName()) {
                if (array_key_exists('repository', $class)) {
                    $metadata->setCustomRepositoryClass($class['repository']);
                }
            }
        }
    }

    private function setAssociationMappings(ClassMetadataInfo $metadata, $configuration)
    {
        foreach (class_parents($metadata->getName()) as $parent) {
            $parentMetadata = new ClassMetadata(
                $parent,
                $configuration->getNamingStrategy()
            );
            if (in_array($parent, $configuration->getMetadataDriverImpl()->getAllClassNames())) {
                $configuration->getMetadataDriverImpl()->loadMetadataForClass($parent, $parentMetadata);
                if ($parentMetadata->isMappedSuperclass) {
                    foreach ($parentMetadata->getAssociationMappings() as $key => $value) {
                        if ($this->hasRelation($value['type'])) {
                            $metadata->associationMappings[$key] = $value;
                        }
                    }
                }
            }
        }
    }

    private function unsetAssociationMappings(ClassMetadataInfo $metadata)
    {
        foreach ($metadata->getAssociationMappings() as $key => $value) {
            if ($this->hasRelation($value['type'])) {
                unset($metadata->associationMappings[$key]);
            }
        }
    }

    private function hasRelation($type)
    {
        return in_array(
            $type,
            array(
                ClassMetadataInfo::MANY_TO_MANY,
                ClassMetadataInfo::ONE_TO_MANY,
                ClassMetadataInfo::ONE_TO_ONE
            ),
            true
        );
    }
}
