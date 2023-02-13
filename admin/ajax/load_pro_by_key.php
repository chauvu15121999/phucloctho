<?php
	session_start();
	@define('_source', '../sources/');
	@define('_lib', '../lib/');
	error_reporting(0);
	include_once _lib . "config.php";
	include_once _lib . "constant.php";
	include_once _lib . "functions.php";
	include_once _lib . "library.php";
	include_once _lib . "class.database.php";
	$d = new database($config['database']);
	
	$tukhoa = htmlspecialchars($_GET['search']);
	$tkd_tukhoa = changeTitle($tukhoa);
	$arr = array();
	if($tukhoa){
		$where = "type='san-pham' and LOWER(CONVERT(ten$lang USING utf8)) LIKE '%".mb_strtolower($tukhoa,'utf-8')."%'";
		
		$sql = "select id, ten$lang as text from #_product where $where order by ten$lang";
		$d->query($sql);
		$arr = $d->result_array();
	}
	echo json_encode($arr);
	die();
?>
