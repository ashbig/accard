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

use Doctrine\Common\Collections\Collection;
use Accard\Bundle\ImportBundle\Model\RecordInterface;

/**
 * Record converter interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface RecordConverterInterface
{
    /**
     * Convert record to entity.
     *
     * @param RecordInterface $record
     * @return mixed
     */
    public function convert(RecordInterface $record);

    /**
     * Convert all records to entities.
     *
     * @param Collection|RecordInterface[] $records
     * @return Collection|mixed[]
     */
    public function convertAll(Collection $records);
}
