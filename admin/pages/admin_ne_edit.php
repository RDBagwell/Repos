 <?php
    $get_array = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);           
    $news_events = new news_events();
    $news_events_records = $news_events->getNewsEvents();

    if($get_array["neid"] != ''){
    	if($get_array["a"] == "ne_edit"){
    		$ne = "edit";
    	}
        $record = $news_events->getNewsEventsById($get_array["neid"]);
        if(count($record)>0){
                require_once('html/ne_upload.html');	
        } else {
                header("Location: /admin/index.php?a=ne_edit");
        }
		
    } else{
		require_once('html/ne_edit.html');
    }