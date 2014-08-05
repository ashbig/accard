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
 * Import target interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface ImportTargetInterface
{
    /**
     * Set import subject.
     *
     * @param ImportSubjectInterface|null $subject
     * @return ImportTargetInterface
     */
    public function setImportSubject(ImportSubjectInterface $subject = null);

    /**
     * Get import subject.
     *
     * @return ImportSubjectInterface|null
     */
    public function getImportSubject();

    /**
     * Test for import subject presence.
     *
     * @return boolean
     */
    public function hasImportSubject();
}
