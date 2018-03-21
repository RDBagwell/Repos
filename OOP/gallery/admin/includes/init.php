<?php

define('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT') ? null : define('SITE_ROOT', DS.'OOP'.DS."gallery".DS);
define('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT."admin".DS."includes".DS);


require_once("functions.php");
require_once("new_config.php");
require_once("database.php");
require_once("db_object.php");
require_once("user.php");
require_once("photo.php");
require_once("session.php");