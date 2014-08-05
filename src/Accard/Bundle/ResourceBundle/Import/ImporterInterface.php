<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ResourceBundle\Import;

use Accard\Bundle\ResourceBundle\Import\ResourceInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Importer interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface ImporterInterface
{
    /**
     * Run importer.
     *
     * @param OptionsResolverInterface $resolver
     */
    public function run(OptionsResolverInterface $resolver = null);

    /**
     * Configure options resolver.
     *
     * @param OptionsResolverInterface $resolver
     */
    public function configureResolver(OptionsResolverInterface $resolver);

    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject();

    /**
     * Get importer name.
     *
     * @return string
     */
    public function getName();
}
