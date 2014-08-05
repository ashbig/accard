<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\EventListener;

use Accard\Bundle\ImportBundle\Event\ImportEventInterface;
use Accard\Bundle\ImportBundle\Event\PreBuilderEvent;


/**
 * Prime import listener.
 *
 * Primes the import builder with data from the importer before it is run.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PrimeImportListener
{
    /**
     * Primes the import object with data from the importer before run.
     *
     * @param ImportEventInterface $event
     */
    public function onPreRun(ImportEventInterface $event)
    {
        $importer = $event->getImporter();
        $builder = $importer->getBuilder();
        $import = $builder->getImport()->setImporter($importer->getName());
        $lastImport = $builder->getImportRepository()->getMostRecentFor($importer->getName());
        $criteria = $importer->createNewCriteria($lastImport) ?: $importer->getDefaultCriteria();
        $import->setCriteria($criteria);
    }

    /**
     * Primes the import object with data from the importer after run.
     *
     * @param ImportEventInterface $event
     */
    public function onPostRun(ImportEventInterface $event)
    {
        $import = $event->getImporter()->getBuilder()->getImport();
        $import->setEndTimestamp();
    }

    /**
     * Primes the options resolver to be used.
     *
     * @param PreBuilderEvent $event
     */
    public function primeResolver(PreBuilderEvent $event)
    {
        $resolver = $event->getResolver()->build();
    }
}
