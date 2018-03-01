<?php 
class vp_uploads {

    public function getUploads() {
        global $db;
        $sql = "SELECT * FROM uploads ORDER BY date_added DESC";
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }

    public function getUploadsById($id) {
        global $db;
        $sql = "SELECT * FROM uploads WHERE vid=".$id;
        $db->query($sql);
        $recods = $db->getRecords();
        return $recods;
    }

    public function uploadToUploads($upload_array) {
        global $db;
        $upload_array["date_added"] = date("c");
        $fields = array();
        $values = array();
        foreach ($upload_array as $fieldname => $value) {
            $fields[] = $fieldname;
            if (is_string($value)) {
                if (!in_array($value, $exempt)) {
                    $values[] = "\"" . $value . "\"";
                } else {
                    $values[] = $value;
                }
            } else {
                $values[] = $value;
            }
        }
        $sql = "INSERT INTO uploads (".implode(",", $fields).") VALUES (".implode(",", $values).");";
       echo $sql;
        $db->query($sql);
    }
    
    public function editUploads($edit_array,$id) {
        global $db;
        $edit_array["date_updated"] = date("c");
        $f = "";
        foreach ($edit_array as $field => $value) {
            $f.= ($f!=""?", ":"").$field." = '".$value."'";
        }
        $sql = "UPDATE uploads SET ".$f." WHERE vid = ".$id;
        $db->query($sql);
    }

}    