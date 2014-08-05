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
use Accard\Bundle\ImportBundle\Model\Import;

/**
 * Create default import listener.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class CreateDefaultImportListener
{
    /**
     * If no import has been provided, we'll create a default.
     *
     * @param PreBuilderEvent $event
     */
    public function createDefaultImport(PreBuilderEvent $event)
    {
        if (!$event->getImport()) {
            $event->setImport(new Import());
        }
    }
}
