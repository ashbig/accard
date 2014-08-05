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

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Accard\Bundle\ImportBundle\Model\RecordInterface;

/**
 * Import resolver interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface ImporterResolverInterface extends OptionsResolverInterface
{
    /**
     * Build the set of options.
     *
     * {@link http://symfony.com/doc/current/components/options_resolver.html}
     */
    public function build();

    /**
     * Create a unique value for the provided record.
     *
     * @param RecordInterface $record
     * @return string
     */
    public function createUniqueValue(RecordInterface $record);
}
