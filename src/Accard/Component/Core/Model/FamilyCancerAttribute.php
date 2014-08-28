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

use Accard\Component\Attribute\Model\FamilyCancerAttribute as BaseFamilyCancerAttribute;

/**
 * Accard FamilyCancerAttribute model.
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
class FamilyCancerAttribute extends BaseFamilyCancerAttribute implements FamilyCancerAttributeInterface
{
    // Traits
    use AttributeTrait;
}
