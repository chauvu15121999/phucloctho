<?php  
error_reporting(0);
include ("ajax_config.php");

$type = $d->escape_str($_POST['type']);
$id = (int) $_POST['id'];
$total = 0;
if(!empty($id) && $id>0){
	$cookie_value = '';

	if(!empty($_COOKIE[$type])){
		$arr = explode('-', $_COOKIE[$type]);
		if(!in_array($id, $arr)){
			$cookie_value = $_COOKIE[$type].'-'.$id;
		}else{
			$cookie_value = $_COOKIE[$type];
		}
	}else{
		$cookie_value = $id;
	}
	setcookie($type, "", time() + (86400*7), $config_tam."/");
	setcookie($type, $cookie_value, time() + (86400*7), $config_tam."/"); // 86400 = 1 day
	$total = count(explode('-', $cookie_value));
}
echo $total;
die();
?>