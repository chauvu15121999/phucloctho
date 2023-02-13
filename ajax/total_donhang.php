<?php
	include ("ajax_config.php");

	$result = array();
	if(!empty($_SESSION['cart'])){
		$ship = (float)$_POST['ship'];
		$tien_vnd = get_order_total();
		$tien_usd = get_order_total_usd();


		$result['tamtinh'] = number_format($tien_vnd,0, ',', '.').' đ + '.number_format($tien_usd,0, ',', '.').' usd';
		$result['ship'] = $ship;
		$result['ship_txt'] = number_format($ship,0, ',', '.').' đ';
		$result['tong'] = (float)($tien_vnd+$ship);
		$result['tong_txt'] = number_format($result['tong'],0, ',', '.').' đ + '.number_format($tien_usd,0, ',', '.').' usd';
	}
	
	echo json_encode($result);
	die();
?>
