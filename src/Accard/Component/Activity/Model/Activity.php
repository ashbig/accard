<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Component\Activity\Model;

use DateTime;

/**
 * Accard activity model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Activity implements ActivityInterface
{
    /**
     * Activity id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Activity date.
     *
     * @var DateTime
     */
    protected $activityDate;


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
    public function getActivityDate()
    {
        return $this->activityDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setActivityDate(DateTime $activityDate)
    {
        $this->activityDate = $activityDate;

        return $this;
    }
}
