<?php  if(!defined('_source')) die("Error");

	@$id_danhmuc =  (int)trim(strip_tags(addslashes($_GET['id_danhmuc'])));
	@$id_list =   (int)trim(strip_tags(addslashes($_GET['id_list'])));
	@$id_cat =   (int)trim(strip_tags(addslashes($_GET['id_cat'])));
	@$id_item =   (int)trim(strip_tags(addslashes($_GET['id_item'])));
	@$id =   (int)trim(strip_tags(addslashes($_GET['id'])));
$bread->set($com.".html",$title);
  if($id>0)
	{
		//Cập nhật lượt xem
		$d->reset();
		$sql_lanxem = "UPDATE #_news SET luotxem=luotxem+1 WHERE id ='$id'";
		$d->query($sql_lanxem);

		$row_detail = get_fetch("select id,ten$lang as ten,tenkhongdau,type,mota$lang as mota,noidung$lang as noidung,id_danhmuc,id_list,title,keywords,description,ngaytao,luotxem,photo,h1,h2,h3,tacgia FROM #_news where hienthi=1 and id='$id' limit 0,1");
		if(empty($row_detail)){redirect($config_url_ssl.'/404.php');}

		$title_cat = $row_detail['ten'];
		$title = $row_detail['title'];$keywords = $row_detail['keywords'];$description = $row_detail['description'];
		$h1 = $row_detail['h1'];$h2 = $row_detail['h2'];$h3 = $row_detail['h3'];

		#Thông tin share facebook
		$images_facebook = $config_url_ssl.'/'._upload_tintuc_l.$row_detail['photo'];
		$title_facebook = $row_detail['ten'];
		$description_facebook = trim(strip_tags($row_detail['mota']));
		$url_facebook = getCurrentPageURL();

		//Hình ảnh khác của tin tức
		$hinhthem = get_result("select id,ten$lang as ten,thumb,photo FROM #_hinhanh where id_hinhanh='".$row_detail['id']."' and type='".$row_detail['type']."' and hienthi=1 order by stt,id desc");

		//tin tức cùng loại
		$where = " type='".$row_detail['type']."' and id_danhmuc='".$row_detail['id_danhmuc']."' and id <> ".$id." and hienthi=1 order by stt,id desc";
	}
	//Danh mục tin tức cấp 4
	elseif($id_item>0)
	{
		$title_bar = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title,keywords,description,h1,h2,h3,mota,noidung FROM #_news_item where id=".$id_item." limit 0,1");
		if(empty($title_bar)){redirect($config_url_ssl.'/404.php');}

		$title_cat = $title_bar['ten'];	$mota = $title_bar['mota'];	$noidung = $title_bar['noidung'];
		$title = $title_bar['title'];$keywords = $title_bar['keywords'];$description = $title_bar['description'];
		$h1 = $title_bar['h1'];$h2 = $title_bar['h2'];$h3 = $title_bar['h3'];

		$where = " type='".$title_bar['type']."' and id_item=".$title_bar['id']." and hienthi=1 order by stt,id desc";
	}
	//Danh mục tin tức cấp 3
	elseif($id_cat > 0)
	{
		$title_bar = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title,keywords,description,h1,h2,h3,mota,noidung FROM #_news_cat where id=".$id_cat." limit 0,1");
		if(empty($title_bar)){redirect($config_url_ssl.'/404.php');}

		$title_cat = $title_bar['ten'];	$mota = $title_bar['mota'];	$noidung = $title_bar['noidung'];
		$title = $title_bar['title'];$keywords = $title_bar['keywords'];$description = $title_bar['description'];
		$h1 = $title_bar['h1'];$h2 = $title_bar['h2'];$h3 = $title_bar['h3'];

		$where = " type='".$title_bar['type']."' and id_cat=".$title_bar['id']." and hienthi=1 order by stt,id desc";
	}
	//Danh mục tin tức cấp 2
	elseif($id_list>0)
	{
		$title_bar = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title,keywords,description,h1,h2,h3,mota,noidung FROM #_news_list where id=".$id_list." limit 0,1");
		if(empty($title_bar)){redirect($config_url_ssl.'/404.php');}

		$title_cat = $title_bar['ten'];	$mota = $title_bar['mota'];	$noidung = $title_bar['noidung'];
		$title = $title_bar['title'];$keywords = $title_bar['keywords'];$description = $title_bar['description'];
		$h1 = $title_bar['h1'];$h2 = $title_bar['h2'];$h3 = $title_bar['h3'];

		$where = " type='".$title_bar['type']."' and id_list=".$title_bar['id']." and hienthi=1 order by stt,id desc";
	}

	//Danh mục tin tức cấp 1
	else if($id_danhmuc!='')
	{
		$title_bar = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title,keywords,description,h1,h2,h3,mota,noidung FROM #_news_danhmuc where id=".$id_danhmuc." limit 0,1");
		if(empty($title_bar)){redirect($config_url_ssl.'/404.php');}

		$title_cat = $title_bar['ten'];	$mota = $title_bar['mota'];	$noidung = $title_bar['noidung'];
		$title = $title_bar['title'];$keywords = $title_bar['keywords'];$description = $title_bar['description'];
		$h1 = $title_bar['h1'];$h2 = $title_bar['h2'];$h3 = $title_bar['h3'];

		$where = " type='".$title_bar['type']."' and id_danhmuc=".$title_bar['id']." and hienthi=1 order by stt,id desc";
	}
	//Tất cả tin tức
	else{
		$where = " type='".$type."' and hienthi=1 order by stt,id desc";
	}

	#Lấy tin tức và phân trang
	$dem = get_fetch("SELECT count(id) AS numrows FROM #_news where $where");

	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	if($id > 0){
		if($type=='du-an' or $type=='cong-trinh' or $type=='thu-vien' or $type=='album' or $type=='hinh-anh')
			$pageSize = $company['soluong_spk'];//Số item cho 1 trang
		else
			$pageSize = $company['soluong_tink'];//Số item cho 1 trang
	}
	else{
			if($type=='du-an' or $type=='cong-trinh' or $type=='thu-vien' or $type=='album' or $type=='hinh-anh')
				$pageSize = $company['soluong_sp'];//Số item cho 1 trang
			else
				$pageSize = $company['soluong_tin'];//Số item cho 1 trang
	}
	$offset = 5;//Số trang hiển thị
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;

	$tintuc = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,mota$lang as mota,ngaytao,luotxem,tacgia FROM #_news where $where limit $bg,$pageSize");
	$url_link = getCurrentPageURL();

?>
