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

use Accard\Bundle\ImportBundle\Import\ImportBuilderInterface;

/**
 * Builder event interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface BuilderEventInterface
{
    /**
     * Get importer.
     *
     * @return ImportBuilderInterface
     */
    public function getBuilder();
}
