<?php
	/**
	*  Using Late Static Bindings ie static:: instead of static:: as the class is extended by other classes
	*/
	class Db_object
	{
		// file upload constants 
		public $tmp_path;
		public $errors = array();
		public $upload_errors = array(
	        UPLOAD_ERR_OK => "File submited.",
	        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
	        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
	        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
	        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
	        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
	        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
	        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
        );

		//Get all from DB
		public static function get_all(){
			return static::set_query("SELECT * FROM ".static::$db_table);
		}

		//Get all from DB by id
		public static function get_by_id($id){
			$result_array = static::set_query("SELECT * FROM ".static::$db_table." WHERE id = $id");
			//Check if there is a result if not return false
			return !empty($result_array) ? array_shift($result_array) : false;
		}

		// //Get all from DB by id 
		// public static function get_by_id($id, $id_column_name){
		// 	$result_array = static::set_query("SELECT * FROM ".static::$db_table." WHERE {$id_column_name} = $id");
		// 	//Check if there is a result if not return false
		// 	return !empty($result_array) ? array_shift($result_array) : false;
		// }

		//Runs a MySQL query using the database class.
		public static function set_query($sql){
			global $database;

			$result_set = $database->query($sql);
			$obj_array = array();
			while ($row = mysqli_fetch_array($result_set)) {

				$obj_array[] = static::instantiation($row);
			}
			return $obj_array;
		}

		//Sets the vars up in the class
		public static function instantiation($record){
			// using get_called_class() to call the class
			$calling_class =  get_called_class();

	        $obj = new $calling_class;
	        foreach ($record as $attributes => $value) {
	        	//Check if the object has attributes
	        	if ($obj->has_attribute($attributes)) {
	        		$obj->$attributes = $value;
	        	}
	        }
	        return $obj;
		}

		//Checks the array for a key(attribute)
		public function has_attribute($attributes){
		// Gets the vars in the class
			$object_properties = get_object_vars($this);
			return array_key_exists($attributes, $object_properties);
		}


		// Gets $db_table_fields and puts it in an array
		protected function properties(){
			
			$properties = array();

			foreach (static::$db_table_fields as $db_field) {
				
				if (property_exists($this, $db_field)) {
					$properties[$db_field] = $this->$db_field;
				}
			}
			return $properties;
		}


		// Gets $db_table_fields uisng properties() and clean values.
		protected function clean_properties(){
			global $database;

			$clean_properties = array();

			foreach ($this->properties() as $key => $value) {
				$clean_properties[$key] = $database->escape_string($value);
			}

			return $clean_properties;

		}

		//uplod a file to the serevr 
		public function set_file($file) {
        	if (empty($file) || !$file || !is_array($file)) {
        		$this->errors[] = "No file was uploaded.";
        		return false;
        	} elseif ($file['error'] != 0) {
        		$this->errors[] = $this->upload_errors[$file['error']];
        		return false;
        	} else {
				$this->filename = basename($file['name']);
	        	$this->tmp_path = $file['tmp_name'];
	        	$this->type = $file['type'];
	        	$this->size = $file['size'];

        	}
			
        }

		// Cheakcs if is id is in DB. Updates if is Creates if not
		public function save(){

			return isset($this->id) ? $this->update() : $this->create();
		}

		public function create(){
			global $database;

			$properties = $this->clean_properties();

			$sql = "INSERT INTO ".static::$db_table." (".implode(", ", array_keys($properties)).")";
			$sql .= " VALUES ('";
			$sql .= implode("', '", array_values($properties)) ;
			$sql .="');";
			
			if ($database->query($sql)) {
				$this->id = $database->insert_id();
				return true;
			} else {
				return false;
			}

		}

		public function update(){
			global $database;

			$properties = $this->clean_properties();
			$properties_pairs = array();

			foreach ($properties as $key => $value) {
				$properties_pairs[] = "{$key}='{$value}'";
			}

			$sql = "UPDATE ".static::$db_table." SET ";
			$sql .= implode(",", $properties_pairs);
			$sql .=" WHERE id = ";
			$sql .= $database->escape_string($this->id).";";

			$database->query($sql);
			return (mysqli_affected_rows($database->connection) == 1) ? true : false;
		}

		public function delete(){
			global $database;
			$sql = "DELETE FROM ".static::$db_table;
			$sql .=" WHERE id = ";
			$sql .= $database->escape_string($this->id).";";
			$database->query($sql);
			return (mysqli_affected_rows($database->connection) == 1) ? true : false;
		}


	}
