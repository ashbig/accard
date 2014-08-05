<?php

namespace spec\Accard\Component\Behavior\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BehaviorSpec extends ObjectBehavior
{
    // Class

    function it_is_initializable()
    {
        $this->shouldHaveType('Accard\Component\Behavior\Model\Behavior');
    }

    function it_implements_Accard_behavior_interface()
    {
        $this->shouldImplement('Accard\Component\Behavior\Model\BehaviorInterface');
    }

    // Id

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    // Start date

    function it_has_no_start_date_by_default()
    {
        $this->getStartDate()->shouldReturn(null);
    }

    function its_start_date_is_mutable()
    {
        $date = new \DateTime();
        $this->setStartDate($date);
        $this->getStartDate()->shouldReturn($date);
    }

    // End date

    function it_has_no_end_date_by_default()
    {
        $this->getEndDate()->shouldReturn(null);
    }

    function its_end_date_is_mutable()
    {
        $date = new \DateTime();
        $this->setEndDate($date);
        $this->getEndDate()->shouldReturn($date);
    }

    function its_end_date_is_nullable()
    {
        $this->setEndDate(null);
        $this->getEndDate()->shouldReturn(null);
    }
}
