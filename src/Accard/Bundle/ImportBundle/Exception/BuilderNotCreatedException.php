<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Exception;

use RuntimeException;

/**
 * Builder not created exception.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class BuilderNotCreatedException extends RuntimeException
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->message = 'No builder was created during the import builder factory creation events.';
    }
}
