<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Accard\Bundle\ResourceBundle\EventListener;

use Accard\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Doctrine listener used to set the request on the configurable controllers.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class KernelControllerSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'kernel.controller' => array('onKernelController', 0)
        );
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof ResourceController) {
            $controller[0]->getConfiguration()->setRequest($event->getRequest());
        }
    }
}
