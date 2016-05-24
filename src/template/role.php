<?php
/**
 * Tested Class
 *
 * @author: Tobias Matthaiou <matthaiou@solutiondrive.de>
 * @copyright: 2016 Tobias Matthaiou
 */

namespace sdtm\ansible_tool\template;

use sdtm\ansible_tool\template\files\makeFileContent;
use sdtm\ansible_tool\template\files\role\mainTask;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class role
 */
class role
{

    /**
     * @var Filesystem
     */
    private $fs = null;

    /**
     * @var string
     */
    private $roleName = "";

    /**
     * @var array
     */
    private $tasks = [];

    /**
     * @var array
     */
    private $markdown = [];

    /**
     * @var string
     */
    private $_roleDir = "";

    /**
     * @var mainTask
     */
    private $_mainTaskTemplate = null;

    /**
     * role constructor.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->fs = $filesystem;
    }

    /**
     * @param $root
     */
    public function genarete($root)
    {
        $this->_makeRoleVerz($root)
             ->_makeTask()
             ->_makeMainTask()
             ->_addMarkdownFiles();
    }

    /**
     * @param $root
     *
     * @return $this
     */
    protected function _makeRoleVerz($root)
    {
        $role = $root . DIRECTORY_SEPARATOR . $this->getRoleName();
        $this->setRoleDir($role);

        $this->fs->mkdir($role);

        return $this;
    }

    /**
     * @return $this
     */
    protected function _makeTask()
    {
        $taskDir = $this->getRoleDir() . DIRECTORY_SEPARATOR . "tasks";
        $this->fs->mkdir($taskDir);

        /** @var makeFileContent $task */
        foreach ($this->tasks as $task) {
            $filename = $taskDir . DIRECTORY_SEPARATOR . $task->getFilePath();
            $this->fs->dumpFile($filename, $task->getContent());
            $this->_addMainTaskTemplate($task);
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function _makeMainTask()
    {
        $mainTaskFile = $this->_getMainTaskTemplate();
        $filename = $this->getRoleDir() . DIRECTORY_SEPARATOR . "tasks" . DIRECTORY_SEPARATOR . $mainTaskFile->getFilePath();

        $this->fs->dumpFile($filename, $mainTaskFile->getContent());
        return $this;
    }

    /**
     * @return $this
     */
    protected function _addMarkdownFiles()
    {
        /** @var makeFileContent $markdown */
        foreach ($this->markdown as $markdown) {
            $filepath = $this->getRoleDir() . DIRECTORY_SEPARATOR . $markdown->getFilePath();
            $this->fs->dumpFile($filepath, $markdown->getContent());
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getRoleDir()
    {
        return $this->_roleDir;
    }

    /**
     * @param string $roleDir
     */
    protected function setRoleDir($roleDir)
    {
        $this->_roleDir = $roleDir;
    }

    /**
     * @return mainTask
     */
    protected function _getMainTaskTemplate()
    {
        return $this->_mainTaskTemplate;
    }

    /**
     * @param mainTask $mainTaskTemplate
     */
    protected function _addMainTaskTemplate(makeFileContent $task)
    {
        if ($this->_mainTaskTemplate == null) {
            $this->_mainTaskTemplate = new mainTask('main');
        }

        $this->_mainTaskTemplate->addTaskName($task);
    }

    /**
     * @param $roleName
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }

    /**
     * @return string
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param makeFileContent $taskName
     */
    public function addTask(makeFileContent $taskName)
    {
        $this->tasks[] = $taskName;
    }

    /**
     * @param makeFileContent $Markdown
     */
    public function addMarkdownFile(makeFileContent $Markdown)
    {
        $this->markdown[] = $Markdown;
    }
}
