<?php

function maybeCSSRequest(){
	if(!isset($_GET['css'])) return;
	$css = '';
	$files = array_map('trim', explode(',', $_GET['css']));
	foreach($files as $file)
		$css .= (strpos($file, '.css') !== false ? file_get_contents(basename($file)) : '');
	header('Content-type: text/css');
	exit($css ? $css : 'Hacking attempt!');
}

maybeCSSRequest();

?>
