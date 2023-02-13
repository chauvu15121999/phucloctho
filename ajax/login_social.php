<?php
	include ("ajax_config.php");
	
	$email=$_POST['mail'];
	$d->reset();
	$sql="select * from table_thanhvien where email='".$email."'";
	$d->query($sql);
	$thanhvien_face=$d->result_array();

	if(count($thanhvien_face)>0){
		$d->reset();
		$sql="select * from #_thanhvien where email='".$_POST['mail']."'";
		$d->query($sql);
		$row=$d->fetch_array();
		
		$_SESSION['user_login']['id'] = $row['id'];
		$_SESSION['user_login']['email'] = $row['email'];
		$_SESSION['user_login']['hoten'] = $row['hoten'];
		$_SESSION['user_login']['dienthoai'] = $row['dienthoai'];

		echo json_encode($_SESSION['user_login']);
		die();
		
	}else{

    	$data['email'] = $_POST['mail'];
		$data['hoten'] = magic_quote($_POST['name']);
		$data['dienthoai'] = '';
		$data['password'] = '';
		$data['ngaytao'] = time();
		$data['active'] = 1;
		$d->setTable('thanhvien');
		if($d->insert($data)){
			$id_insert=mysql_insert_id();
			
			$md5_user = md5('!@#'.$id_insert.$_POST['mail']);
			$d->reset();
			$sql = "update table_thanhvien set md5_key='$md5_user' where id=$id_insert";
			$d->query($sql);

			$_SESSION[$login_name] = true;
			$_SESSION['user_login']['id'] = $id_insert;
			$_SESSION['user_login']['hoten'] = $data['hoten'];
			$_SESSION['user_login']['email'] = $data['email'];
			$_SESSION['user_login']['dienthoai'] = '';
		}


		echo json_encode($_SESSION['user_login']);
		die();
	}
?>