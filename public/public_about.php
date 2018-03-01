<?php
	$pages = new pages();
	$about_page = $pages->getPagesByPage($p);
	$title = $about_page[0]['title'];
	$content = $about_page[0]['content'];
	if($about_page){
	    require_once('./html/about.html');  
	}