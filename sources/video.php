<?php  if(!defined('_source')) die("Error");

	$where = " hienthi=1 and type='".$type."' and id_pro = 0 order by stt,id desc";	

	$dem = get_fetch("SELECT count(id) AS numrows FROM #_video where $where");

	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	$pageSize = $company['soluong_sp'];//Số item cho 1 trang
	$offset = 5;//Số trang hiển thị
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;

	$product = get_result("select id,ten$lang as ten,tenkhongdau,link from #_video where $where limit $bg,$pageSize");

	$url_link = getCurrentPageURL();

?>
