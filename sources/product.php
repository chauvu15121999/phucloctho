<?php  if(!defined('_source')) die("Error");

	@$id_danhmuc = (int)trim(strip_tags(addslashes($_GET['id_danhmuc'])));
	@$id_list =   (int)trim(strip_tags(addslashes($_GET['id_list'])));
	@$id_cat =   (int)trim(strip_tags(addslashes($_GET['id_cat'])));
	@$id_item =   (int)trim(strip_tags(addslashes($_GET['id_item'])));
	@$id =   (int)trim(strip_tags(addslashes($_GET['id'])));

	$fill='';
	if((int)$_GET['result']>0){
		$fill.=' and id_thuonghieu='.(int)$_GET['result'];
	}
	if((int)$_GET['gia']>0){
		$d->reset();
		$sql="select ten$lang as ten,id,giatu,giaden from #_product_gia where type='san-pham' and id=".(int)$_GET['gia']." order by stt,id asc";
		$d->query($sql);
		$gia_detial=$d->fetch_array();
		
		$fill.=' and gia>='.$gia_detial['giatu'].' and gia<='.$gia_detial['giaden'].' ';
	}
	
	if($id>0){
		//Cập nhật lượt xem
		$d->reset();
		$sql = "UPDATE #_product SET luotxem=luotxem+1 WHERE id ='$id'";
		$d->query($sql);

		//Chi tiết sản phẩm
		$row_detail = get_fetch("select id,ten$lang as ten,tenkhongdau,type,mota$lang as mota,noidung$lang as noidung,masp,gia,giakm,luotxem,thumb,photo,size,mausac,id_danhmuc,id_list,id_cat,title,keywords,description,h1,h2,h3,congsuat,sao,luot,baohanh,id_thuonghieu,tiente,tinhtrang,muakem,thongso FROM #_product where hienthi=1 and id='$id' limit 0,1");
		if(empty($row_detail)){redirect($config_url_ssl.'/404.php');}

		// SẢN PHẨM ĐÃ XEM
		if(count($_SESSION['product_viewed'])==12){
			unset($_SESSION['product_viewed'][0]); // xóa sp xem đầu tiên
			ksort($_SESSION['product_viewed']); // sắp xếp lại number key của mảng
			if(!in_array($row_detail['id'], $_SESSION['product_viewed'])){
				$_SESSION['product_viewed'][12] = $row_detail['id'];
			}
			
		}else{
			if(!in_array($row_detail['id'], $_SESSION['product_viewed'])){
				$_SESSION['product_viewed'][] = $row_detail['id'];
			}
		}

		if(!empty($row_detail['muakem'])){
			$arr_mk = explode(',', $row_detail['muakem']);
		}else{
			$arr_mk = array();
		}
		

		$tenko = $row_detail['tenkhongdau'];

		$id_dm=$row_detail['id_danhmuc'];
		if($id_dm>0){
			$cap1 = get_fetch("select id,ten$lang as ten,id,tenkhongdau,type,title FROM #_product_danhmuc where id=".$id_dm." limit 0,1");
			$tenko1 = $cap1['tenkhongdau'];
			$ten1 = $cap1['ten'];

			$bread->set("san-pham/".$cap1['tenkhongdau'].'-'.$cap1['id'],$cap1['ten']);
		}

		$id_list=$row_detail['id_list'];
		if($id_list>0){
			$cap2 = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title,id,keywords,description,h1,h2,h3,mota,noidung,id_danhmuc FROM #_product_list where id=".$id_list." limit 0,1");
			$tenko2 = $cap2['tenkhongdau'];
			$ten2 = $cap2['ten'];
			$bread->set("san-pham/".$cap2['tenkhongdau'].'-'.$cap2['id'].'/',$cap2['ten']);
		}

		$id_cat=$row_detail['id_cat'];
		if($id_cat>0){
			$cap3 = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title,keywords,description,h1,h2,h3,mota,noidung,id_danhmuc FROM #_product_cat where id=".$id_cat." limit 0,1");
			$tenko3 = $cap3['tenkhongdau'];
			$ten3 = $cap3['ten'];
		}

		$d->reset();
		$sql="select ten$lang as ten from #_product_thuonghieu where type='san-pham' and id=".$row_detail['id_thuonghieu']." ";
		$d->query($sql);
		$brand_name=$d->fetch_array();
		if($brand_name['ten']!=''){
			$struct_name=trim($brand_name['ten']);
		}else{
			$struct_name='ACME';
		}
		
		$title_cat = $row_detail['ten'];
		$staract = $row_detail['sao'];
		$title = $row_detail['title'];$keywords = $row_detail['keywords'];$description = $row_detail['description'];
		$h1 = $row_detail['h1'];$h2 = $row_detail['h2'];$h3 = $row_detail['h3'];

		
		/*if(get_score($row_detail['id'])>0){
			$sao= get_score($row_detail['id']);
		}else{
			$sao=$row_detail['sao'];
		}
		
		if(get_rates($row_detail['id'])>0){
			$luot= get_rates($row_detail['id']);
		}else{
			$luot=$row_detail['luot'];
		}*/
		$sao= get_score($row_detail['id']);
		$luot= get_rates($row_detail['id']);
		
		#Thông tin share facebook
		$images_facebook = $config_url_ssl.'/'._upload_sanpham_l.$row_detail['photo'];
		$title_facebook = $row_detail['ten'];
		$description_facebook = trim(strip_tags($row_detail['mota']));
		$url_facebook = getCurrentPageURL();

		$id_dm=(int)$row_detail['id_danhmuc'];
		
		//Hình ảnh khác của sản phẩm
		$hinhthem = get_result("select id,ten$lang as ten,thumb,photo FROM #_hinhanh where id_hinhanh='".$row_detail['id']."' and type='".$row_detail['type']."' and hienthi=1 order by stt,id desc");

		//Đánh giá sao
		$danhgiasao = get_result("select ROUND(AVG(giatri)) as giatri FROM #_danhgiasao where link='".getCurrentPageURL()."' order by time desc");

		if($danhgiasao['giatri']<6){$num_danhgiasao=6;}else{$num_danhgiasao=$danhgiasao['giatri'];};
		
		$d->reset();
		$sql="select ten$lang as ten,tenkhongdau,id from #_product_danhmuc where hienthi=1 and type='san-pham' and id=".(int)$row_detail['id_danhmuc']." order by stt,id desc";
		$d->query($sql);
		$product_dm=$d->fetch_array();
		
		//Sản phẩm cùng loại
		$where = " type='".$row_detail['type']."' and id_danhmuc='".$row_detail['id_danhmuc']."' and id_list='".$row_detail['id_list']."' and id <> ".$row_detail['id']." and hienthi=1 order by stt,id desc";

		$bread->set("san-pham/".$row_detail['tenkhongdau'].'-'.$row_detail['id'].'.html',$row_detail['ten']);

		/*Sản phẩm đã xem
		if(isset($_SESSION['recently_viewed'])){
			if(in_array((int)$row_detail['id'], $_SESSION['recently_viewed'])==false)
			{
				$_SESSION['recently_viewed'][]= (int)$row_detail['id'];
			}
		}
		else{
			$_SESSION['recently_viewed'] = array();
			$_SESSION['recently_viewed'][]= (int)$row_detail['id'];
		}

		if(isset($_SESSION['recently_viewed'])) {
		$arr_daxem = implode(',',$_SESSION['recently_viewed']);
		$daxem = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb from #_product where type='".$row_detail['id']."' and hienthi=1 and FIND_IN_SET(id,'".$arr_daxem."')>0");
		//Sản phẩm đã xem*/
	}
	//Danh mục sản phẩm cấp 4
	elseif($id_item>0)
	{
		$title_bar = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title,keywords,description,h1,h2,h3,mota,noidung,id_danhmuc FROM #_product_item where id=".$id_item." limit 0,1");
	  if(empty($title_bar)){redirect($config_url_ssl.'/404.php');}

		$title_cat = $title_bar['ten'];	$mota = $title_bar['mota'];	$noidung = $title_bar['noidung'];
		$title = $title_bar['title'];$keywords = $title_bar['keywords'];$description = $title_bar['description'];
		$h1 = $title_bar['h1'];$h2 = $title_bar['h2'];$h3 = $title_bar['h3'];
		
		$id_dm=(int)$title_bar['id_danhmuc'];
		
		$where = " type='".$title_bar['type']."' and id_item=".$title_bar['id']." and hienthi=1 $fill order by stt,id desc";
		
		
	}
	//Danh mục sản phẩm cấp 3
	elseif($id_cat>0)
	{
		$title_bar = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title,keywords,description,h1,h2,h3,mota,noidung,id_danhmuc,id_list FROM #_product_cat where id=".$id_cat." limit 0,1");
		if(empty($title_bar)){redirect($config_url_ssl.'/404.php');}

		$title_cat = $title_bar['ten'];	$mota = $title_bar['mota'];	$noidung = $title_bar['noidung'];
		$title = $title_bar['title'];$keywords = $title_bar['keywords'];$description = $title_bar['description'];
		$h1 = $title_bar['h1'];$h2 = $title_bar['h2'];$h3 = $title_bar['h3'];

		$tenko3 = $title_bar['tenkhongdau'];
		$ten3 = $title_bar['ten'];

		$id_dm=(int)$title_bar['id_danhmuc'];
		$id_list=(int)$title_bar['id_list'];

		if($id_dm>0){
			$cap1 = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title FROM #_product_danhmuc where id=".$id_dm." limit 0,1");
			$tenko1 = $cap1['tenkhongdau'];
			$ten1 = $cap1['ten'];
		}
		if($id_list>0){
			$cap2 = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title FROM #_product_list where id=".$id_list." limit 0,1");
			$tenko2 = $cap2['tenkhongdau'];
			$ten2 = $cap2['ten'];
		}

		
		$where = " type='".$title_bar['type']."' and id_cat=".$title_bar['id']." and hienthi=1 $fill order by stt,id desc";
	}
	//Danh mục sản phẩm cấp 2
	elseif($id_list > 0)
	{
		$bread=1;
		$title_bar = get_fetch("select id,ten$lang as ten,tenkhongdau,type,id,title,keywords,description,h1,h2,h3,mota,noidung,id_danhmuc FROM #_product_list where id=".$id_list." limit 0,1");
		if(empty($title_bar)){redirect($config_url_ssl.'/404.php');}
		$iddm = $title_bar['id_danhmuc'];
		$title_cat = $title_bar['ten'];	$mota = $title_bar['mota'];	$noidung = $title_bar['noidung'];
		
		$tenko2 = $title_bar['tenkhongdau'];
		$ten2 = $title_bar['ten'];
		$title = $title_bar['title'];$keywords = $title_bar['keywords'];$description = $title_bar['description'];
		$h1 = $title_bar['h1'];$h2 = $title_bar['h2'];$h3 = $title_bar['h3'];

		$id_dm=(int)$title_bar['id_danhmuc'];

		if($id_dm>0){
			$cap1 = get_fetch("select id,ten$lang as ten,tenkhongdau,type,title FROM #_product_danhmuc where id=".$id_dm." limit 0,1");
			$tenko1 = $cap1['tenkhongdau'];
			$ten1 = $cap1['ten'];
			$bread->set("san-pham/".$cap1['tenkhongdau'].'-'.$id_dm,$cap1['ten']);
		}
		$bread->set("san-pham/".$title_bar['tenkhongdau'].'-'.$title_bar['id'].'/',$title_bar['ten']);
		$where = " type='".$title_bar['type']."' and id_list=".$title_bar['id']." and hienthi=1 $fill order by stt,id desc";


		

	}

	//Danh mục sản phẩm cấp 1
	else if($id_danhmuc > 0)
	{
		
		$title_bar = get_fetch("select id,ten$lang as ten,type,tenkhongdau,title,keywords,description,h1,h2,h3,mota,noidung FROM #_product_danhmuc where id=".$id_danhmuc." limit 0,1");

		if(empty($title_bar)){redirect($config_url_ssl.'/404.php');}
		$bread->set("san-pham/".$title_bar['tenkhongdau'].'-'.$id_danhmuc,$title_bar['ten']);
		$iddm = $title_bar['id'];
		$title_cat = $title_bar['ten'];	$mota = $title_bar['mota'];	$noidung = $title_bar['noidung'];
		$title = $title_bar['title'];$keywords = $title_bar['keywords'];$description = $title_bar['description'];
		$h1 = $title_bar['h1'];$h2 = $title_bar['h2'];$h3 = $title_bar['h3'];

		$id_dm=(int)$title_bar['id'];
		
		$where = " type='".$title_bar['type']."' and id_danhmuc=".$title_bar['id']." and hienthi=1 $fill order by stt,id desc";
		//echo $where;
	}else{
		$where = " type='".$type."' and hienthi=1 $fill order by stt,id desc";
		
		$id_dm=0;
	}

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
	
	if(isset($_GET['id'])){
		$pageSize  = 12;
	}
	$offset = 5;//Số trang hiển thị
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;

	$product = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,congsuat,baohanh,tiente FROM #_product where $where  limit $bg,$pageSize");
	$url_link = getCurrentPageURL();
	
?>
