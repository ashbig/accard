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

use Accard\Component\Resource\Repository\RepositoryInterface;
use Accard\Bundle\ImportBundle\Model\ImportInterface;

/**
 * Accard importer interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface ImporterInterface
{
    /**
     * Import.
     *
     * @param ImportBuilderInterface $builder
     * @return ???
     */
    public function run(ImportBuilderInterface $builder);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get builder.
     *
     * @return ImportBuilderInterface
     */
    public function getBuilder();

    /**
     * Set builder.
     *
     * @param ImportBuilderInterface $builder
     */
    public function setBuilder(ImportBuilderInterface $builder);

    /**
     * Get new criteria.
     *
     * Return null when criteria cannot be generated, this will allow the import
     * manager to call the getDefaultCriteria() method.
     *
     * @param ImportInterface|null $lastImport
     * @return array
     */
    public function createNewCriteria(ImportInterface $lastImport = null);

    /**
     * Get default criteria.
     *
     * @return array
     */
    public function getDefaultCriteria();

    /**
     * Get record view class.
     *
     * @return string
     */
    public function getRecordViewClass();
}
