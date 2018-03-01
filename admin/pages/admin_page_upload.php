<?php
$post_array = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pages = new pages();
switch ($post_array["pe"]) {
	case 'edit':
        $pages->updatePage($post_array);
        header("Location: /admin/index.php?a=edit_page&pid=".$post_array["pid"]);
		break;
	case 'add':
	$pages->addPage($post_array);
        header("Location: /admin/index.php?a=edit_page");
		break;
	default:
		echo "end";
		break;
}