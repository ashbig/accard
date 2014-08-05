<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ResourceBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Accard\Bundle\ResourceBundle\Import\ResourceInterface;
use Accard\Bundle\ResourceBundle\Import\ImporterInterface;
use Accard\Bundle\ResourceBundle\Exception\ImporterAccessException;
use Accard\Bundle\ResourceBundle\Exception\DuplicateImporterException;
use Accard\Bundle\ResourceBundle\Exception\ResourceNotSubjectException;
use Accard\Bundle\ResourceBundle\Exception\ResourceNotTargetException;

/**
 * Import event.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportEvent extends Event
{
    /**
     * Subject resource.
     *
     * @var ResourceInterface
     */
    protected $subject;

    /**
     * Target resource.
     *
     * @var ResourceInterface
     */
    protected $target;

    /**
     * Importer.
     *
     * @var ImporterInterface
     */
    protected $importer;


    /**
     * Constructor.
     *
     * @param ImporterInterface $importer
     */
    public function __construct(ResourceInterface $subject, ResourceInterface $target)
    {
        if (!$subject->isSubject()) {
            die(var_dump($subject));
            throw new ResourceNotSubjectException($subject);
        }

        if (!$target->isTarget()) {
            throw new ResourceNotTargetException($target);
        }

        $this->subject = $subject;
        $this->target = $target;
    }

    /**
     * Get subject resource.
     *
     * @return ResourceInterface
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get target resource.
     *
     * @return ResourceInterface
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set importer.
     *
     * @param ImporterInterface|null $importer
     */
    public function setImporter(ImporterInterface $importer = null)
    {
        $this->importer = $importer;
    }

    /**
     * Get importer.
     *
     * @return ImporterInterface
     */
    public function getImporter()
    {
        return $this->importer;
    }
}
