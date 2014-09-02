<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Component\Behavior\Model;

/**
 * Basic Occupation behavior interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
interface OccupationBehaviorInterface extends BehaviorInterface
{
    /**
     * Set past industry
     *
     * @param string $industry
     * @return OccupationBehaviorInterface
     */
    public function setIndustry($industry);

    /**
     * Get past industry
     *
     * @return string
     */
    public function getIndustry();

    /**
     * Set weekly hours
     *
     * @param string $hours
     * @return OccupationBehaviorInterface
     */
    public function setHours($hours);

    /**
     * Get weekly hours
     *
     * @return string
     */
    public function getHours();
}
