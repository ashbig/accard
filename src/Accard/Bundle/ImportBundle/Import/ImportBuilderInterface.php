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

use Accard\Bundle\ImportBundle\Model\ImportInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Accard import builder interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface ImportBuilderInterface
{
    /**
     * Get import.
     *
     * @return ImportInterface
     */
    public function getImport();

    /**
     * Get import repository.
     *
     * @return ImportRepositoryInterface
     */
    public function getImportRepository();

    /**
     * Get record repository.
     *
     * @return RecordRepositoryInterface
     */
    public function getRecordRepository();

    /**
     * Get resolver.
     *
     * @return ImporterResolverInterface
     */
    public function getResolver();

    /**
     * Get converter.
     *
     * @return RecordConverterInterface
     */
    public function getConverter();

    /**
     * Add a record to the import.
     *
     * @param ImporterInterface $importer
     * @param array $data
     * @return ImportBuilderInterface
     */
    public function addRecord(ImporterInterface $importer, array $data);
}
