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
 * @mixin \sdtm\ansible_tool\template\files\role\infoMarkdown
 */
class infoMarkdownSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('sdtm\ansible_tool\template\files\role\infoMarkdown');
    }

    public function it_is_template_file()
    {
        $this->shouldHaveType('sdtm\ansible_tool\template\files\makeFileContent');
    }

    public function it_is_info_markdown()
    {
        $this->getFilePath()->shouldReturn('INFO.md');
    }

    public function it_will_make_content()
    {
        $this->setRolename("apache24");
        $this->setDescription("Standard application Apache von der Linux-Distribution. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula.");
        $this->setWhy("Um einen Webserver zu betreiben braucht man Apache.");
        $this->addProjects(["Sylius", "Outfitter"]);

        $expect = file_get_contents(__DIR__."/../../../data/INFO.md.should");
        $date = date_create('now')->format('Y-m-d');
        $expect = str_replace('%date%', $date, $expect);

        $this->getContent()->shouldReturn($expect);
    }
}
