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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Accard\Bundle\ResourceBundle\Import\Events;
use Accard\Bundle\ResourceBundle\Event\ImportEvent;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Importer event subscriber.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImporterEventSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Events::PRE_IMPORT => array('initializeImport', 255),
            Events::CONVERT => array('convertRecords', -255),
        );
    }

    /**
     * Initialize the import object.
     *
     * Figure out criteria to use...
     *
     * @param ImportEvent $event
     */
    public function initializeImport(ImportEvent $event)
    {
        $import = $event->getImport();
        $history = $event->getHistory();
        $importer = $event->getImporter();
        $criteria = null;

        if (empty($history)) {
            $criteria = $importer->getDefaultCriteria();
        }

        if (null === $criteria) {
            $criteria = $importer->getCriteria($history);
        }

        $import->setImporter($importer->getName());
        $import->setCriteria($criteria);
    }

    /**
     * Converts record array into actual target entity.
     *
     * If this ends up being called, it will attempt to write the record using
     * the convention that all data within the record will be writable via. the
     * PropertyAccess Symfony component. If custom logic is required, you should
     * create an event that fires before this one and stops propagation if it is
     * successful.
     *
     * @param ImportEvent $event
     */
    public function convertRecords(ImportEvent $event)
    {
        $records = $event->getRecords();
        $repo = $event->getTarget()->getRepository();
        $accessor = PropertyAccess::createPropertyAccessor();
        $importer = $event->getImporter()->getName();

        foreach ($records as $key => $record) {
            $entity = $repo->createNew();
            $entity->addDescription($importer, $record['import_description']);
            foreach ($record as $field => $value) {
                if (!empty($value) && $accessor->isWritable($entity, $field)) {
                    $accessor->setValue($entity, $field, $value);
                }
            }
            $records[$key] = $entity;
        }

        $event->setRecords($records);
    }
}
