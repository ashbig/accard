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
 * Accard family cancer attribute model.
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class FamilyCancerAttribute extends Attribute implements FamilyCancerAttributeInterface
{
    /**
     * Family member.
     *
     * @var string
     */
    protected $familyMember;

    /**
     * Type of cancer.
     *
     * @var string
     */
    protected $cancerType;

    /**
     * Side of family.
     *
     * @var string
     */
    protected $side;


    /**
     * {@inheritdoc}
     */
    public function setFamilyMember($familyMember)
    {
        $this->familyMember = $familyMember;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFamilyMember()
    {
        return $this->familyMember;
    }

    /**
     * {@inheritdoc}
     */
    public function setCancerType($cancerType)
    {
        $this->cancerType = $cancerType;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCancerType()
    {
        return $this->cancerType;
    }

    /**
     * {@inheritdoc}
     */
    public function setSide($side)
    {
        $this->side = $side;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSide()
    {
        return $this->side;
    }
}
