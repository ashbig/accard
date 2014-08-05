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
 * Importer view factory.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImporterViewFactory
{
    /**
     * Create new importer view.
     *
     * @param ImporterInterface $importer
     * @return ImportViewInterface
     */
    public function createImporterView(ImporterInterface $importer)
    {
        return new ImporterView($importer);
    }

    /**
     * Create record view.
     *
     * @param ImporterInterface $importer
     * @param RecordInterface $record
     * @return RecordViewInterface
     */
    public function createRecordView(ImporterInterface $importer, RecordInterface $record)
    {
        $recordViewClass = $importer->getRecordViewClass();

        return new $recordViewClass($record);
    }
}
