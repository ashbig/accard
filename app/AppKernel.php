<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
use Accard\Bundle\CoreBundle\Kernel\Kernel;

/**
 * Accard app kernel.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        // Add extra bundles
        $bundles = array(
            new \Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
            new \Accard\Bundle\PDSBundle\AccardPDSBundle(),
            new \DAG\Bundle\SecurityBundle\DAGSecurityBundle(),
        );

        return array_merge(parent::registerBundles(), $bundles);
    }
}
