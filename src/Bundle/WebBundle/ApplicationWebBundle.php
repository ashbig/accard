<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Application\Bundle\WebBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Application web bundle extension.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ApplicationWebBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'AccardWebBundle';
    }
}
