<?php  
error_reporting(0);
include ("ajax_config.php");

$type = $d->escape_str($_POST['type']);
$id = (int) $_POST['id'];

if(!empty($_COOKIE[$type])){
	$arr = explode('-', $_COOKIE[$type]);
	foreach($arr as $k=>$v){
		if($v==$id){
			unset($arr[$k]);
		}
	}
	$cookie_value = implode('-', $arr);
}
setcookie($type, "", time() + (86400*7), $config_tam."/");
setcookie($type, $cookie_value, time() + (86400*7), $config_tam."/"); // 86400 = 1 day
die();
?>