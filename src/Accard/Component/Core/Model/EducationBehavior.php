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

use Accard\Component\Behavior\Model\EducationBehavior as BaseEducationBehavior;
use DateTime;

/**
 * Accard Education Behavior model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
class EducationBehavior extends BaseEducationBehavior implements EducationBehaviorInterface
{
    // Traits
    use BehaviorTrait;
}
