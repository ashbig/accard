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
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Accard\Component\Resource\Repository\RepositoryInterface;
use Accard\Bundle\ImportBundle\Exception\ImporterAccessException;
use Accard\Bundle\ImportBundle\Exception\DuplicateImporterException;
use Accard\Bundle\ImportBundle\ImportEvents;
use Accard\Bundle\ImportBundle\Event\RegisterImporterEvent;

/**
 * Accard importer registry.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImporterRegistry implements ImporterRegistryInterface
{
    /**
     * Importers.
     *
     * @var Collection|ImporterInterface[]
     */
    protected $importers;

    /**
     * Event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;


    /**
     * Constructor.
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->importers = new ArrayCollection();
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function getImporters()
    {
        return $this->importers;
    }

    /**
     * {@inheritdoc}
     */
    public function registerImporter(ImporterInterface $importer)
    {
        $name = $importer->getName();

        if ($this->hasImporter($name)) {
            throw new DuplicateImporterException($name);
        }

        $event = new RegisterImporterEvent($importer);
        $this->eventDispatcher->dispatch(ImportEvents::REGISTER, $event);

        $this->importers[$name] = $importer;
    }

    /**
     * {@inheritdoc}
     */
    public function unregisterImporter($name)
    {
        if (!$this->hasImporter($name)) {
            throw new ImporterAccessException($name);
        }

        $this->importers->remove($name);
    }

    /**
     * {@inheritdoc}
     */
    public function hasImporter($name)
    {
        return $this->importers->containsKey($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getImporter($name)
    {
        if (!$this->hasImporter($name)) {
            throw new ImporterAccessException($name);
        }

        return $this->importers[$name];
    }
}
