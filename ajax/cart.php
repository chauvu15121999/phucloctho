<?php
	include ("ajax_config.php");

	$act =  (string)magic_quote(trim(strip_tags($_POST['act'])));

	switch($act){
		case "dathang":
			order();
			break;
		case "delete":
			delete();
			break;
		case "update":
			update();
			break;
		case "update_qty_cart":
			update_qty_cart();
			break;
		default:
			break;
	}

	function order()
	{
		global $d;
		$id = (int) $_POST['id'];
		$size = (string)magic_quote(trim(strip_tags($_POST['size'])));
		$mausac = (string)magic_quote(trim(strip_tags($_POST['mausac'])));
		$soluong = (int)$_POST['soluong'];

		addtocart($id,$size,$mausac,$soluong);

		$return['thongbao'] = _sanphamthemvaogiohang.'.<br /><a class="xemgiohang" href="gio-hang.html">'._xemgiohang.'</a>';
		$return['ok'] = '';
		$return['sl'] = get_total();
		echo json_encode($return);
	}

	function delete()
	{
		global $d;
		$id = (int)$_POST['id'];
		$size = (string)$_POST['size'];
		$mausac = (string)$_POST['mau'];
		remove_product($id,$size,$mausac);
		echo number_format(get_order_total(),0, ',', '.').' đ + '.number_format(get_order_total_usd(),0, ',', '.').' usd';
	}

	function update()
	{
		global $d;
		$soluong = intval($_POST['soluong']);
		$vitri = intval($_POST['vitri']);
		$id = intval($_POST['id']);
		$tiente = get_tiente($id);
		if($tiente==2){
			$currency='usd';
		}else{
			$currency='vnđ';
		}
								
		$_SESSION['cart'][$vitri]['qty'] = $soluong;

		$return['total_qty'] = get_total();
		$return['tonggia'] = number_format(get_price($id)*$soluong,0, ',', '.').' '.$currency;
		$return['tongtien'] = number_format(get_order_total(),0, ',', '.').' đ + '.number_format(get_order_total_usd(),0, ',', '.').' usd';
		
		echo json_encode($return);
	}

	function update_qty_cart()
	{
		echo get_total();
	}

?>
