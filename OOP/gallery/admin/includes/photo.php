<?php
/**
* 
*/
class Photo extends Db_object {
	// Vars are set using the instantiation method
	protected static $db_table = "photos";
	protected static $db_table_fields = array('title', 'description', 'filename', 'type', 'size', 'caption', 'alt_text');
	public $id;
	public $title;
	public $description;
	public $filename;
	public $type;
	public $size;
        public $caption;
        public $alt_text;
	public $upload_dir = "uploads";
        
        public function picture_path() {
                return $this->upload_dir.DS.$this->filename;
        }

        public function save_photo(){

        	if ($this->id) {
        		$this->update();
        	} else {

        		if(!empty($this->errors)){
        			return false;
        		}

        		if(empty($this->filename) || empty($this->tmp_path)){
        			$this->errors[] = "The file was available.";
        			return false;
        		}

        		$target_path = SITE_ROOT.'admin'.DS.$this->picture_path();

        		if(file_exists($target_path)){
        			$this->errors[] = "The file {$this->filename} already exist.";
        			return false;
        		}
        		if(move_uploaded_file($this->tmp_path, $target_path)){
        			if ($this->create()) {
        				unset($this->tmp_path);
        				return true;
        			}
        		} else {
        			$this->errors[] = "Check folder permissions. Or if folder exists.";
        			return false;
        		}
        	}
        }

        public function delete_photo(){

                if($this->delete()){
                        $target_path = SITE_ROOT.'admin'.DS.$this->picture_path();
                        return unlink($target_path) ? true : false;
                } else {
                        return false;
                }
        }


} // end class