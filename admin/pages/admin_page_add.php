 <?php
 	$get_array = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);      
	if($get_array["a"] == "page_add"){
		$pe = "add";
		require_once('html/page_update.html');
	}
