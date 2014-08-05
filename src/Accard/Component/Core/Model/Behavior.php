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

use Accard\Component\Behavior\Model\Behavior as BaseBehavior;
use DateTime;

/**
 * Accard behavior model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Behavior extends BaseBehavior implements BehaviorInterface
{
    // Traits
    use \Accard\Component\Resource\Model\BlameableTrait;
    use \Accard\Component\Resource\Model\TimestampableTrait;
    use \Accard\Component\Resource\Model\VersionableTrait;

    /**
     * Patient.
     *
     * @var PatientInterface
     */
    protected $patient;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

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
