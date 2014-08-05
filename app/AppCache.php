<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

/**
 * Accard cached app kernel.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class AppCache extends HttpCache
{
}
