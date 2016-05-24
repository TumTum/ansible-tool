<?php
/**
 * Tested Class
 *
 * @author: Tobias Matthaiou <matthaiou@solutiondrive.de>
 * @copyright: 2016 Tobias Matthaiou
 */

namespace sdtm\ansible_tool\command;

use sdtm\ansible_tool\template\files\role\infoMarkdown;
use sdtm\ansible_tool\template\files\role\task;
use sdtm\ansible_tool\template\role;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Class NewRole
 */
class NewRole extends Command
{

    protected function configure()
    {
        $this->setName('role:new');
        $this->setDescription('Erstellt eine neue Role in role/*');
        $this->setDefinition(new InputDefinition([
                new InputArgument('role_name', InputArgument::REQUIRED, 'Name der Ansible Role'),
                new InputOption('place', 'o', InputOption::VALUE_OPTIONAL, 'Speicherort der Role', 'roles'),
        ]));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $roleName = $input->getArgument('role_name');

        $helper = $this->getHelper('question');

        $question = new Question("Beschreibe die Role `$roleName`: ");
        $desciption = $helper->ask($input, $output, $question);
        $output->writeln("");

        $question = new Question('Warum braucht man die Role?: ');
        $why = $helper->ask($input, $output, $question);
        $output->writeln("");

        $question = new Question('In welche Project wird diese genutzt: ');
        $projects = [$helper->ask($input, $output, $question)];

        $question = new Question('und noch? (leer lassen um aufzuhören): ');
        while  ($project = $helper->ask($input, $output, $question) ) {
            $projects[] = $project;
        }
        $output->writeln("");

        $question = new Question('Welche Tasks werden gebraucht? ');
        $tasks = [$helper->ask($input, $output, $question)];

        $question = new Question('und noch? (leer lassen um aufzuhören): ');
        while  ($task = $helper->ask($input, $output, $question) ) {
            $tasks[] = $task;
        }
        $output->writeln("");

        $output->writeln("Role wird erstellt");

        $role_template = new role();
        $role_template->setRoleName($roleName);

        $infoMarkdown = new infoMarkdown();
        $infoMarkdown->setDescription($desciption);
        $infoMarkdown->setRolename($roleName);
        $infoMarkdown->setWhy($why);
        $infoMarkdown->addProjects($projects);

        $role_template->addMarkdownFile($infoMarkdown);

        foreach ($tasks as $task) {
            $role_template->addTask( new task($task) );
        }

        $role_template->genarete($input->getOption('place'));
    }


}
