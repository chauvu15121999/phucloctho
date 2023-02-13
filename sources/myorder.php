<?php  if(!defined('_source')) die("Error");
	
	if(empty($_SESSION['user_login'])){
		transfer('Vui lòng đăng nhập tài khoản của bạn.',$http.$config_url);
	}

	$where = "id_user='".$_SESSION['user_login']['id']."' order by ngaytao desc";

	#Lấy sản phẩm và phân trang
	$dem = get_fetch("SELECT count(id) AS numrows FROM table_donhang where $where");

	$totalRows = $dem['numrows'];
	$page = (int)$_GET['p'];
	$pageSize=10;
	$offset = 5;//Số trang hiển thị
	if ($page == "")$page = 1;
	else $page = (int)$_GET['p'];
	$page--;
	$bg = $pageSize*$page;


	$arr_donhang = get_result("select madonhang,hoten,dienthoai,email,httt,tonggia,tonggia_usd,ngaytao,tinhtrang,phi_vanchuyen,diachi_txt FROM table_donhang where $where limit $bg,$pageSize");
	$url_link = getCurrentPageURL();
?>
