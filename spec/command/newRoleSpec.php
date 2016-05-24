<?php
/**
 * PHPSpec Class
 *
 * @author: Tobias Matthaiou <matthaiou@solutiondrive.de>
 * @copyright: 2016 Tobias Matthaiou
 */

namespace spec\sdtm\ansible_tool\command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin \sdtm\ansible_tool\command\NewRole
 */
class NewRoleSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('sdtm\ansible_tool\command\newRole');
    }

    public function it_is_command()
    {
        $this->shouldHaveType('Symfony\Component\Console\Command\Command');
    }
}
