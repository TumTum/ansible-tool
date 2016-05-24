<?php
/**
 * PHPSpec Class
 *
 * @author: Tobias Matthaiou <matthaiou@solutiondrive.de>
 * @copyright: 2016 Tobias Matthaiou
 */

namespace spec\sdtm\ansible_tool\template\files\role;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use sdtm\ansible_tool\template\files\makeFileContent;

/**
 * @mixin \sdtm\ansible_tool\template\files\role\mainTask
 */
class mainTaskSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('mainEGAL.yml');
    }

    public function it_is_initializable()
    {
       $this->shouldHaveType('sdtm\ansible_tool\template\files\role\mainTask');
    }

    public function it_is_template_file()
    {
        $this->shouldHaveType('sdtm\ansible_tool\template\files\makeFileContent');
    }

    public function it_is_main_task_name()
    {
        $this->getFilePath()->shouldReturn('main.yml');
    }

    public function it_will_get_content(makeFileContent $makeFileContent)
    {
        $makeFileContent->getFilePath()->shouldBeCalled()->willReturn('test.yml');
        $this->addTaskName($makeFileContent);
        $this->getContent()->shouldContain('- include: test.yml');
    }
}
