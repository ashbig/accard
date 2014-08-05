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
 * Basic phase interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface PhaseInterface
{
    /**
     * Get phase id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Get start date.
     *
     * @return DateTime
     */
    public function getStartDate();

    /**
     * Set start date.
     *
     * @param DateTime $startDate
     * @return PhaseInterface
     */
    public function setStartDate(DateTime $startDate);

    /**
     * Get end date.
     *
     * @return DateTime|null $endDate
     */
    public function getEndDate();

    /**
     * Set end date.
     *
     * @param DateTime|null $endDate
     * @return PhaseInterface
     */
    public function setEndDate(DateTime $endDate = null);

    /**
     * Test if phase is ongoing.
     *
     * @return boolean
     */
    public function isOngoing();

    /**
     * Get label.
     *
     * @var string $label
     */
    public function getLabel();

    /**
     * Set label.
     *
     * @param string $label
     * @return PhaseInterface
     */
    public function setLabel($label);
}
