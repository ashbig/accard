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
use Doctrine\Common\Persistence\ObjectManager;
use Accard\Bundle\ImportBundle\Repository\ImportRepositoryInterface;
use Accard\Bundle\ImportBundle\Repository\RecordRepositoryInterface;
use Accard\Bundle\ImportBundle\Import\ImportBuilderInterface;
use Accard\Bundle\ImportBundle\Import\ImporterResolverInterface;
use Accard\Bundle\ImportBundle\Import\RecordConverterInterface;
use Accard\Bundle\ImportBundle\Model\ImportInterface;

/**
 * Pre-builder event.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PreBuilderEvent extends Event implements BuilderEventInterface
{
    /**
     * Object manager.
     *
     * @var ObjectManager
     */
    protected $manager;

    /**
     * Import repository.
     *
     * @var ImportRepositoryInterface
     */
    protected $importRepository;

    /**
     * Record repository.
     *
     * @var RecordRepositoryInterface
     */
    protected $recordRepository;

    /**
     * Import resolver.
     *
     * @var ImporterResolverInterface
     */
    protected $resolver;

    /**
     * Record converter.
     *
     * @var RecordConverterInterface
     */
    protected $converter;

    /**
     * Import.
     *
     * @var ImportInterface|null
     */
    protected $import;

    /**
     * Import builder.
     *
     * @var ImportBuilderInterface
     */
    protected $builder;


    /**
     * Constructor.
     *
     * @param ObjectManager $manager
     * @param ImportRepositoryInterface $importRepository
     * @param RecordRepositoryInterface $recordRepository
     * @param ImporterResolverInterface $resolver
     * @param RecordConverterInterface $converter
     * @param ImportInterface $import
     */
    public function __construct(ObjectManager $manager,
                                ImportRepositoryInterface $importRepository,
                                RecordRepositoryInterface $recordRepository,
                                ImporterResolverInterface $resolver,
                                RecordConverterInterface $converter,
                                ImportInterface $import = null)
    {
        $this->manager = $manager;
        $this->importRepository = $importRepository;
        $this->recordRepository = $recordRepository;
        $this->resolver = $resolver;
        $this->converter = $converter;
        $this->import = $import;
    }

    /**
     * Set import builder.
     *
     * @param ImportBuilderInterface $builder
     */
    public function setBuilder(ImportBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get builder.
     *
     * @return ImportBuilderInterface
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Replace resolver.
     *
     * @param ImporterResolverInterface $resolver
     */
    public function setResolver(ImporterResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Get resolver.
     *
     * @return ImporterResolverInterface
     */
    public function getResolver()
    {
        return $this->resolver;
    }

    /**
     * Replace converter.
     *
     * @param RecordConverterInterface $converter
     */
    public function setConverter(RecordConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Get converter.
     *
     * @return RecordConverterInterface
     */
    public function getConverter()
    {
        return $this->converter;
    }

    /**
     * Set import.
     *
     * @param ImportInterface $import
     */
    public function setImport(ImportInterface $import)
    {
        $this->import = $import;
    }

    /**
     * Get import.
     *
     * @return ImportInterface|null
     */
    public function getImport()
    {
        return $this->import;
    }

    /**
     * Get object manager.
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->manager;
    }

    /**
     * Get import repository.
     *
     * @return ImportRepositoryInterface
     */
    public function getImportRepository()
    {
        return $this->importRepository;
    }

    /**
     * Get record repository.
     *
     * @return RecordRepositoryInterface
     */
    public function getRecordRepository()
    {
        return $this->recordRepository;
    }
}
