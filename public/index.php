<?php

require_once('helpers.php');
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use Framework\App as Frame;

define("__LOG_PATH__", "../log/");
define("__APP_ROOT__", dirname(__FILE__));

$frame = new Frame();

$frame->boot();

if(php_sapi_name() !== "cli")
{
    $frame->init();
}
