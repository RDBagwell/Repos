<?php
class pages {
    public function getPages() {
        global $db;
        $sql = "SELECT * FROM pages ORDER BY priority ASC";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }
    
    public function getPagesByPage($page) {
        global $db;
        $sql = "SELECT * FROM pages WHERE name = '".$page."';";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }
    
    public function getPagesById($pid) {
        global $db;
        $sql = "SELECT * FROM pages WHERE pid = '".$pid."';";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }
    
    public function addPage($page_array) {
        global $db;
        $name = str_replace(" ", "_", $page_array["title"]);
        $db->assign_str("menu",$page_array["menu"]);
        $db->assign_str("name", strtolower($name));
        $db->assign_str("title",$page_array["title"]);
        $db->assign_str("content",htmlspecialchars_decode($page_array["content"],ENT_HTML5));
        $db->assign_str("meta_title",$page_array["meta_title"]);
        $db->assign_str("meta_description",$page_array["meta_description"]);
        $db->insert("pages");
        $db->reset();
    }
    
   public function updatePage($page_array) {
        global $db;
        $name = str_replace(" ", "_", $page_array["title"]);
        $db->assign_str("menu",$page_array["menu"]);
        $db->assign_str("name", strtolower($name));
        $db->assign_str("title",$page_array["title"]);
        $db->assign_str("content",htmlspecialchars_decode($page_array["content"],ENT_HTML5));
        $db->assign_str("meta_title",$page_array["meta_title"]);
        $db->assign_str("meta_description",$page_array["meta_description"]);
        $db->update("pages","WHERE pid = ".$page_array["pid"]);
        $db->reset();
    }
}

