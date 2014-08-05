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

use Symfony\Component\EventDispatcher\Event;
use Accard\Bundle\ImportBundle\Import\ImporterInterface;

/**
 * Import event.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportEvent extends Event implements ImportEventInterface
{
    /**
     * Importer.
     *
     * @var ImporterInterface
     */
    protected $importer;


    /**
     * Constructor.
     *
     * @param ImporterInterface $importer
     */
    public function __construct(ImporterInterface $importer)
    {
        $this->importer = $importer;
    }

    /**
     * {@inheritdoc}
     */
    public function getImporter()
    {
        return $this->importer;
    }
}
