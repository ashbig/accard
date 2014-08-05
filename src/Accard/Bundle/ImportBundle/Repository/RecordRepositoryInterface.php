<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Repository;

use Pagerfanta\PagerfantaInterface;
use Accard\Component\Resource\Repository\RepositoryInterface;

/**
 * Record repository interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface RecordRepositoryInterface extends RepositoryInterface
{
    /**
     * Test if record exists based on unique value.
     *
     * @param string $uniqueValue
     * @return RecordInterface|null
     */
    public function getExisting($uniqueValue);
}
