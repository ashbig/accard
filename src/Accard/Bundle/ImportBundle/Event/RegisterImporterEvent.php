<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Event;

use Accard\Bundle\ImportBundle\Import\ImporterInterface;

/**
 * Register import event.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class RegisterImporterEvent extends ImportEvent
{
    /**
     * Importer is registerable.
     *
     * @var boolean
     */
    protected $registerable = true;


    /**
     * Set importer as registerable.
     *
     * @param boolean $registerable
     */
    public function setRegisterable($registerable)
    {
        $this->registerable = $registerable;
    }

    /**
     * Test if importer is registerable.
     *
     * @return boolean
     */
    public function isRegisterable()
    {
        return $this->registerable;
    }
}
