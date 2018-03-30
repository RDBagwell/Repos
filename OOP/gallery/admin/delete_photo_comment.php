<?php 
    require_once("includes/init.php");
    
    if (!$session->is_signed_in()) { redirect("login.php"); }

    if (empty($_GET['id'])) {
        redirect('photo_comment.php?id='$comments->photo_id);
    }

    $comments = Comment::get_by_id($_GET['id']);
    

    if($comments){
        $comments->delete();
        redirect('photo_comment.php?id='$comments->photo_id);
    } else {
        redirect('photo_comment.php?id='$comments->photo_id);
    }