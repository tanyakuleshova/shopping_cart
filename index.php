<?php
// Require libraries
require_once 'lib/init.php';
// Get URI

error_reporting(0);


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT.DS.'views');

$uri = $_SERVER['REQUEST_URI'];
// Call dispatcher
runApp($uri);