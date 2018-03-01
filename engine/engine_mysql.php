<?php 
/**
 * @class DB
    We need this to connect to the databass.
 */
class DB{
    private $host = "";
    private $user_name = "";
    private $password = "";
    private $db_name = "";
    private $link_id;
    private $records = "";
    private $result = "";
    private $fields = "";

    public function init($_host, $_user, $_password, $_db_name) {
            $this->host = $_host;
            $this->user_name = $_user;
            $this->password = $_password;
            $this->db_name = $_db_name;
            $this->fields = array();
            $this->link_id = mysqli_connect($this->host, $this->user_name, $this->password, $this->db_name) or die("can't connect to DB");
    }

    public function query($query) {
        $link = $this->link_id;
        $this->result = $link->query($query);
    }
    
    public function getRecords() {
        $this->records = array();
        $count = 0;
        $result = $this->result;
        while ($rows = $result->fetch_array(MYSQLI_BOTH)){
            $this->records[$count] = $rows;
            $count++;
        }
        return $this->records;
    }
    
    public function assign($field, $value){
        $this->fields[$field] = ($value)==""?("'".$value."'"):$value;
    }
    
    public function assign_str($field, $value){
        $this->fields[$field] = "'".addslashes($value)."'";
    }
    
    public function reset(){
        $this->fields = array();
    }
    
    public function insert($table){
        $f = "";
        $v = "";
        foreach($this->fields as $field=>$value){
                $f.= ($f!=""?", ":"").$field;
                $v.= ($v!=""?", ":"").$value;
        }
        $sql = "INSERT INTO ".$table." (".$f.") VALUES (".$v.")";
        print_r($sql);
        $this->query($sql);
    }
	
    public function update($table, $where){
        $f = "";
        foreach($this->fields as $field=>$value){
                $f.= ($f!=""?", ":"").$field." = ".$value;
        }
        $sql = "UPDATE ".$table." SET ".$f." ".$where;
        print_r($sql);
        $this->query($sql);
    }    

    public function closeDB(){
        $link = $this->link_id;    
        $link->close();    
    }
}
