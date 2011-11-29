<?php //defined('SYSPATH') or die('No direct script access.');
/*ob_start ("ob_gzhandler");

if(isset($_GET['css'])){
	header("Content-type: text/css; charset: UTF-8");
} else if(isset($_GET['js'])){
	header("Content-type: text/javascript; charset: UTF-8");
}

header("Cache-Control: must-revalidate");
$expires = "Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT";
header($expires);

if(isset($_GET['css'])){
	require_once('src/css/default.css');
	require_once('src/css/admin/screen.css');
} else if(isset($_GET['js'])){
	require_once('../../js/jquery-1.4.2.min.js');
	require_once('../../js/core.js');
}

ob_flush();*/