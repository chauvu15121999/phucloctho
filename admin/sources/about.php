<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_item();
		$template = "about/item_add";
		break;

	case "save":
		save_item();
		break;

	default:
		$template = "index";
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;
	}

function get_item(){
	global $d, $item;

	$sql = "select * from #_about where type='".$_REQUEST['type']."' limit 0,1";
	$d->query($sql);
	if($d->num_rows()==0)
	{
		$data['hienthi'] = '1';
		$data['ngaytao'] = time();
		$data['type'] = $_REQUEST['type'];

		$d->setTable('about');
		if($d->insert($data))
			transfer("Dữ liệu được khởi tạo","index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
		else
			transfer("Khởi tạo dữ liệu lỗi","index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
	}
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;

	$file_name = $_FILES['file']['name'];
	$file_name2 = $_FILES['file2']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);

	if($photo = upload_image("file", _format_duoihinh,_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			if(_width_thumb > 0 and _height_thumb > 0)
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);
			$d->setTable('about');
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
				delete_file(_upload_hinhanh.$row['thumb']);
			}
		}

		if($photo2 = upload_image("file2", _format_duoihinh,_upload_hinhanh,$file_name2)){
			$data['photo2'] = $photo2;
			if(_width_thumb > 0 and _height_thumb > 0)
			$data['thumb2'] = create_thumb($data['photo2'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name2,_style_thumb);
			$d->setTable('about');
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo2']);
				delete_file(_upload_hinhanh.$row['thumb2']);
			}
		}

	$data['tenkhongdau'] = changeTitle($_POST['ten']);
	$data['link'] = $_POST['link'];
	$data['title'] = $_POST['title'];
	$data['keywords'] = $_POST['keywords'];
	$data['description'] = $_POST['description'];
	$data['h1'] = $_POST['h1'];
	$data['h2'] = $_POST['h2'];
	$data['h3'] = $_POST['h3'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['ngaysua'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			$data['mota'.$key] = ($_POST['mota'.$key]);
			$data['noidung'.$key] = ($_POST['noidung'.$key]);
		}

	$d->reset();
	$d->setTable('about');
	$d->setWhere('type', $_REQUEST['type']);
	if($d->update($data)){
		if($_REQUEST['type']=='lienhe' || $_REQUEST['type']=='footer' || $_REQUEST['type']=='footer_mobile' || $_REQUEST['type']=='hung-vuong'){
			transfer("Dữ liệu được cập nhật", "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
		}else{
			transfer("Dữ liệu được cập nhật", $_SESSION['backlink']);
		}
	}else{
		
		if($_REQUEST['type']=='lienhe' || $_REQUEST['type']=='footer' || $_REQUEST['type']=='footer_mobile' || $_REQUEST['type']=='hung-vuong'){
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
		}else{
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['backlink']);
		}
		
	}
}

?>
