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

use Accard\Bundle\ImportBundle\Model\RecordInterface;

/**
 * Record view interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface RecordViewInterface
{
    /**
     * Constructor.
     *
     * @param RecordInterface $record
     */
    public function __construct(RecordInterface $record);

    /**
     * Get list of fields to render.
     *
     * @return array
     */
    public function getFields();
}
