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

use Accard\Component\Behavior\Model\AlcoholBehavior as BaseAlcoholBehavior;
use DateTime;

/**
 * Accard AlcoholBehavior model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class AlcoholBehavior extends BaseAlcoholBehavior implements AlcoholBehaviorInterface
{
    // Traits
    use BehaviorTrait;
}
