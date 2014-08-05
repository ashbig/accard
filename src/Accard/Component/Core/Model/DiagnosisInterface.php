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

use Doctrine\Common\Collections\Collection;
use Accard\Component\Diagnosis\Model\DiagnosisInterface as BaseDiagnosisInterface;
use Accard\Component\Resource\Model\BlameableInterface;
use Accard\Component\Resource\Model\VersionableInterface;
use Accard\Component\Resource\Model\TimestampableInterface;

/**
 * Accard diagnosis interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface DiagnosisInterface extends BaseDiagnosisInterface,
                                     TimestampableInterface,
                                     BlameableInterface,
                                     VersionableInterface
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
	 * @param PatientInterface|null $patient
	 * @return DiagnosisInterface
	 */
	public function setPatient(PatientInterface $patient = null);

    /**
     * Get activities.
     *
     * @return Collection|ActivityInterface[]
     */
    public function getActivities();

    /**
     * Test for presence of a activity.
     *
     * @param ActivityInterface $activity
     * @return boolean
     */
    public function hasActivity(ActivityInterface $activity);

    /**
     * Add activity.
     *
     * @param ActivityInterface $activity
     * @return DiagnosisInterface
     */
    public function addActivity(ActivityInterface $activity);

    /**
     * Remove activity.
     *
     * @param ActivityInterface $activity
     * @return DiagnosisInterface
     */
    public function removeActivity(ActivityInterface $activity);
}
