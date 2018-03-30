<?php
/**
* 
*/
class Comment extends Db_object
{
	// Vars are set using the instantiation method
	protected static $db_table = "comments";
	protected static $db_table_fields = array('photo_id', 'author', 'body');
	public $id;
	public $photo_id;
	public $author;
	public $body;

    public static function create_comment($photo_id, $author, $body){
        $comment = new Comment();
        if (!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment->photo_id = $photo_id;
            $comment->author = $author;
            $comment->body = $body;
            return $comment;
            //return $comment->save();
        } else {
            return false;
        }

    }

    public static function find_comment($photo_id){
        global $database;

        if (!empty($photo_id)) {
            $sql = "SELECT * FROM ".self::$db_table;
            $sql .=" WHERE photo_id = ".$database->escape_string($photo_id);
            $sql .=" ORDER BY photo_id ASC";
            return self::set_query($sql);
        } else {
            return false;
        }
    }


} // End Comment Class 