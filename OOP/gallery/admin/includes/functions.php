<?php
/*
	If a class is called it looks for the class file in 
	the includes folder if it's there it loads it.
	Class name must be the same as the file called.
*/
function classAutLloader($class){
	$class = strtolower($class);
	$path = "includes/{$class}.php";
	if (file_exists($path)) {
		require_once($path);
	} else {
		die("The file named {$class}.php is not found.");
	}

}

spl_autoload_register('classAutLloader');

function redirect($loction){
	header("Location: $loction");
}