<?php
/**
* 
*/
class User extends Db_object
{
	// Vars are set using the instantiation method
	protected static $db_table = "users";
	protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'filename');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $filename;
	public $upload_dir = "uploads/user_images";
	public $image_placehilder = "http://placehold.it/150x150&text=image";

	//Verifies the user is in the database.
	public static function verify_user($username, $password){
		//Set database class as global
		global $database;

		$username = $database->escape_string($username);
		$password = $database->escape_string($password);
		$sql = "SELECT * FROM ".self::$db_table." WHERE ";
		$sql .= "username =  '{$username}' ";
		$sql .= "AND password =  '{$password}';";
		$result_array = self::set_query($sql);

		//Check if there is a result if not return false
		return !empty($result_array) ? array_shift($result_array) : false;
	}


    //uplod a user_photo to the serevr 
    public function set_user_photo($file) {
        $this->filename = uniqid().basename($file['name']);
        $this->tmp_path = $file['tmp_name'];
        $this->type = $file['type'];
        $this->size = $file['size'];
    }


    public function save_user_and_image(){

		if(!empty($this->errors)){
			return false;
		}

		if(empty($this->filename) || empty($this->tmp_path)){
			$this->errors[] = "The file was available.";
			return false;
		}

		$target_path = $this->upload_dir.DS.$this->filename;

		if(file_exists($target_path)){
			$this->errors[] = "The file {$this->filename} already exist.";
			return false;
		}
		if(move_uploaded_file($this->tmp_path, $target_path)){
			if ($this->save()) {
				unset($this->tmp_path);
				return true;
			}
		} else {
			$this->errors[] = "Check folder permissions. Or if folder exists.";
			return false;
		}
    }

	public function image_placehilder(){
		return (empty($this->filename)) ? $this->image_placehilder :  $this->upload_dir.DS.$this->filename;
	}

	public function delete_user(){
        if($this->delete()){
                $target_path = $this->upload_dir.DS.$this->filename;
                return unlink($target_path) ? true : false;
        } else {
                return false;
        }
    }

} // End User Class 