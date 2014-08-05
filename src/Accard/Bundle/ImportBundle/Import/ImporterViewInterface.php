<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Import;

/**
 * Importer view interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface ImporterViewInterface
{
    /**
     * Get name.
     *
     * @var string
     */
    public function getName();

    /**
     * Get runs.
     *
     * @var integer
     */
    public function getRuns();

    /**
     * Get latest run date.
     *
     * @var DateTime
     */
    public function getLatestRunDate();

    /**
     * Get latest run time.
     *
     * @var float
     */
    public function getLatestRunTime();

    /**
     * Get average run time.
     *
     * @var float
     */
    public function getaverageRunTime();
}
