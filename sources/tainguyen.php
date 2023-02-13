<?php  if(!defined('_source')) die("Error");
	

	$where = "type='tuvan' and tencty!=''";

	#Lấy tin tức và phân trang
	$dem = get_fetch("SELECT count(id) AS numrows FROM #_lienhe where $where");

	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	$pageSize = 100;
	$offset = 5;//Số trang hiển thị
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;

	$arr_tuvan = get_result("select id,tencty FROM #_lienhe where $where order by id desc limit $bg,$pageSize");
	$url_link = getCurrentPageURL();


	#Thông tin seo web
	//$title_cat = $row_detail['ten'];
	$title = $row_detail['title'];
	$keywords = $row_detail['keywords'];$description = $row_detail['description'];
	$h1 = $row_detail['h1'];$h2 = $row_detail['h2'];$h3 = $row_detail['h3'];

?>
