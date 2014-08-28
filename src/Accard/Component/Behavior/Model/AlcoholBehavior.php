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
 * Accard alcohol behavior model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
class AlcoholBehavior extends Behavior implements AlcoholBehaviorInterface
{
    /**
     * frequency of use.
     * 
     * @var integer
     */
    protected $frequency;


    /**
     * {@inheritdoc}
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFrequency()
    {
        return $this->frequency;
    }


}
