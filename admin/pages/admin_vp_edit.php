 <?php
 	$get_array = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);           
 	$vp_uploads = new vp_uploads();
    $uploads = $vp_uploads->getUploads();
    if($get_array["vid"] != ''){
    	if($get_array["a"] == "vp_edit"){
    		$vp = "edit";
    	}
		$upload_record = $vp_uploads->getUploadsById($get_array["vid"]);
		if(count($upload_record)>0){
			require_once('html/vp_upload.html');	
		} else {
			header("Location: /admin/index.php?a=vp_edit");
		}
		
    } else{
		require_once('html/vp_edit.html');
    }