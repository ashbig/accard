<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Component\Core\Model;

/**
 * Accard patient phase model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PatientPhase extends Phase implements PatientPhaseInterface
{
    /**
     * Patient.
     *
     * @var PatientInterface
     */
    protected $patient;


    /**
     * {@inheritdoc}
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * {@inheritdoc}
     */
    public function setPatient(PatientInterface $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }
}
