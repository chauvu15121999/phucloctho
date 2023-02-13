<?php  if(!defined('_source')) die("Error");

	@$id =   (int)trim(strip_tags(addslashes($_GET['id'])));

	$where = " type='".$type."' and FIND_IN_SET($id,id_tags)  and hienthi=1 order by stt,id desc";

	$tags_list = get_result("select ten$lang as ten from table_product_tags where hienthi=1 and type='san-pham' and id=".$id." order by stt,id desc");
	$title = $tags_list[0]['ten'];
	$title_cat = 'Kết quả của từ khóa : "<span style="color:#f00">'.$tags_list[0]['ten'].'</span>"';
	#Lấy sản phẩm và phân trang
	$dem = get_fetch("SELECT count(id) AS numrows FROM #_product where $where");

	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	if($id > 0){
		$pageSize = $company['soluong_spk'];//Số item cho 1 trang
	}
	else{
		$pageSize = $company['soluong_sp'];//Số item cho 1 trang
	}
	$offset = 5;//Số trang hiển thị
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;	

	$product = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm FROM #_product where $where limit $bg,$pageSize");
	$url_link = getCurrentPageURL();

?>
