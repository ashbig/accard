<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Component\Diagnosis\Model;

/**
 * Code model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Code implements CodeInterface
{
    /**
     * Internal id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Code.
     *
     * @var mixed
     */
    protected $code;

    /**
     * Description.
     *
     * @var string
     */
    protected $description;


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }
}
