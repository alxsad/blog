<?php

namespace spec\Alxsad\Domain\ValueObject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmailSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('fake');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Alxsad\Domain\ValueObject\Email');
    }

    function it_returns_email()
    {
        $this->toString()->shouldReturn('fake');
    }
}
