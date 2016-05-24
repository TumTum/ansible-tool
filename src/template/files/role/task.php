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
 * Class task
 */
class task implements makeFileContent
{

    private $taskname;

    /**
     * @var string
     */
    private $filename = "";

    /**
     * task constructor.
     *
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->taskname = $filename;
        $this->_setFilename($filename);
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        $taskname = strtoupper($this->taskname);
        $content  = "---" . PHP_EOL;
        $content .= "# - name: $taskname | Description" . PHP_EOL;
        $content .= "# - tags: [ $taskname ]" . PHP_EOL;
        return $content;
    }

    /**
     * @param $filename
     */
    protected function _setFilename($filename)
    {
        $this->filename = $filename . ".yml";
    }

}
