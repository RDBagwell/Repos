<?php 
    require_once("includes/init.php");
    if (!$session->is_signed_in()) { redirect("login.php"); }


    if (empty($_GET['id'])) {
        redirect('users.php');
    }

    $users = User::get_by_id($_GET['id']);
    
    if($users){
        $users->delete_user();
        redirect('users.php');
    } else {
        redirect('users.php');
    }