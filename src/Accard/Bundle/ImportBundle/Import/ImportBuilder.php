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

use Doctrine\Common\Persistence\ObjectManager;
use Accard\Bundle\ImportBundle\Repository\ImportRepositoryInterface;
use Accard\Bundle\ImportBundle\Repository\RecordRepositoryInterface;
use Accard\Bundle\ImportBundle\Model\ImportInterface;
use Accard\Bundle\ImportBundle\Model\RecordInterface;
use Accard\Bundle\ImportBundle\Model\Import;
use Accard\Bundle\ImportBundle\Model\Record;

/**
 * Accard import builder interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportBuilder implements ImportBuilderInterface
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
     * Import object.
     *
     * @var ImportInterface
     */
    protected $import;

    /**
     * Import resolver.
     *
     * @var ImporterResolver
     */
    protected $resolver;

    /**
     * Record converter.
     *
     * @param RecordConverterInterface
     */
    protected $converter;

    /**
     * Unique values already loaded.
     *
     * @var array
     */
    private $uniqueValues = array();


    /**
     * Constructor.
     *
     * @param ObjectManager $manager
     * @param ImportInterface|null $import
     */
    public function __construct(ObjectManager $manager,
                                ImportRepositoryInterface $importRepository,
                                RecordRepositoryInterface $recordRepository,
                                ImporterResolverInterface $resolver,
                                RecordConverterInterface $converter,
                                ImportInterface $import)
    {
        $this->manager = $manager;
        $this->importRepository = $importRepository;
        $this->recordRepository = $recordRepository;
        $this->resolver = $resolver;
        $this->converter = $converter;
        $this->import = $import;
    }

    /**
     * {@inheritdoc}
     */
    public function getImport()
    {
        return $this->import;
    }

    /**
     * {@inheritdoc}
     */
    public function getImportRepository()
    {
        return $this->importRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getRecordRepository()
    {
        return $this->recordRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getResolver()
    {
        return $this->resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function getConverter()
    {
        return $this->converter;
    }

    /**
     * {@inheritdoc}
     */
    public function addRecord(ImporterInterface $importer, array $data)
    {
        $record = new Record();
        $record->setData($this->resolver->resolve($data));
        $unique = $this->resolver->createUniqueValue($record);


        if ($cachedRecord = $this->findInCache($unique)) {
            $record->setData($cachedRecord->getData());
            $record = $cachedRecord;
        } elseif ($repoRecord = $this->findInRepository($unique)) {
            $record->setData($repoRecord->getData());
            $record = $repoRecord;
        } else {
            $record->setUniqueValue($unique);
            $this->import->addRecord($record);
        }

        $this->uniqueValues[$unique] = $record;

        return $this;
    }

    /**
     * Find an existing record in repository.
     *
     * @param string $unique
     * @return RecordInterface|null
     */
    private function findInCache($unique)
    {
        if (isset($this->uniqueValues[$unique])) {
            return $this->uniqueValues[$unique];
        }
    }

    /**
     * Find an existing record in repository.
     *
     * @param string $unique
     * @return RecordInterface|null
     */
    private function findInRepository($unique)
    {
        return $this->recordRepository->getExisting($unique);
    }
}
