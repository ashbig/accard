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

use Accard\Component\Phase\Model\Phase as BasePhase;
use DateTime;

/**
 * Accard phase model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Phase extends BasePhase implements PhaseInterface
{
    // Traits
    use \Accard\Component\Resource\Model\BlameableTrait;
    use \Accard\Component\Resource\Model\TimestampableTrait;
    use \Accard\Component\Resource\Model\VersionableTrait;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }
}
