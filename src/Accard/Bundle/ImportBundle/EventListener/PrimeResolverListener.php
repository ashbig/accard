<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\EventListener;

use Accard\Bundle\ImportBundle\Event\ImportEventInterface;
use Accard\Bundle\ImportBundle\Event\PreBuilderEvent;


/**
 * Prime resolver listener.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PrimeResolverListener
{
    /**
     * Primes the options resolver to be used.
     *
     * @param PreBuilderEvent $event
     */
    public function primeResolver(PreBuilderEvent $event)
    {
        $resolver = $event->getResolver()->build();
    }
}
