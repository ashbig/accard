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
 * Basic smoking behavior interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
interface SmokingBehaviorInterface extends BehaviorInterface
{

    /**
     * Set past smoking type.
     *
     * @param string $past_type
     * @return SmokingBehaviorInterface
     */
    public function setType($past_type);

    /**
     * Get type.
     *
     * @return string
     */
    public function getType();

    /**
     * Set past smoking frequency.
     *
     * @param string $type
     * @return SmokingBehaviorInterface
     */
    public function setFrequency($past_frequency);

    /**
     * Get frequency.
     *
     * @return string
     */
    public function getFrequency();
}
