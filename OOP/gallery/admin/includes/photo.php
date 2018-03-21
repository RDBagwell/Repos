<?php
	/**
	* 
	*/
	class Photo extends Db_object {
		// Vars are set using the instantiation method
		protected static $db_table = "photos";
		protected static $db_table_fields = array('title', 'description', 'filename', 'type', 'size');
		public $photo_id;
		public $title;
		public $description;
		public $filename;
		public $type;
		public $size;

		public $tmp_path;
		public $upload_dir = "../uploads";

		private $errors = array();
		private $upload_errors = array(
	        UPLOAD_ERR_OK => "File submited.",
	        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
	        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
	        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
	        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
	        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
	        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
	        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
        );


        public function set_file($file) {

        	if (empty($file || !$file || !is_array($file))) {
        		$this->errors[] = "No file was uploaded.";
        		return false;
        	}elseif ($file['error'] != 0) {
        		$this->errors[] = $this->upload_errors[$file['error']];
        		return false;
        	} else {
				$this->filename = basename($file['name']);
	        	$this->tmp_path = $file['tmp_name'];
	        	$this->type = $file['type'];
	        	$this->size = $file['size'];
        	}

        }
	}