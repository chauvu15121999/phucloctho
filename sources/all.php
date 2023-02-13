<?php  if(!defined('_source')) die("Error");

	@$id =   trim(strip_tags(addslashes($_GET['id'])));	
	$url_link = getCurrentPageURL();
	
	$d->reset();
	$sql = "select id from #_product where tenkhongdau='".$id."'";
	$d->query($sql);
	$kiemtra = $d->result_array();
	
	if(count($kiemtra)>0)
	{
		//Cập nhật lượt xem
		$sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1 WHERE tenkhongdau ='".$id."'";
		$d->query($sql_lanxem);
		
		//Chi tiết sản phẩm
		$sql_detail = "select id,ten$lang as ten,mota$lang as mota,noidung$lang as noidung,masp,gia,giakm,luotxem,thumb,photo,size,mausac,id_danhmuc,id_list,id_cat,type from #_product where hienthi=1 and tenkhongdau='".$id."' limit 0,1";
		$d->query($sql_detail);
		$row_detail = $d->fetch_array();	
		
		$title_cat = $row_detail['ten'];
		$title = $row_detail['title'];	
		$keywords = $row_detail['keywords'];
		$description = $row_detail['description'];
		
		#Thông tin share facebook
		$images_facebook = 'http://'.$config_url.'/'._upload_sanpham_l.$row_detail['photo'];
		$title_facebook = $row_detail['ten'];
		$description_facebook = catchuoi(trim(strip_tags($row_detail['mota'])),250);
		$url_facebook = getCurrentPageURL();
		
		//Hình ảnh khác của sản phẩm
		$sql_hinhthem = "select id,ten$lang as ten,thumb,photo from #_hinhanh where id_hinhanh='".$row_detail['id']."' and type='sanpham' and hienthi=1 order by stt,id desc";
		$d->query($sql_hinhthem);
		$hinhthem = $d->result_array();

		//Sản phẩm cùng loại
		$where = " type='".$row_detail['type']."' and id_danhmuc='".$row_detail['id_danhmuc']."' and id<>'".$row_detail['id']."' and hienthi=1 order by stt,id desc";
		
		#Lấy sản phẩm và phân trang
		$d->reset();
		$sql = "SELECT count(id) AS numrows FROM #_product where $where";
		$d->query($sql);	
		$dem = $d->fetch_array();
		
		$totalRows = $dem['numrows'];
		$page = $_GET['p'];
		$pageSize = $company['soluong_spk'];//Số item cho 1 trang
		$offset = 5;//Số trang hiển thị				
		if ($page == "")$page = 1;
		else $page = $_GET['p'];
		$page--;
		$bg = $pageSize*$page;		
		
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau,thumb,photo,masp,gia,giakm,mota$lang as mota from #_product where $where limit $bg,$pageSize";		
		$d->query($sql);
		$product = $d->result_array();	
		
		$d->reset();
		$sql_contact = "select noidung$lang as noidung from #_about where type='lienhe' limit 0,1";
		$d->query($sql_contact);
		$dathang = $d->fetch_array();	
				
		$template = "product_detail";
		return false;
	}
	//Cấp 2 sản phẩm
	$d->reset();
	$sql = "select id from #_product_list where tenkhongdau='".$id."'";
	$d->query($sql);
	$kiemtra = $d->result_array();
	if(count($kiemtra)>0)
	{
		$sql = "select id,ten$lang as ten,title,keywords,description,noidung$lang as noidung,type from #_product_list where tenkhongdau='".$id."' limit 0,1";
		$d->query($sql);
		$title_bar = $d->fetch_array();
		
		$noidung = $title_bar['noidung'];
		$title_cat = $title_bar['ten'];
		$title = $title_bar['title'];
		$keywords = $title_bar['keywords'];
		$description = $title_bar['description'];
	
		$where = " type='".$title_bar['type']."' and id_list='".$title_bar['id']."' and hienthi=1 order by stt,id desc";
		
		#Lấy sản phẩm và phân trang
		$d->reset();
		$sql = "SELECT count(id) AS numrows FROM #_product where $where";
		$d->query($sql);	
		$dem = $d->fetch_array();
		
		$totalRows = $dem['numrows'];
		$page = $_GET['p'];
		$pageSize = $company['soluong_sp'];//Số item cho 1 trang
		$offset = 5;//Số trang hiển thị				
		if ($page == "")$page = 1;
		else $page = $_GET['p'];
		$page--;
		$bg = $pageSize*$page;		
		
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau,thumb,photo,masp,gia,giakm from #_product where $where limit $bg,$pageSize";		
		$d->query($sql);
		$product = $d->result_array();	
				
		$template = "product";
		return false;
	}
	//Cấp 1 sản phẩm
	$d->reset();
	$sql = "select id from #_product_danhmuc where tenkhongdau='".$id."'";
	$d->query($sql);
	$kiemtra = $d->result_array();
	if(count($kiemtra)>0)
	{
		$sql = "select id,ten$lang as ten,title,keywords,description,noidung$lang as noidung,type from #_product_danhmuc where tenkhongdau='".$id."' limit 0,1";
		$d->query($sql);
		$title_bar = $d->fetch_array();
					
		$noidung = $title_bar['noidung'];
		$title_cat = $title_bar['ten'];
		$title = $title_bar['title'];
		$keywords = $title_bar['keywords'];
		$description = $title_bar['description'];
		
		$where = " type='".$title_bar['type']."' and id_danhmuc='".$title_bar['id']."' and hienthi=1 order by stt,id desc";
		
		#Lấy sản phẩm và phân trang
		$d->reset();
		$sql = "SELECT count(id) AS numrows FROM #_product where $where";
		$d->query($sql);	
		$dem = $d->fetch_array();
		
		$totalRows = $dem['numrows'];
		$page = $_GET['p'];
		$pageSize = $company['soluong_sp'];//Số item cho 1 trang
		$offset = 5;//Số trang hiển thị				
		if ($page == "")$page = 1;
		else $page = $_GET['p'];
		$page--;
		$bg = $pageSize*$page;		
		
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau,thumb,photo,masp,gia,giakm from #_product where $where limit $bg,$pageSize";		
		$d->query($sql);
		$product = $d->result_array();	
				
		$template = "product";
		return false;
	}
	//Cấp 1 sản phẩm
	$d->reset();
	$sql = "select id from #_news where tenkhongdau='".$id."'";
	$d->query($sql);
	$kiemtra = $d->result_array();
	if(count($kiemtra)>0)
	{
		//Cập nhật lượt xem
		$sql_lanxem = "UPDATE #_news SET luotxem=luotxem+1 WHERE tenkhongdau ='".$id."'";
		$d->query($sql_lanxem);
		
		#Chi tiết tin tức
		$sql = "select ten$lang as ten,id,mota$lang as mota,noidung$lang as noidung,title,keywords,description,photo,type,luotxem from #_news where tenkhongdau='".$id."' limit 0,1";
		$d->query($sql);
		$tintuc_detail = $d->fetch_array();
		
		#Thông tin seo web
		$title_cat = $tintuc_detail['ten'];		
		$title = $tintuc_detail['title'];
		$keywords = $tintuc_detail['keywords'];
		$description = $tintuc_detail['description'];
		
		#Thông tin share facebook
		$images_facebook = "http://".$config_url._upload_tintuc_l.$tintuc_detail['photo'];
		$title_facebook = $tintuc_detail['ten'];
		$description_facebook = trim(strip_tags($tintuc_detail['mota']));
		
		#Các hình khác của dự án
		$sql_hinhkhac = "select id,ten,thumb,photo from #_hinhanh where type='".$tintuc_detail['type']."' and hienthi=1 and id_hinhanh='".$tintuc_detail['id']."' order by stt,id desc";
		$d->query($sql_hinhkhac);
		$hinhkhac = $d->result_array();
		
		#Các tin cũ hơn		
		$where = " type='".$tintuc_detail['type']."' and hienthi=1 and id<>'".$tintuc_detail['id']."' order by stt,id desc";
		
		#Lấy tin tức và phân trang
		$d->reset();
		$sql = "SELECT count(id) AS numrows FROM #_news where $where";
		$d->query($sql);	
		$dem = $d->fetch_array();
		
		$totalRows = $dem['numrows'];
		$page = $_GET['p'];
		$pageSize = $company['soluong_tin'];//Số item cho 1 trang
		$offset = 5;//Số trang hiển thị				
		if ($page == "")$page = 1;
		else $page = $_GET['p'];
		$page--;
		$bg = $pageSize*$page;		
		
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau,mota$lang as mota,thumb,ngaytao,luotxem from #_news where $where limit $bg,$pageSize";		
		$d->query($sql);
		$tintuc = $d->result_array();
		
		if($tintuc_detail['type']=='duan')
		{
			$template = "congtrinh_detail";
		}
		else
		{
			$template = "news_detail";
		}
		return false;
	}
?>