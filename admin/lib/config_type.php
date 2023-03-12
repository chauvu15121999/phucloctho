<?php
		$type = (string)(isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
		$act = (string)(isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
		$act = explode('_',$act);
		if(count($act>1)){
			$act = $act[1];
		} else {
			$act = $act[0];
		}

$config['type'] = array();
switch($type){
//-------------san pham------------------
	case 'san-pham':
			switch($act){
				case 'danhmuc':
						$config['type'] = array('seo','ten','noibat','hinhanh');
						@define ( _width_thumb , 250 );
						@define ( _height_thumb , 250 );
						@define ( _style_thumb , 1 );
						break;
				case 'list':
						$config['type'] = array('seo','ten','noibat');
						break;
				case 'cat':
						$config['type'] = array('seo','ten');
						@define ( _width_thumb , 250 );
						@define ( _height_thumb , 200 );
						@define ( _style_thumb , 1 );
						break;

				default:
						$config['type'] = array('seo','ten','hinhanh','masp','gia','hinhthem','mota','noidung','noibat','sale','spbanchay','spmoi' ,'danhmuc','list','binhluan','cat'); //tags ,,'tags','mausac','size', download,link,'hot' , 'sale' ,'spbanchay' ,  'tieubieu','cat'
						@define ( _width_thumb , 180 );
						@define ( _height_thumb , 180 );
						@define ( _style_thumb , 2 );
						break;
			}
			break;
//-------------san pham------------------

//-------------tin tuc / dich vu------------------
	case 'why-huy':
			switch($act){
				default:
						$config['type'] = array('ten','no_tacgia');//,'tags' , 'download','link','icon'
						@define ( _width_thumb , 170 );
						@define ( _height_thumb , 130 );
						@define ( _style_thumb , 1 );
						break;
			}
			break;
	case 'htvc':
		switch($act){
			default:
					$config['type'] = array('ten','');//,'tags' , 'download','link','icon'
					@define ( _width_thumb , 170 );
					@define ( _height_thumb , 130 );
					@define ( _style_thumb , 1 );
					break;
		}
		break;
	case 'why-dk':
			switch($act){
				default:
						$config['type'] = array('ten','no_tacgia');//,'tags' , 'download','link','icon'
						@define ( _width_thumb , 170 );
						@define ( _height_thumb , 130 );
						@define ( _style_thumb , 1 );
						break;
			}
			break;
	case 'why-hd':
			switch($act){
				default:
						$config['type'] = array('ten','no_tacgia');//,'tags' , 'download','link','icon'
						@define ( _width_thumb , 170 );
						@define ( _height_thumb , 130 );
						@define ( _style_thumb , 1 );
						break;
			}
			break;

	case 'thong-bao':
	case 'ho-tro':
	case 'tin-tuc':
			switch($act){
				default:
						$config['type'] = array('seo','ten','hinhanh','mota','noidung','noibat');//,'tags' , 'download','link','icon'
						@define ( _width_thumb , 170 );
						@define ( _height_thumb , 130 );
						@define ( _style_thumb , 1 );
						break;
			}
			break;
	case 'tag-seo':
			switch($act){
				case 'list':
						$config['type'] = array('ten');
						break;
				default:
						$config['type'] = array('ten','danhmuc');//,'tags' , 'download','link','icon'
						@define ( _width_thumb , 170 );
						@define ( _height_thumb , 130 );
						@define ( _style_thumb , 1 );
						break;
			}
			break;
	case 'bai-viet':
			switch($act){
				default:
						$config['type'] = array('seo','ten','hinhanh','noidung','noibat','binhluan');//,'tags' , 'download','link','icon'
						@define ( _width_thumb , 30 );
						@define ( _height_thumb , 25 );
						@define ( _style_thumb , 2 );
						break;
			}
			break;
	case 'du-an':
			switch($act){
				default:
						$config['type'] = array('seo','ten','hinhanh','mota','hinhanh1','noidung','noibat','binhluan');//,'tags' , 'download','link','icon'
						@define ( _width_thumb , 170 );
						@define ( _height_thumb , 130 );
						@define ( _style_thumb , 2 );
						break;
			}
			break;case 'gioi-thieu':
			switch($act){
				default:
						$config['type'] = array('seo','ten','hinhanh','mota','noidung');//,'tags' , 'download','link','icon'
						@define ( _width_thumb , 170 );
						@define ( _height_thumb , 130 );
						@define ( _style_thumb , 2 );
						break;
			}
			break;
//-------------tin tuc------------------


//-------------chinh sach ------------------
	case 'chinh-sach-mua-hang':
			switch($act){
				default:
					$config['type'] = array('seo','ten','noidung','noibat','binhluan');
					break;
			}
			break;
//-------------tin tuc------------------


//-------------Dạng 1 bài viết------------------
	case 'baohanh':
	case 'giaohang':
	case 'bank':
	case 'doitra':
	case 'hung-vuong':
			switch($act){
				default:
					$config['type'] = array('seo','noidung'); //hinhanh,ten,mota,noidung
					@define ( _width_thumb , 30 );
					@define ( _height_thumb , 22 );
					@define ( _style_thumb , 2 );
					break;
			}
			break;
	case 'lienhe':
	case 'footer':
	case 'footer_mobile':
			switch($act){
				default:
						$config['type'] = array('noidung');
						break;
			}
			break;
//-------------Dạng 1 bài viết------------------
	case 'tieude1':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude2':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude3':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude4':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude5':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude6':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude7':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude8':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude9':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude10':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	case 'tieude11':
		switch($act){
			default:
				$config['type'] = array('ten');
			break;
		}
	break;
	
	case 'noidung1':
		switch($act){
			default:
				$config['type'] = array('ten','link','noidung');
			break;
		}
	break;
	case 'noidung2':
		switch($act){
			default:
				$config['type'] = array('ten','link','hinhanh','hinhanh2','noidung');
			break;
		}
	break;
	case 'noidung3':
		switch($act){
			default:
				$config['type'] = array('ten','link','hinhanh','noidung');
			break;
		}
	break;


//-------------Dạng 1 bài viết------------------

//-------------background------------------
	case 'pupop':
	case 'qc1':
	case 'qc2':
	case 'qc3':
	case 'qc4':
	case 'qc5':
	case 'congthuong':
			switch($act){
				default:
						$config['type'] = array('link');
						break;
			}
			break;
//-------------tin tuc------------------
	case 'newsletter':
			switch($act){
				default:
						$config['type'] = array('email');//,'ten','dienthoai','diachi','noidung'
						break;
			}
			break;

case 'mxh_top':
case 'mxh':
			switch($act){
				default:
						$config['type'] = array('ten','hinhanh','link');//'ten','hinhanh','link'
						break;
			}
			break;
case 'lkweb':
			switch($act){
				default:
						$config['type'] = array('ten','link');//'ten','hinhanh','link'
						break;
			}
			break;
			
case 'company':			
			default:
					$config['type'] = array('sp','spkhac','tin','tinkhac');//'giohoatdong','slogan','zalo','skype',
					break;
// ----------------------------------------------------------- Phương thức thanh toán ------------------------------------------------------- 
case 'payments':
	switch($act){
		default:
				$config['type'] = array('seo','ten','hinhanh','noidung','noibat','binhluan');//,'tags' , 'download','link','icon'
				@define ( _width_thumb , 30 );
				@define ( _height_thumb , 25 );
				@define ( _style_thumb , 2 );
				break;
	}
	break;
//--------------defaut main---------------
		
}
?>
