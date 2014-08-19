<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\FlowBundle\Flow\Scenario;

use Accard\Bundle\FlowBundle\Flow\Builder\FlowBuilderInterface;

/**
 * Sample scenario.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class SampleScenario extends FlowScenario
{
    /**
     * {@inheritdoc}
     */
    public function build(FlowBuilderInterface $builder)
    {
        $builder
            ->add('sample_one')
            ->add('sample_two')
            ->add('sample_three')
        ;
    }
}
