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
 * Abstract importer.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
abstract class Importer implements ImporterInterface
{
    /**
     * Import builder.
     *
     * @var ImportBuilderInterface
     */
    protected $builder;

    /**
     * {@inheritdoc}
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * {@inheritdoc}
     */
    public function setBuilder(ImportBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * {@inheritdoc}
     */
    public function createNewCriteria(ImportInterface $lastImport = null)
    {
        return null;
    }
}
