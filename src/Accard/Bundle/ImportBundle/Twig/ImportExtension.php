<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Twig;

use Twig_Extension;
use Twig_SimpleFunction;
use Accard\Bundle\ImportBundle\Import\ImporterInterface;
use Accard\Bundle\ImportBundle\Import\ImporterImporterViewInterface;
use Accard\Bundle\ImportBundle\Model\RecordInterface;
use Accard\Bundle\ImportBundle\Templating\Helper\ImportHelper;

/**
 * Accard import Twig extension.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportExtension extends Twig_Extension
{
    /**
     * Import templating helper.
     *
     * @var ImportHelper
     */
    private $helper;


    /**
     * Constructor.
     *
     * @param ImportHelper $helper
     */
    public function __construct(ImportHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('accard_importer_view', array($this, 'createImporterView')),
            new Twig_SimpleFunction('accard_record_view', array($this, 'createRecordView')),
        );
    }

    /**
     * Create importer view.
     *
     * @param ImporterInterface|string $importer
     * @return ImporterView
     */
    public function createImporterView($importer)
    {
        return $this->helper->createImporterView($importer);
    }

    /**
     * Create record view.
     *
     * @param RecordInterface $record
     * @return RecordView
     */
    public function createRecordView(RecordInterface $record)
    {
        return $this->helper->createRecordView($record);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'accard_import';
    }
}
