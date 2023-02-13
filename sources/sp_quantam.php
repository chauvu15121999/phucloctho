<?php  if(!defined('_source')) die("Error");
	
	if(!empty($_COOKIE['ds_quantam'])){
		$str_id = str_replace('-', ',', $_COOKIE['ds_quantam']);

		$where = "hienthi=1 and id IN ($str_id) order by ngaytao desc";

		#Lấy sản phẩm và phân trang
		$dem = get_fetch("SELECT count(id) AS numrows FROM table_product where $where");

		$totalRows = $dem['numrows'];
		$page = (int)$_GET['p'];
		$pageSize=10;
		$offset = 5;//Số trang hiển thị
		if ($page == "")$page = 1;
		else $page = (int)$_GET['p'];
		$page--;
		$bg = $pageSize*$page;


		$product = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,congsuat,baohanh,tiente,tinhtrang,mota FROM table_product where $where limit $bg,$pageSize");
		$url_link = getCurrentPageURL();
	}	
?>
