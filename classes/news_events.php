<?php
class news_events {

    public function getNewsEvents() {
        global $db;
        $sql = "SELECT * FROM news_events ORDER BY date_added DESC ";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }

    public function getNewsEventsById($id) {
        global $db;
        $sql = "SELECT * FROM news_events WHERE neid = ".$id;
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }

    public function addNewsEvents($page_array) {
        global $db;
        //print_r($page_array);
        $db->assign_str("title",$page_array["title"]);
        $db->assign_str("post",htmlspecialchars_decode($page_array["post"],ENT_HTML5));
        $db->assign_str("category",$page_array["category"]);
        if($page_array["image"] != ""){
            $db->assign_str("thumbnail",$page_array["image"]);    
        }
        $db->assign_str("date",date("c"));
        $db->assign_str("date_added",date("c"));
        $db->insert("news_events");
        $db->reset();
    }
    
   public function updateNewsEvents($page_array) {
        global $db;
        //print_r($page_array);
        $db->assign_str("title",$page_array["title"]);
        $db->assign_str("post",htmlspecialchars_decode($page_array["post"],ENT_HTML5));
        $db->assign_str("category",$page_array["category"]);
        if($page_array["image"] != ""){
            $db->assign_str("thumbnail",$page_array["image"]);    
        }
        $db->assign_str("date",date("c"));
        $db->assign_str("date_added",date("c"));
        $db->update("news_events","WHERE neid = ".$page_array["neid"]);
        $db->reset();
    }    
}
