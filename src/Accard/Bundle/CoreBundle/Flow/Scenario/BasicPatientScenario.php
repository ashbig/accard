<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\CoreBundle\Flow\Scenario;

use Accard\Bundle\FlowBundle\Flow\Scenario\FlowScenario;
use Accard\Bundle\FlowBundle\Flow\Builder\FlowBuilderInterface;

/**
 * Basic patient scenario.
 * 
 * Scenario for creating a patient with one diagnosis.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class BasicPatientScenario extends FlowScenario
{
    /**
     * {@inheritdoc}
     */
    public function build(FlowBuilderInterface $builder)
    {
        $builder
            ->add('create_patient')
            ->add('create_diagnosis')
        ;
    }
}
