<?php
/**
* 
*/
class User extends Db_object
{
	// Vars are set using the instantiation method
	protected static $db_table = "users";
	protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;

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

} // End User Class 