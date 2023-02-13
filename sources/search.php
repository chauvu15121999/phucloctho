<?php  if(!defined('_source')) die("Error");

	$keyword = (string)$_GET['keyword'];
	if($keyword!=''){
		$tukhoa =  $keyword;
		$tukhoa = trim(strip_tags($tukhoa));
		
		$tukhoa = htmlentities($tukhoa);
		

		$where = " (ten$lang LIKE '%$tukhoa%' or masp LIKE '%$tukhoa%') and type='".$type."' and hienthi=1 order by stt,id desc";

		#Lấy sản phẩm và phân trang
		$dem = get_fetch("SELECT count(id) AS numrows FROM #_product where $where");

		$totalRows = $dem['numrows'];
		$page = $_GET['p'];
		$pageSize = $company['soluong_sp'];//Số item cho 1 trang
		$offset = 5;//Số trang hiển thị
		if ($page == "")$page = 1;
		else $page = $_GET['p'];
		$page--;
		$bg = $pageSize*$page;

		$product = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,baohanh,congsuat from #_product where $where limit $bg,$pageSize");
		$url_link = getCurrentPageURL();
	}
?>
