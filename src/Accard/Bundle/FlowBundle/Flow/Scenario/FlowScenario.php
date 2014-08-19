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
use Accard\Bundle\FlowBundle\StateMachine\FlowStateMachine;

/**
 * Flow scenario.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
abstract class FlowScenario implements FlowScenarioInterface
{
    protected $stateMachine;

    public function setStateMachine(FlowStateMachine $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    public function getStateMachine()
    {
        return $this->stateMachine;
    }
}
