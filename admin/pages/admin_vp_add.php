 <?php
 	$get_array = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);      
	if($get_array["a"] == "vp_add"){
		$vp = "add";
		require_once('html/vp_upload.html');
	}
