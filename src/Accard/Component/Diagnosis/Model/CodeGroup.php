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
 * Code group model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class CodeGroup implements CodeGroupInterface
{
    /**
     * Internal id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Name.
     *
     * @var string
     */
    protected $name;


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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}
