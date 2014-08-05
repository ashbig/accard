<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Component\Resource\Model;

/**
 * Import target trait.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
trait ImportTargetTrait
{
	/**
	 * Import subject.
	 * 
	 * @var ImportSubjectInterface|null
	 */
	protected $subject;


    /**
     * {@inheritdoc}
     */
    public function setImportSubject(ImportSubjectInterface $subject = null)
    {
    	$this->subject = $subject;

    	return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImportSubject()
    {
    	return $this->subject;
    }

    /**
     * {@inheritdoc}
     */
    public function hasImportSubject()
    {
    	return $this->subject instanceof ImportSubjectInterface;
    }
}
