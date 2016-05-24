<?php
/**
 * PHPSpec Class
 *
 * @author: Tobias Matthaiou <matthaiou@solutiondrive.de>
 * @copyright: 2016 Tobias Matthaiou
 */

namespace spec\sdtm\ansible_tool\template;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use sdtm\ansible_tool\template\files\makeFileContent;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @mixin \sdtm\ansible_tool\template\role
 */
class roleSpec extends ObjectBehavior
{
    public function let(Filesystem $filesystem)
    {
        $this->beConstructedWith($filesystem);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('sdtm\ansible_tool\template\role');
    }

    public function it_will_set_Role_name()
    {
        $this->setRoleName('apache');
        $this->getRoleName()->shouldReturn('apache');
    }

    public function it_will_add_a_tasks(makeFileContent $fileContent)
    {
        $this->addTask($fileContent);
    }

    public function it_will_add_a_markdown_file(makeFileContent $InfoMarkdown)
    {
        $this->addMarkdownFile($InfoMarkdown);
    }

    public function it_will_set_genarete_role(
        Filesystem $filesystem,
        makeFileContent $infoMarkdown,
        makeFileContent $taskContent
        )
    {
        // Create Role
        $filesystem->mkdir(Argument::is('roles/apache24'))->shouldBeCalled();

        // Create Task
        $taskContent->getFilePath()->shouldBeCalled()->willReturn('fpm.yml');
        $taskContent->getContent()->shouldBeCalled()->willReturn("---");
        $filesystem->dumpFile(Argument::is('roles/apache24/tasks/fpm.yml'), '---')->shouldBeCalled();
        $filesystem->mkdir(Argument::is('roles/apache24/tasks'))->shouldBeCalled();

        // Create MainTask
        $filesystem->dumpFile(Argument::is('roles/apache24/tasks/main.yml'), Argument::is("---\n- include: fpm.yml\n"))->shouldBeCalled();

        // Create INFO.md Markdown Task
        $filesystem->dumpFile(Argument::is('roles/apache24/INFO.md'), Argument::is('# Markdown File'))->shouldBeCalled();
        $infoMarkdown->getFilePath()->shouldBeCalled()->willReturn('INFO.md');
        $infoMarkdown->getContent()->shouldBeCalled()->willReturn('# Markdown File');


        $this->beConstructedWith($filesystem);
        $this->setRoleName('apache24');
        $this->addTask($taskContent);
        $this->addMarkdownFile($infoMarkdown);
        $this->genarete('roles');
    }
}
