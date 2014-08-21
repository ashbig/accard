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

use Doctrine\Common\Collections\Collection;

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

    /**
     * Get codes.
     *
     * @return Collection|CodeInterface[]
     */
    public function getCodes();

    /**
     * Test if code is present.
     *
     * @param CodeInterface $code
     * @return boolean
     */
    public function hasCode(CodeInterface $code);

    /**
     * Add code.
     *
     * @param CodeInterface $code
     * @return CodeGroupInterface
     */
    public function addCode(CodeInterface $code);

    /**
     * Remove code.
     *
     * @param CodeInterface $code
     * @return CodeGroupInterface
     */
    public function removeCode(CodeInterface $code);
}
