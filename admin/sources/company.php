<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "company/item_add";
		break;case "assets":
		
		$template = "company/assets";
		break;
	case "save":
		save_gioithieu();
		break;

	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;
	$sql = "select * from #_company limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;
	}
function save_gioithieu(){
	global $d,$config,$urlcu;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=company&act=capnhat".$urlcu);

	foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			$data['diachi'.$key] = $_POST['diachi'.$key];
			$data['slogan'.$key] = $_POST['slogan'.$key];
	}
	if($_POST['Latitude']!=0 and $_POST['Longitude']!=0){
			$toado=$_POST['Latitude'].','.$_POST['Longitude'];
			$data['toado'] = $toado;
		}
	$file_name = $_FILES['favicon']['name'];

	if($favicon = upload_image("favicon", _format_duoihinh,_upload_hinhanh,$file_name)){
			$data['favicon'] = $favicon;
			$data['faviconthumb'] = create_thumb($data['favicon'], 32, 32, _upload_hinhanh,$file_name,2);
			$d->setTable('company');
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['favicon']);
				delete_file(_upload_hinhanh.$row['faviconthumb']);
			}
	}
	if($img_hoa = upload_image("img_hoa", _format_duoihinh,_upload_hinhanh,$file_name.'img_hoa')){
			$data['img_hoa'] = $img_hoa;
			$d->setTable('company');
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['img_hoa']);
			}
	}
	if($sitemap = upload_image("sitemap", "xml|XML","../","sitemap")){
			$data['sitemap'] = $sitemap;
	}

	$data['mst'] = $_POST['mst'];
	$data['stk'] = $_POST['stk'];
	$data['dienthoai'] = $_POST['dienthoai'];
	$data['kho'] = $_POST['kho'];
	$data['copy'] = $_POST['copy'];
	$data['email'] = $_POST['email'];
	$data['website'] = $_POST['website'];
	$data['fax'] = $_POST['fax'];
	$data['fanpage'] = $_POST['fanpage'];
	$data['codethem'] = ($_POST['codethem']);
	$data['codethem2'] = ($_POST['codethem2']);
	$data['codethem3'] = ($_POST['codethem3']);
	$data['bando'] = $_POST['bando'];
	$data['zalo'] = $_POST['zalo'];
	$data['giohoatdong'] = $_POST['giohoatdong'];
	$data['soluong_sp'] = $_POST['soluong_sp'];
	$data['soluong_spk'] = $_POST['soluong_spk'];
	$data['soluong_tin'] = $_POST['soluong_tin'];
	$data['soluong_tink'] = $_POST['soluong_tink'];
	$data['lang_default'] = $_POST['lang_default'];
	$data['h1'] = $_POST['h1'];
	$data['h2'] = $_POST['h2'];
	$data['h3'] = $_POST['h3'];
	$data['youtube'] = $_POST['youtube'];
	$data['whatapp'] = $_POST['whatapp'];
	$data['skype'] = $_POST['skype'];
	$data['toptop'] = $_POST['toptop'];
	$data['appid_fb'] = $_POST['appid_fb'];
	$data['googlemap'] = $_POST['googlemap'];
	$data['title'] = ($_POST['title']);
	$data['keywords'] = ($_POST['keywords']);
	$data['description'] = ($_POST['description']);
	$data['hoaroi'] = isset($_POST['hoaroi']) ? 1 : 0;
	$d->reset();
	$d->setTable('company');
	if($d->update($data))
		transfer("Cập nhật dữ liệu Thành Công", "index.php?com=company&act=capnhat".$urlcu);
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=company&act=capnhat".$urlcu);
}

?>
