<?php
	session_start();
	$session=session_id();
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../admin/lib/');

	include_once _lib."Mobile_Detect.php";
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

	$lang_default = array("","en");
	if(!isset($_SESSION['lang']) or !in_array($_SESSION['lang'], $lang_default))
	{
		$_SESSION['lang'] = '';
	}
	$lang = $_SESSION['lang'];

	require_once _source."lang$lang.php";
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_for.php";
	include_once _lib."class.database.php";
	include_once _lib."functions_user.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
