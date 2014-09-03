<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\CoreBundle\Controller;

use Accard\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Pagerfanta;

/**
 * Behavior controller.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
class BehaviorController extends ResourceController
{
    /**
     * Design behavior action.
     *
     * @param Request $request
     * @todo create logical actions
     */
    public function designAction(Request $request)
    {
        $manager = $this->get('accard.settings.manager');
        $settingsForm = $this->get('accard.settings.form_factory')->create('behavior');
        $settingsForm->setData($manager->load('behavior'));

        $view = $this->view()
            ->setTemplate($this->config->getTemplate('design.html'))
            ->setData(array(
                'settings_form' => $settingsForm->createView(),
                'behavior_count' => $this->getBehaviorCount(),
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * Get the total number of behaviors.
     *
     * @return integer
     */
    private function getBehaviorCount()
    {
        return $this->get('accard.repository.behavior')->getCount();
    }
}
