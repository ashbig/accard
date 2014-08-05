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
 * Accard patient phase interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface PatientPhaseInterface extends PhaseInterface
{
    /**
     * Get patient.
     *
     * @return PatientInterface
     */
    public function getPatient();

    /**
     * Set patient.
     *
     * @param PatientInterface $patient
     * @return PatientPhaseInterface
     */
    public function setPatient(PatientInterface $patient = null);
}
