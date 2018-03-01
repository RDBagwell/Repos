<?php
// $post_array = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$get_array = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pages = new pages();
$page_list = $pages->getPages();
if($get_array["pid"] != ''){
	if($get_array["a"] == "edit_page"){
		$pe = "edit";
	}
	$page_record = $pages->getPagesById($get_array["pid"]);
	if(count($page_record)>0){
		require_once('html/page_update.html');	
	} else {
		header("Location: /admin/index.php?a=edit_page");
	}
	
} 
else{
	require_once('html/page_edit.html');
}