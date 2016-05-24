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

/**
 * @mixin \sdtm\ansible_tool\template\files\role\task
 */
class taskSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('fpm');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('sdtm\ansible_tool\template\files\role\task');
    }

    public function it_is_template_file()
    {
        $this->shouldHaveType('sdtm\ansible_tool\template\files\makeFileContent');
    }

    public function it_will_return_yml_stuffix()
    {
        $this->getFilePath()->shouldReturn('fpm.yml');
    }

    public function it_will_return_conntent()
    {
        $this->getContent()->shouldReturn("---\n# - name: FPM | Description\n# - tags: [ FPM ]\n");
    }
}
