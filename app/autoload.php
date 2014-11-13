<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * Composer class loader.
 *
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

/**
 * Add class loader to Doctrine annotations loader.
 *
 * @var AnnotationRegistry
 */
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
