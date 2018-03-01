<?php
	ob_start();
	session_start();
	$_SESSION["auth"];
	if(isset($_SESSION["auth"])){
	    $crypt_auth = crypt($_SESSION["auth"], '$1$bIo2Icz1$');
	}

	//Call and conect to the database
	require_once('../engine/engine_config.php');
	require_once('../engine/engine_mysql.php');
	$db = new DB;
	$db->init(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	$sql = "SELECT value FROM settings WHERE name = 'AuthKey'";
	$db->query($sql);
	$auth_check = $db->getRecords();

	if($crypt_auth == $auth_check[0]["value"]){
	    $is_auth = true;    
	} else {
	    $is_auth = false;
	}

	if(!$is_auth){
	    header("Location: /admin/login.php");
	}

	//register classes for futuer use
	spl_autoload_register('myAutoloader');
	function myAutoloader($className)
	{
	    $path = '../classes/';
	    require_once($path.$className.'.php');
	}
	// Initalize pages to run through index.php in admin 
	$admin_public = array(
	    'home','vp_upload','vp_edit','vp_add','page_upload','edit_page','page_add','ne_upload','ne_edit','ne_add'
	);

	$a = '';
	$title = "Chaos Adrenaline";
	if(filter_input(INPUT_SERVER,'REQUEST_URI') == '/admin/index.php' || filter_input(INPUT_SERVER,'REQUEST_URI') == '/admin/' ) {
	    $a = 'home';
	} else {
	    $a = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_ENCODED);
	    $title .= " $a";
	}

	// Call Pubclic Scripts to run Veiws HTML
	require_once('pages/admin_head.php');
	if($a !=""){
	    $isPublicPage = in_array($a, $admin_public);
	    if($isPublicPage){
	        $body = 'admin_'.$a.'.php'; 
	    } else {
	        $body = 'admin_404.php'; 
	    }
	} else {
	    $body = 'admin_404.php';
	}
	require_once("pages/".$body);
	require_once('pages/admin_foot.php');