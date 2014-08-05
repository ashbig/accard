<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Templating\Helper;

use Accard\Bundle\ImportBundle\Import\ImporterInterface;
use Accard\Bundle\ImportBundle\Import\ImporterViewInterface;
use Accard\Bundle\ImportBundle\Import\ImporterAnalyzer;
use Accard\Bundle\ImportBundle\Model\RecordInterface;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Import template helper.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportHelper extends Helper
{
    /**
     * Import analyzer.
     *
     * @var ImporterAnalyzer
     */
    private $importerAnalyzer;


    /**
     * Constructor.
     *
     * @param ImportManager $importerAnalyzer
     */
    public function __construct(ImporterAnalyzer $importerAnalyzer)
    {
        $this->importerAnalyzer = $importerAnalyzer;
    }

    /**
     * Create importer view.
     *
     * @param ImporterInterface|string $importer
     * @return ImporterViewInterface
     */
    public function createImporterView($importer)
    {
        if ($importer instanceof ImporterInterface) {
            $importer = $importer->getName();
        }

        return $this->importerAnalyzer->createImporterView($importer);
    }

    /**
     * Create record view.
     *
     * @param RecordInterface $record
     * @return RecordViewInterface
     */
    public function createRecordView(RecordInterface $record)
    {
        return $this->importerAnalyzer->createRecordView($record);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'accard_import';
    }
}
