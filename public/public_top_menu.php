<?php
$site_menus = new menu();
$menus = $site_menus->getMenu();

$top = array();
foreach ($menus as $menu){
    if($menu['menu'] == 'Top' || $menu['menu'] == 'Both'){
        $top[] = $menu;
    }
}
require_once('./html/top_menu.html'); 
