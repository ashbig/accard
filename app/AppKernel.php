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
            new \Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new \Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new \DAG\Bundle\SecurityBundle\DAGSecurityBundle(),
            new \FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new \Accard\Bundle\UIBundle\AccardUIBundle(),
            new \Accard\Bundle\WebBundle\AccardWebBundle(),
            new \Lexik\Bundle\MaintenanceBundle\LexikMaintenanceBundle(),
        );

        return array_merge(parent::registerBundles(), $bundles);
    }
}
