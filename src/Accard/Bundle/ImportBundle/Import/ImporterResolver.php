<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Import;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Import resolver.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
abstract class ImporterResolver extends OptionsResolver implements ImporterResolverInterface
{
}
