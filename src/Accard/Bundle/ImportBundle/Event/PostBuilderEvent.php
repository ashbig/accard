<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Accard\Bundle\ImportBundle\Import\ImportBuilderInterface;

/**
 * Post-builder event.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PostBuilderEvent extends Event implements BuilderEventInterface
{
    /**
     * Import builder.
     *
     * @var ImportBuilderInterface
     */
    protected $builder;


    /**
     * Constructor.
     *
     * @param ImportBuilderInterface $builder
     */
    public function __construct(ImportBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get import builder.
     *
     * @return ImportBuilderInterface
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
