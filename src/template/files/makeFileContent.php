<?php

namespace sdtm\ansible_tool\template\files;

interface makeFileContent
{
    public function __construct($name);

    public function getFilePath();

    public function getContent();
}
