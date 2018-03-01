<?php
class menu {
    public function getMenu() {
        global $db;
        $sql = "SELECT * FROM pages ORDER BY priority ASC";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }
}