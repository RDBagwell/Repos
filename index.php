<?php
//Call and conect to the database
require_once('engine/engine_config.php');
require_once('engine/engine_mysql.php');
$db = new DB;
$db->init(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$site = $_SERVER["SERVER_NAME"];
//register classes for futuer use
spl_autoload_register('myAutoloader');
function myAutoloader($className)
{
    $path = 'classes/';
    require_once($path.$className.'.php');
}
//Get public content files
require_once('public/public_content.php');