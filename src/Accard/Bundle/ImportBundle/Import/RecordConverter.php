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
use Accard\Bundle\ImportBundle\Model\RecordInterface;
use Accard\Component\Resource\Repository\RepositoryInterface;

/**
 * Abstract record converter.
 *
 * Converts a Record object into an entity.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
abstract class RecordConverter implements RecordConverterInterface
{
    /**
     * Resource repository.
     *
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Set resource repository.
     *
     * @param RepositoryInterface $repository
     */
    public function setRepository(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function convertAll(Collection $records)
    {
        foreach ($records as $record) {
            $records->removeElement($record);
            $records->add($this->convert($record));
            unset($record);
        }

        return $records;
    }
}
