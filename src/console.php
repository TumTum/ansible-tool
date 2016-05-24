<?php
/**
 * Created for ansible-tool
 * Author: Tobias Matthaiou <matthaiou@tobimat.eu>
 * Date: 25.05.16
 * Time: 00:10
 * Copyright: 2014 Tobias Matthaiou
 */

require __DIR__ . "/../vendor/autoload.php";

$app = new Symfony\Component\Console\Application('ansible-tool', 'v0.0.1');
$app->add(new \sdtm\ansible_tool\command\NewRole());
$app->run();