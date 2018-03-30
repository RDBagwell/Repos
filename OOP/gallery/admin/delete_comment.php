<?php 
    require_once("includes/init.php");
    
    if (!$session->is_signed_in()) { redirect("login.php"); }

    if (empty($_GET['id'])) {
        redirect('comments.php');
    }

    $comments = Comment::get_by_id($_GET['id']);
    
    if($comments){
        $comments->delete();
        redirect('comments.php');
    } else {
        redirect('comments.php');
    }