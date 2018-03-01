<?php
$pages = new pages();
$profiles_page = $pages->getPagesByPage($p);
$title = $profiles_page[0]['title'];
$content = $profiles_page[0]['content'];
if($profiles_page){
    require_once('./html/profiles.html');
}