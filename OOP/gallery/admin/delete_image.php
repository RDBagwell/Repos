<?php 
    require_once("includes/init.php");
    if (!$session->is_signed_in()) { redirect("login.php"); }


    if (empty($_GET['id'])) {
        redirect('photos.php');
    }

    $photos = Photo::get_by_id($_GET['id']);
    
    if($photos){
        $photos->delete_photo();
        redirect('photos.php');
    } else {
        redirect('photos.php');
    }