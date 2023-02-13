<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

switch($act){
	case "man":
		get_items();
		$template = "thanhvien/items";
		break;
	case "add":
		$template = "thanhvien/item_add";
		break;
	case "edit":
		get_item();
		$template = "thanhvien/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	default:
		$template = "index";
}

//////////////////
function get_items(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

	/* if($_SESSION['login']['role']!='3'){
		transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */

	if($_REQUEST['key']!='')
	{
		$where.=" and (hoten like '%".$_REQUEST['key']."%' or dienthoai like '%".$_REQUEST['key']."%')";
	}
	$where.=" order by ngaytao desc";

	$sql="SELECT count(id) AS numrows FROM #_thanhvien where id<>0 $where";
	$d->query($sql);
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];

	$pageSize=20;
	$offset=10;

	if ($page=="")
		$page=1;
	else
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;

	$sql = "select * from #_thanhvien where id<>0 $where limit $bg,$pageSize";
	$d->query($sql);
	$items = $d->result_array();
	$url_link="index.php?com=thanhvien&act=man".$urlcu;
}

function get_item(){
	global $d, $item;

	/* if($_SESSION['login_admin']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");

	$sql = "select * from #_thanhvien where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=thanhvien&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d, $item, $login_name_admin,$config;
	/* if($_SESSION['login_admin']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id){ // cap nhat
		$id =  themdau($_POST['id']);

		if($_POST['oldpassword']!=""){
			$data['password'] = encrypt_password($config['salt_sta'],$_POST['oldpassword'],$config['salt_end']);
		}
		// $data['email'] = $_POST['email'];
		$data['hoten'] = $_POST['ten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		// $data['role'] = (int)$_POST['role'];

		$d->reset();
		$d->setTable('thanhvien');
		$d->setWhere('id', $id);
		//$d->setWhere('role', 1);
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=thanhvien&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");

	}else{ // them moi

		if($_POST['oldpassword']=="") transfer("Chưa nhập mật khẩu", "index.php?com=thanhvien&act=add");

		$data['password'] = encrypt_password($config['salt_sta'],$_POST['oldpassword'],$config['salt_end']);
		$data['email'] = $_POST['email'];
		$data['hoten'] = $_POST['ten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		// $data['role'] = (int)$_POST['role'];
		$data['ngaytao'] = time();

		$d->setTable('thanhvien');
		if($d->insert($data)){

			transfer("Dữ liệu đã được lưu", "index.php?com=thanhvien&act=man");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");
	}
}

function delete_item(){
	global $d, $item, $login_name_admin,$config,$urlcu;
	if($_SESSION['login_admin']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	}
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);

		// xoa item
		$sql = "delete from #_thanhvien where id='".$id."'";
		if($d->query($sql))
			transfer("Dữ liệu đã được xóa", "index.php?com=thanhvien&act=man".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=thanhvien&act=man".$urlcu);
	
	}elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']);
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i];
			$id =  themdau($idTin);
			
			$sql = "delete from #_thanhvien where id='".$id."'";
			$d->query($sql);
		}		
		redirect("index.php?com=thanhvien&act=man".$urlcu);
		}else transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man".$urlcu);
}
?>
