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
use Accard\Component\Resource\Repository\RepositoryInterface;
use Accard\Bundle\ImportBundle\Exception\ImporterAccessException;
use Accard\Bundle\ImportBundle\Exception\DuplicateImporterException;

/**
 * Accard importer registry interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface ImporterRegistryInterface
{
    /**
     * Get all importers.
     *
     * @return Collection|ImporterInterface[]
     */
    public function getImporters();

    /**
     * Register an importer.
     *
     * @throws DuplicateImporterException When importer is already registered.
     * @param ImporterInterface $importer
     */
    public function registerImporter(ImporterInterface $importer);

    /**
     * Remove an importer.
     *
     * @throws ImporterAccessException When importer is not found.
     * @param string $name
     */
    public function unregisterImporter($name);

    /**
     * Test for presence of an importer.
     *
     * @param string $name
     * @return boolean
     */
    public function hasImporter($name);

    /**
     * Get importer by name.
     *
     * @throws ImporterAccessException When importer is not found.
     * @param string $name
     * @return ImporterInterface
     */
    public function getImporter($name);
}
