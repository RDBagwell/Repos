<?php
$archive = new archives();
$videos = $archive->getRecentVideo();
foreach ($videos as $video){
    $recent_video = array(
        "video_code" =>  $video["video_code"],
        "video_title" => $video["title"],
        "video_description" =>$video["description"]
    ); 
}

$podcasts = $archive->getRecentPodcasts();
foreach ($podcasts as $podcast){
    $recent_podcast = array(
        "podcast_code" =>  $podcast["video_code"],
        "podcast_title" => $podcast["title"],
        "podcast_description" =>$podcast["description"]
    ); 
}
require_once('public_news_events.php');
require_once('html/home.html');