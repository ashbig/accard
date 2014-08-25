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
 * Diagnosis controller.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
class DiagnosisController extends ResourceController
{
    /**
     * Design diagnosis action.
     *
     * @param Request $request
     * @todo create logical actions
     */
    public function designAction(Request $request)
    {
        $manager = $this->get('accard.settings.manager');
        $settingsForm = $this->get('accard.settings.form_factory')->create('patient');
        $settingsForm->setData($manager->load('diagnosis'));

        $view = $this->view()
            ->setTemplate($this->config->getTemplate('design.html'))
            ->setData(array(
                'fields' => $this->getFields(),
                'settings_form' => $settingsForm->createView(),
                'diagnoses_count' => $this->getDiagnosesCount(),
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * Code group action.
     *
     * @param Request $request
     */
    public function codeGroupAction(Request $request)
    {
        $view = $this->view()
            ->setTemplate($this->config->getTemplate('groupIndex.html'))
            ->setData(array(
                'diagnosis_code_groups' => $this->getCodeGroups(),
                'diagnosis_codes' => $this->getCodes(),
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * Get paginated list of all fields.
     *
     * @return Pagerfanta
     */
    private function getFields()
    {
        return $this->get('accard.repository.diagnosis_field')->createPaginator();
    }

    /**
     * Get all code groups.
     *
     * @return array
     */
    private function getCodeGroups()
    {
        return $this->get('accard.repository.diagnosis_code_group')->findAll();
    }

    private function getCodes()
    {
        return $this->get('accard.repository.diagnosis_code')->findAll();
    }

    /**
     * Get the total number of diagnoses.
     *
     * @return integer
     */
    private function getDiagnosesCount()
    {
        return $this->get('accard.repository.diagnosis')->getCount();
    }
}
