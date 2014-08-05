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

use Accard\Bundle\ImportBundle\Event\PreBuilderEvent;
use Accard\Bundle\ImportBundle\Import\ImportBuilder;

/**
 * Create default builder listener.
 *
 * Creates an import builder. This is an event so the default factory functionality can
 * be overwritten.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class CreateDefaultBuilderListener
{
    /**
     * Creates a new instance of an import builder.
     *
     * @param PreBuilderEvent $event
     */
    public function onPreBuilder(PreBuilderEvent $event)
    {
        // Do not replace builder if it's already created.
        if ($event->getBuilder()) {
            return;
        }

        $builder = new ImportBuilder(
            $event->getObjectManager(),
            $event->getImportRepository(),
            $event->getRecordRepository(),
            $event->getResolver(),
            $event->getConverter(),
            $event->getImport()
        );

        $event->setBuilder($builder);
    }
}
