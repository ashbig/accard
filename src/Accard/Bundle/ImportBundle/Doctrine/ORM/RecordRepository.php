<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Doctrine\ORM;

use Accard\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Accard\Bundle\ImportBundle\Repository\RecordRepositoryInterface;
use Accard\Bundle\ImportBundle\Import\ImporterInterface;
use Pagerfanta\PagerfantaInterface;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Accard import record repository.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class RecordRepository extends EntityRepository implements RecordRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'record';
    }

    /**
     * {@inheritdoc}
     */
    public function getExisting($uniqueValue)
    {
        return $this->findOneBy(array('uniqueValue' => $uniqueValue));
    }

    /**
     * Get query builder for importer records.
     *
     * @param ImporterInterface
     * @return QueryBuilder
     */
    public function getQueryBuilderForImporter(ImporterInterface $importer)
    {
        return $this
            ->getQueryBuilder()
            ->leftJoin('record.import', 'import')
            ->where('import.importer = :importer')
            ->setParameter('importer', $importer->getName())
        ;
    }

    /**
     * Get paginated importer records.
     *
     * @param ImporterInterface $importer
     * @param array $criteria
     * @param array $orderBy
     * @return PagerfantaInterface
     */
    public function getPaginatorForImporter(ImporterInterface $importer, array $criteria = null, array $orderBy = null)
    {
        $queryBuilder = $this->getQueryBuilderForImporter($importer);

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $orderBy);

        return $this->getPaginator($queryBuilder);
    }
}
