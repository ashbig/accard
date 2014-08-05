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

use ArrayAccess;

/**
 * Accard import record model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Record implements RecordInterface
{
    /**
     * Record id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Unique value.
     *
     * @var string
     */
    protected $uniqueValue;

    /**
     * Import.
     *
     * @var ImportInterface
     */
    protected $import;

    /**
     * Import status.
     *
     * @var boolean
     */
    protected $imported;

    /**
     * Data.
     *
     * @var array
     */
    protected $data;


    /**
     * Constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->data = $data;
        $this->imported = false;
    }

    /**
     * Get record id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getUniqueValue()
    {
        return $this->uniqueValue;
    }

    /**
     * {@inheritdoc}
     */
    public function setUniqueValue($uniqueValue)
    {
        $this->uniqueValue = $uniqueValue;

        return $this;
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
    public function setImport(ImportInterface $import = null)
    {
        $this->import = $import;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isImported()
    {
        return $this->imported;
    }

    /**
     * {@inheritdoc}
     */
    public function setImported($imported = true)
    {
        $this->imported = $imported;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        $this->data = array_merge_recursive($this->data, $data);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDatum($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function setDatum($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }
}
