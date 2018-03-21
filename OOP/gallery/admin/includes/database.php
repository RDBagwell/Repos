	<?php 
	require_once("new_config.php");
	class Database
	{
		
		public $connection = "";
		
		function __construct(){
			$this->db_open_connection();
		}

		public function db_open_connection(){

			$this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			
			if ($this->connection->connect_errno) {
				die("Databasse connection fail. ".$this->connection->connect_error);
			}

		}

		public function query($sql){
			$result = $this->connection->query($sql);
			$confim = $this->confirm_query($result);
			if ($confim) {
				return $result;
			}	
		}

		private function confirm_query($result){
			if(!$result) {
				die("Query fialed ");
			} else {
				return true;
			}
		}

		public function escape_string($string){
			$escaped_string = $this->connection->real_escape_string($string);
			return $escaped_string;
		}

		public function insert_id(){
			return $this->connection->insert_id;
		}
	} // End Database Class

$database = new Database();
