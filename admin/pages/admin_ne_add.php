 <?php
 	$get_array = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);      
	if($get_array["a"] == "ne_add"){
		$ne = "add";
		require_once('html/ne_upload.html');
	}
