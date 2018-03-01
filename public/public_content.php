<?php
// List of pages in public folder
$pages_public = array(
    'home', 'about', 'profiles', 'videos', 'podcast', 'archives', 'pages'
);
// Initalize pages to run through index.php
$p = '';
$title = "Chaos Adrenaline";
if(filter_input(INPUT_SERVER,'REQUEST_URI') == 'index.php' || filter_input(INPUT_SERVER,'REQUEST_URI') == '/' ) {
    $p = 'home';
} else {
    $p = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_ENCODED);
    $title .= " $p";
}
// Call Pubclic Scripts to run Veiws HTML
require_once('html/html_start.html');
require_once('public_header.php');
require_once('html/content_start.html');
require_once('public_left.php');
if($p !=""){
    $isPublicPage = in_array($p, $pages_public);
    if($isPublicPage){
        $body = 'public_'.$p.'.php'; 
    } else {
        $body = 'public_404.php'; 
    }
} else {
    $body = 'public_404.php'; 
}
require_once($body);
require_once('public_right.php');
require_once('html/content_end.html');
require_once('public_footer.php');
require_once('html/html_end.html');

