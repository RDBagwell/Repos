<?php
/*
    This class controlls the Archaive page. It get the infor used to display on the Archive page.
*/
class archives {
    public function getArchive() {
        global $db;
        $sql = "SELECT * FROM uploads ORDER BY date_added DESC";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }
    
    public function getRecentVideo(){
        global $db;
        $sql = "SELECT * FROM uploads WHERE category = 'Video' ORDER BY date_added DESC LIMIT 1";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }
    
    public function getRecentPodcasts(){
        global $db;
        $sql = "SELECT * FROM uploads WHERE category = 'Podcast' ORDER BY date_added DESC LIMIT 1";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }
}
