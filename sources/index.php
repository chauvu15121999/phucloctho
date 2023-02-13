<?php  if(!defined('_source')) die("Error");

	$title_cat = _sanphamnoibat;	
	$product = get_product('noibat','san-pham',16);	
	$cap1 = get_product_cap('noibat','san-pham','danhmuc',12);		
	$cap2 = get_product_cap('noibat','san-pham','list',12);		
	//$product_id = get_product_id('noibat','san-pham','id_danhmuc',1,12);	
	//$about = get_about('about');	
	//$tintuc = get_news('tin-tuc',10);	
	//layhinh('photo','banner');

	$d->reset();
	$sql = "select id,ten,link,photo from #_video where hienthi=1 limit 0,1";
	$d->query($sql);
	$video_tc = $d->result_array();

	$title_facebook =$company['ten'];
	$images_facebook=layhinh('photo','banner');
	$url_facebook='https://www.hungvuongcoltd.com/';
	$description_facebook=$company['description'];;
?>