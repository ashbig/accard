<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Component\Diagnosis\Builder;

use Accard\Component\Resource\Builder\AbstractBuilder;
use Accard\Component\Resource\Repository\RepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Diagnosis builder.
 *
 * Used to ease the programatic creation of diagnoses.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DiagnosisBuilder extends AbstractBuilder implements DiagnosisBuilderInterface
{
    /**
     * Diagnosis repository.
     * 
     * @var RepositoryInterface
     */
    private $repository;


    /**
     * Constructor.
     * 
     * @param ObjectManager $manager
     * @param RepositoryInterface $repository
     */
    public function __construct(ObjectManager $manager, RepositoryInterface $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->resource = $this->repository->createNew();

        return $this;
    }
}
