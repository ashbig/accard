<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Model;

/**
 * Accard import record model interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface RecordInterface
{
    /**
     * Get unique value.
     *
     * @return string
     */
    public function getUniqueValue();

    /**
     * Set unique value.
     *
     * @param string $uniqueValue
     * @return RecordInterface
     */
    public function setUniqueValue($uniqueValue);

    /**
     * Get import.
     *
     * @return ImportInterface
     */
    public function getImport();

    /**
     * Set import.
     *
     * @param ImportInterface|null $import
     * @return RecordInterface
     */
    public function setImport(ImportInterface $import = null);

    /**
     * Get record import status.
     *
     * @return boolean
     */
    public function isImported();

    /**
     * Set record import status.
     *
     * @param boolean $imported
     * @return RecordInterface
     */
    public function setImported($imported = true);

    /**
     * Get record data.
     *
     * @return mixed
     */
    public function getData();

    /**
     * Set record data.
     *
     * @param array $data
     * @return RecordInterface
     */
    public function setData(array $data);

    /**
     * Get record datum.
     *
     * @param string $key
     * @return mixed
     */
    public function getDatum($key);

    /**
     * Set record datum.
     *
     * @param string $key
     * @param mixed $value
     * @return RecordInterface
     */
    public function setDatum($key, $value);
}
