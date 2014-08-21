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

/**
 * Code group interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface CodeGroupInterface
{
    /**
     * Get internal id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name.
     *
     * @param string $name
     * @return CodeGroupInterface
     */
    public function setName($name);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();
}
