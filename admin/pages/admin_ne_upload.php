<?php
    $upload_array  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $news_events = new news_events();
    $image = filter_var_array($_FILES["image"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    function check_values($upload_array){
        if($upload_array["title"] != "" && $upload_array["video_code"] != "" && $upload_array["description"] != ""){
            return true;
        } else {
            echo "Error title, video_code, or description needs to have a value. <a href='/admin/index.php'>Click here to go back.</a>";
            return false;
        }
    }

    function checkImage($imageType){
        if($imageType == "image/gif" || $imageType == "image/jpeg" || $imageType == "image/png"){
            return true;
        } else {
            return false;
        }
    }

    function uploadImage(){
        $image_name = $_FILES["image"]["name"];
        $root = $_SERVER["DOCUMENT_ROOT"];
        $image_path =$root."/images/news_and_events_tumbs/".$image_name;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            $resizeObj = new resize($image_path);
            $resizeObj->resizeImage(189, 101, 'crop');
            $resizeObj->saveImage($image_path, 100);
            var_dump($resizeObj);
            echo "The file ". basename($image_name). " has been uploaded to ".$image_path;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    switch ($upload_array["ne"]) {
    	case 'edit':
    		echo "edit";
            print_r($image);
            if($image["name"] != ""){
                $isImage = checkImage($image["type"]);
                if($isImage){
                    $upload_array["image"] = $image["name"];
                    uploadImage();
                } else {
                    echo "Unacceptable Image";
                }
            }
            $news_events->updateNewsEvents($upload_array,$id);
            header("Location: /admin/index.php?a=ne_edit&neid=".$id);
            break;
    	case 'add':
            echo "add";
            if($image["name"] != ""){
                $isImage = checkImage($image["type"]);
                if($isImage){
                    $upload_array["image"] = $image["name"];
                    uploadImage();
                } else {
                    echo "Unacceptable Image";
                }
            }
            $news_events->addNewsEvents($upload_array);
            header("Location: /admin/index.php?a=ne_edit");
            break;
    	default:
    		echo "end";
    		break;
    }