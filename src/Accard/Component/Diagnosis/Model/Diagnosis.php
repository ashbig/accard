<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Component\Diagnosis\Model;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Accard diagnosis model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Diagnosis implements DiagnosisInterface
{
    /**
     * Diagnosis id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Parent diagnosis.
     *
     * @var DiagnosisInterface
     */
    protected $parent;

    /**
     * Primary diagnosis.
     *
     * @var DiagnosisInterface
     */
    protected $primary;

    /**
     * Start date.
     *
     * @var DateTime
     */
    protected $startDate;

    /**
     * End date.
     *
     * @var DateTime
     */
    protected $endDate;

    /**
     * Recurrences.
     *
     * @var Collection|DiagnosisInterface[]
     */
    protected $recurrences;

    /**
     * Comorbidities.
     *
     * @var Collection|DiagnosisInterface[]
     */
    protected $comorbidities;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recurrences = new ArrayCollection();
        $this->comorbidities = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(DiagnosisInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrimary(DiagnosisInterface $primary = null)
    {
        $this->primary = $primary;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setStartDate(DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndDate(DateTime $endDate = null)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRecurrences()
    {
        return $this->recurrences;
    }

    /**
     * {@inheritdoc}
     */
    public function hasRecurrence(DiagnosisInterface $recurrence)
    {
        return $this->recurrences->contains($recurrence);
    }

    /**
     * {@inheritdoc}
     */
    public function addRecurrence(DiagnosisInterface $recurrence)
    {
        if (!$this->hasRecurrence($recurrence)) {
            $recurrence->setPrimary($this);
            $this->recurrences->add($recurrence);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeRecurrence(DiagnosisInterface $recurrence)
    {
        if ($this->hasRecurrence($recurrence)) {
            $this->recurrences->removeElement($recurrence);
            $recurrence->setPrimary(null);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getComorbidities()
    {
        return $this->comorbidities;
    }

    /**
     * {@inheritdoc}
     */
    public function hasComorbidity(DiagnosisInterface $comorbidity)
    {
        return $this->comorbidities->contains($comorbidity);
    }

    /**
     * {@inheritdoc}
     */
    public function addComorbidity(DiagnosisInterface $comorbidity)
    {
        if (!$this->hasComorbidity($comorbidity)) {
            $comorbidity->setParent($this);
            $this->comorbidities->add($comorbidity);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeComorbidity(DiagnosisInterface $comorbidity)
    {
        if ($this->hasComorbidity($comorbidity)) {
            $this->comorbidities->removeElement($comorbidity);
            $comorbidity->setParent(null);
        }

        return $this;
    }
}
