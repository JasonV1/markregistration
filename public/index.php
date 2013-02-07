<?php
	define('DS', DIRECTORY_SEPARATOR);
	//echo DS;
	define('ROOT', dirname(dirname(__FILE__)));
	//echo ROOT;
	//ternary operator
	$url = (isset($_GET['url']) ? $_GET['url'] : header("location:./users/adduser"));
	//echo $url;
	require_once(ROOT.DS.'libary'.DS.'bootstrap.php');
?>