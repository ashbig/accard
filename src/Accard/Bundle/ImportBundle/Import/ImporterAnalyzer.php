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
 * Importer analyzer.
 *
 * Used to gather misc. data about a given importer.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImporterAnalyzer
{
    /**
     * Importer registry.
     *
     * @var ImporterRegistryInterface
     */
    protected $registry;

    /**
     * Import view factory.
     *
     * @var ImportViewFactory
     */
    protected $viewFactory;


    /**
     * Constructor.
     *
     * @param ImporterRegistryInterface $registry
     * @param ImportViewFactory $viewFactory
     */
    public function __construct(ImporterRegistryInterface $registry,
                                ImporterViewFactory $viewFactory)
    {
        $this->registry = $registry;
        $this->viewFactory = $viewFactory;
    }

    /**
     * Get list of importer names.
     *
     * @return array
     */
    public function getNames()
    {
        $list = array();
        foreach ($this->registry->getImporters() as $importer) {
            $list[] = $importer->getName();
        }

        return $list;
    }

    /**
     * Create importer view.
     *
     * @param ImporterInterface|string $importerName
     * @return ImporterView
     */
    public function createImporterView($importerName)
    {
        return $this->viewFactory->createImporterView($this->registry->getImporter($importerName));
    }

    /**
     * Create record view.
     *
     * @param RecordInterface $record
     * @return RecordView
     */
    public function createRecordView(RecordInterface $record)
    {
        $importer = $this->registry->getImporter($record->getImport()->getImporter());

        return $this->viewFactory->createRecordView($importer, $record);
    }
}
