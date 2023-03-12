<?php
	$com = (string)(isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (string)(isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);

	#Thông tin công ty
	$d->reset();
	$sql_company = "select *,ten$lang as ten,diachi$lang as diachi,slogan$lang as slogan from #_company limit 0,1";
	$d->query($sql_company);
	$company= $d->fetch_array();
	if(isset($bread)){
		$bread->set("/","Trang chủ");
	}

	switch($com)
	{
		case 'tai-nguyen':
			$type = "tainguyen";
			$title = 'Tài nguyên';
			$title_cat = 'Tài nguyên';
			$source = "tainguyen";
			$template = "tainguyen";
			break;
	
		/*case 'gioi-thieu':
			$type = "hung-vuong";
			$title = 'Giới thiệu';
			$title_cat = 'Giới thiệu';
			$source = "about";
			$template = "about";
			break;*/
		case 'tin-tuc':
			$type = "tin-tuc";
			$title = _tintuc;
			$title_cat = _tintuc;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			
			
			break;
		case 'gioi-thieu':
			$type = "gioi-thieu";
			$title = _gioithieu;
			$title_cat = _gioithieu;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			
			
			break;
		case 'thong-bao':
			$type = "thong-bao";
			$title = "Thông báo";
			$title_cat = "Thông báo";
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
		case 'ho-tro':
			$type = "ho-tro";
			$title = "Hỗ trợ";
			$title_cat = "Hỗ trợ";
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;

		case 'chinh-sach-mua-hang':
			$type = "chinh-sach-mua-hang";
			$title = 'Chính sách mua hàng';
			$title_cat = 'Chính sách mua hàng';
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";

			break;

		case 'bai-viet':
			$type = "bai-viet";
			$title = 'Bài viết banner';
			$title_cat = 'Bài viết banner';
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;

		case 'dich-vu':
			$type = "dich-vu";
			$title = _dichvu;
			$title_cat = _dichvu;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;

		case 'khuyen-mai':
	 		 $type = "khuyen-mai";
	 		 $title = _khuyenmai;
	 		 $title_cat = _khuyenmai;
	 		 $title_other = _tinlienquan;
	 		 $source = "news";
	 		 $template = isset($_GET['id']) ? "news_detail" : "news";
	 		 break;

		case 'tuyen-dung':
			$type = "tuyen-dung";
			$title = _tuyendung;
			$title_cat = _tuyendung;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;

		case 'cong-trinh':
			$type = "cong-trinh";
			$title = _congtrinh;
			$title_cat = _congtrinh;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "congtrinh_detail" : "congtrinh";
			break;

		case 'du-an':
			$type = "du-an";
			$title = _duan;
			$title_cat = _duan;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;

		case 'thu-vien':
			$type = "thu-vien";
			$title = _thuvien;
			$title_cat = _thuvien;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;

		case 'album':
			$type = "album";
			$title = 'Album';
			$title_cat = 'Album';
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "congtrinh_detail" : "congtrinh";
			break;

		case 'bang-gia':
			$type = "bang-gia";
			$title = _banggia;
			$title_cat = _banggia;
			$title_other = _tinlienquan;
			$source = "news";
			$template = "banggia";
			break;

		case 'lien-he':
			$type = "lienhe";
			$title = _lienhe;
			$title_cat = _lienhe;
			$source = "contact";
			$template = "contact";
			$bread->set($com.".html",$title);
			break;

		case 'tim-kiem':
			$type = "san-pham";
			$title = _ketquatimkiem;
			$title_cat = _ketquatimkiem;
			$source = "search";
			$template = "product";

			$bread->set("tim-kiem.html&keyword=".$_GET['keyword'],"Tìm kiếm");
			break;

		case 'san-pham':
			$type = "san-pham";
			$title = _sanpham;
			$title_cat = _sanpham;
			$title_other = _sanphamcungloai;
			$source = "product";
			$template = isset($_GET['id']) ? "product_detail" : "product";
			$bread->set("san-pham.html","Sản phẩm");
			break;

		case 'tags':		
			$type = "san-pham";
			$title = 'Tags';
			$title_cat = 'Tags';
			$source = "tags";
			$template = "product";
			break;

		case 'phan-trang-danh-muc':
			$type = "san-pham";
			$title = _sanpham;
			$title_cat = _sanpham;
			$source = "phantrang_dm";
			$template = "phantrang_dm";
			break;

		case 'video':
			$type = "video";
			$title = 'Video Clip';
			$title_cat = "Video Clip";
			$source = "video";
			$template = "video";

			$bread->set($com.".html",$title);
			break;

		case 'gio-hang':
			$type = "giohang";
			$title = _giohang;
			$title_cat = _giohang;
			$source = "giohang";
			$template = "giohang";
			$bread->set($com.".html","Thanh toán");
			break;

		case 'thanh-toan':
			$type = "thanhtoan";
			$title = _thanhtoan;
			$title_cat = _thanhtoan;
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;

		// case 'dang-ky':
		// 	$type = "dangky";
		// 	$title = _dangky;
		// 	$title_cat = _dangky;
		// 	$source = "dangky";
		// 	$template = "dangky";
		// 	break;

		// case 'dang-nhap':
		// 	$type = "dangnhap";
		// 	$title = _dangnhap;
		// 	$title_cat = _dangnhap;
		// 	$source = "dangnhap";
		// 	$template = "dangnhap";
		// 	break;

		// case 'quen-mat-khau':
		// 	$type = "quenmatkhau";
		// 	$title = _quenmatkhau;
		// 	$title_cat = _quenmatkhau;
		// 	$source = "quenmatkhau";
		// 	$template = "quenmatkhau";
		// 	break;

		case 'thay-doi-thong-tin':
			$type = "thaydoithongtin";
			$title = _thaydoithongtin;
			$title_cat = _thaydoithongtin;
			$source = "thaydoithongtin";
			$template = "thaydoithongtin";
			break;

		case 'don-hang-cua-ban':
			$title = 'Đơn hàng của bạn';
			$title_cat = 'Đơn hàng của bạn';
			$source = "myorder";
			$template = "myorder";
			break;

		case 'quan-tam':
			$title = 'Sản phẩm quan tâm';
			$title_cat = 'Sản phẩm quan tâm';
			$source = "sp_quantam";
			$template = "sp_quantam";
			break;


		case 'so-sanh':
			$title = 'So sánh sản phẩm';
			$title_cat = 'So sánh sản phẩm';
			$source = "sosanh";
			$template = "sosanh";
			break;

		case 'dang-xuat':
			unset($_SESSION['user_login']);
			redirect($http.$config_url);
			break;

		case 'ngonngu':
			if(isset($_GET['lang']))
			{
				switch($_GET['lang'])
					{
						case '':
							$_SESSION['lang'] = '';
							break;
						case 'en':
							$_SESSION['lang'] = 'en';
							break;
						default:
							$_SESSION['lang'] = '';
							break;
					}
			}
			else{
				$_SESSION['lang'] = '';
			}
		redirect($_SERVER['HTTP_REFERER']);
		break;

		default:
			$source = "index";
			$template = "index";
			break;
	}


	if($source!="") include _source.$source.".php";

	if(!empty($_REQUEST['com']) && $_REQUEST['com']=='logout')
	{
		session_unregister($login_name);
		header("Location:index.php");
	}

	$arr_wow =array("wow bounce","wow flash","wow pulse","wow rubberBand","wow shake","wow swing","wow tada","wow wobble","wow jello","wow bounceIn","wow bounceInDown","wow bounceInLeft","wow bounceInRight","wow bounceInUp","wow bounceOut","wow bounceOutDown","wow bounceOutLeft","wow bounceOutRight","wow bounceOutUp","wow fadeIn","wow fadeInDown","wow fadeInDownBig","wow fadeInLeft","wow fadeInLeftBig","wow fadeInRight","wow fadeInRightBig","wow fadeInUp","wow fadeInUpBig","wow fadeOut","wow fadeOutDown","wow fadeOutDownBig","wow fadeOutLeft","wow fadeOutLeftBig","wow fadeOutRight","wow fadeOutRightBig","wow fadeOutUp","wow fadeOutUpBig","wow flip","wow flipInX","wow flipInY","wow flipOutX","wow flipOutY");
?>
