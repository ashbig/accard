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
 * Accard diagnosis phase interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface DiagnosisPhaseInterface extends PhaseInterface
{
    /**
     * Get diagnosis.
     *
     * @return DiagnosisInterface
     */
    public function getDiagnosis();

    /**
     * Set diagnosis.
     *
     * @param DiagnosisInterface $diagnosis
     * @return DiagnosisPhaseInterface
     */
    public function setDiagnosis(DiagnosisInterface $diagnosis = null);
}
