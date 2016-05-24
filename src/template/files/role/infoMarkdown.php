<?php
/**
 * Tested Class
 *
 * @author: Tobias Matthaiou <matthaiou@solutiondrive.de>
 * @copyright: 2016 Tobias Matthaiou
 */

namespace sdtm\ansible_tool\template\files\role;

use sdtm\ansible_tool\template\files\makeFileContent;
use Symfony\Component\Console\Descriptor\MarkdownDescriptor;

/**
 * Class infoMarkdown
 */
class infoMarkdown implements makeFileContent
{
    private $rolename;
    private $description;
    private $why;
    private $projects;

    /**
     * infoMarkdown constructor.
     *
     * @param string $filename
     */
    public function __construct($filename = '')
    {
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return "INFO.md";
    }

    public function setRolename($rolename)
    {
        $this->rolename = $rolename;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setWhy($why)
    {
        $this->why = $why;
    }

    public function addProjects(array $project)
    {
        $this->projects = $project;
    }

    public function getContent()
    {
        $content = "ROLE: " . $this->rolename . PHP_EOL;
        $content .= str_repeat("=", strlen($content)-1) . PHP_EOL;
        $content .= PHP_EOL;
        $content .= $this->wrap('description') . PHP_EOL;
        $content .= PHP_EOL;
        $content .= '## Warum?' . PHP_EOL;
        $content .= PHP_EOL;
        $content .= $this->wrap('why') . PHP_EOL;
        $content .= PHP_EOL;
        $content .= '## Project' . PHP_EOL;
        $content .= PHP_EOL;

        $date = date_create('now')->format('Y-m-d');
        foreach ($this->projects as $project) {
            $content .= " - $project (seit $date)" . PHP_EOL;
        }

        // DEBUG Content print PHP_EOL . "!::start::!". PHP_EOL . $content . PHP_EOL . "!::ende::!" . PHP_EOL;
        return $content;
    }

    protected function wrap($p)
    {
        return wordwrap($this->$p);
    }
}
