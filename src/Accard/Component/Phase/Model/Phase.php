<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Component\Phase\Model;

use DateTime;

/**
 * Accard phase model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Phase implements PhaseInterface
{
    /**
     * Phase id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Start date.
     *
     * @var DateTime
     */
    protected $startDate;

    /**
     * End date.
     *
     * @var DateTime
     */
    protected $endDate;

    /**
     * Label.
     *
     * @var string
     */
    protected $label;


    /**
     * Constructor.
     */
    public function __construct()
    {
    }

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
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setStartDate(DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndDate(DateTime $endDate = null)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isOngoing()
    {
        return null === $this->endDate || new DateTime() < $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }
}
