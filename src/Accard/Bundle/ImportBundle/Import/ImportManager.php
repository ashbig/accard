<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Import;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Accard\Bundle\ImportBundle\Model\ImportInterface;
use Accard\Bundle\ImportBundle\Model\RecordInterface;
use Accard\Bundle\ImportBundle\ImportEvents;
use Accard\Bundle\ImportBundle\Event\ImportEvent;

/**
 * Accard import manager.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportManager
{
    /**
     * Object manager.
     *
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Importer registry.
     *
     * @var ImporterRegistryInterface
     */
    private $registry;

    /**
     * Event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;


    /**
     * Constructor.
     *
     * @param ImporterRegistryInterface $registry
     */
    public function __construct(ObjectManager $objectManager,
                                ImporterRegistryInterface $registry,
                                EventDispatcherInterface $eventDispatcher)
    {
        $this->objectManager = $objectManager;
        $this->registry = $registry;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Run importer.
     *
     * @param string $importer
     * @param boolean $flush
     */
    public function run($importer, $flush = true)
    {
        $importer = $this->registry->getImporter($importer);
        $event = new ImportEvent($importer, $flush);

        $this->eventDispatcher->dispatch(ImportEvents::PRE_RUN, $event);
        $importer->run($importer->getBuilder());
        $this->eventDispatcher->dispatch(ImportEvents::POST_RUN, $event);
        $this->persist($importer->getBuilder()->getImport());

        if ($flush) {
            $this->save();
        }
    }

    public function convert(RecordInterface $record)
    {
        $import = $record->getImport();
        $importer = $this->registry->getImporter($import->getImporter());
        $converter = $importer->getBuilder()->getConverter();

        return $converter->convert($record);
    }

    /**
     * Persist import to object manager.
     *
     * @param ImportInterface $import
     */
    private function persist(ImportInterface $import)
    {
        $this->objectManager->persist($import);
    }

    /**
     * Flush entity manager.
     *
     * This may be used after a dry run of run command.
     */
    public function save()
    {
        $this->objectManager->flush();
        $this->objectManager->clear();
    }
}
