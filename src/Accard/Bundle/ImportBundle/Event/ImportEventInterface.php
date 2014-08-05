<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Event;

use Accard\Bundle\ImportBundle\Import\ImporterInterface;

/**
 * Import event interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface ImportEventInterface
{
    /**
     * Get importer.
     *
     * @return ImporterInterface
     */
    public function getImporter();
}
