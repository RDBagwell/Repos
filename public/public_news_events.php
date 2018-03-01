<?php
$news_events = new news_events();
$data = $news_events->getNewsEvents();

$news = array();
$events = array();
foreach ($data as $datum) {
    if($datum["category"] == "News"){
        $news[] = $datum;  
    } else {
        $events[] = $datum; 
    }
}


