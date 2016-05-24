<?php
/**
 * Tested Class
 *
 * @author: Tobias Matthaiou <matthaiou@solutiondrive.de>
 * @copyright: 2016 Tobias Matthaiou
 */

namespace sdtm\ansible_tool\template\files\role;

use sdtm\ansible_tool\template\files\makeFileContent;

/**
 * Class mainTask
 */
class mainTask implements makeFileContent
{

    /**
     * @var array
     */
    private $taskFiles = [];

    /**
     * mainTask constructor.
     *
     * @param $name
     */
    public function __construct($name){}

    /**
     * @return string
     */
    public function getFilePath()
    {
        return "main.yml";
    }

    /**
     * @return string
     */
    public function getContent()
    {
        $content = "---" . PHP_EOL;

        foreach ($this->taskFiles as $files) {
            $content .= "- include: " . $files->getFilePath() . PHP_EOL;
        }

        return $content;
    }

    /**
     * @param $taskFile
     */
    public function addTaskName(makeFileContent $taskFile)
    {
        $this->taskFiles[] = $taskFile;

    }

}
