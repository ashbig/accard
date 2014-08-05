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

class StaticImporter implements ImporterInterface
{
    public function run(OptionsResolverInterface $resolver = null)
    {
        return array();
    }

    public function configureResolver(OptionsResolverInterface $resolver)
    {
        // Do some stuff!!!!
    }

    public function getSubject()
    {
        return 'patient';
    }

    public function getName()
    {
        return 'static';
    }
}
