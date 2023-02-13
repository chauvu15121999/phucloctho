<?php
	session_start();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);

	$login_name_admin = md5($config['salt_sta'].$config['salt_end']);

  	check_login_ajax();
?>
