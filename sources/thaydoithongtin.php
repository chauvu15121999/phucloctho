<?php  if(!defined('_source')) die("Error");
	
	if(empty($_SESSION['user_login']))
	{
		transfer('Vui lòng đăng nhập vào website.', $http.$config_url);
	}
	
	$d->reset();
	$sql = "select * from #_thanhvien where id='".$_SESSION['user_login']['id']."' limit 0,1";
	$d->query($sql);
	$info_user = $d->fetch_array();
	
	#Thông tin seo web
	$title_cat = _thaydoithongtin;		
	
	if(!empty($_POST) && !empty($info_user)){

		if($_POST['matkhaucu']!='')
		{
			$password_new = encrypt_password($config['salt_sta'],$_POST['matkhaucu'],$config['salt_end']);
			$data['password'] = encrypt_password($config['salt_sta'],$_POST['matkhau'],$config['salt_end']);
			$sql = "select id,password from #_thanhvien where id='".$info_user['id']."' and password='".$password_new."'";
			$d->query($sql);
			if($d->num_rows() != 1)
			{
				transfer('Mật khẩu cũ không chính xác.','thay-doi-thong-tin.html');
			}
		}

		$data['hoten'] = (string)magic_quote(trim(strip_tags($_POST['ten_lienhe'])));
		// $data['diachi'] = (string)magic_quote(trim(strip_tags($_POST['diachi_lienhe'])));
		$data['dienthoai'] = (string)magic_quote(trim(strip_tags($_POST['dienthoai_lienhe'])));
		
		$d->setTable('thanhvien');
		$d->setWhere('id', $info_user['id']);
		$d->update($data);
		if(!empty($_POST['matkhaucu'])){
			unset($_SESSION[$login_name]);
			unset($_SESSION['user_login']);
			transfer('Đã cập nhật thông tin.','index.html');
		}else{
			$_SESSION['user_login']['hoten'] = $data['hoten'];
			$_SESSION['user_login']['dienthoai'] = $data['dienthoai'];
		}
		transfer('Đã cập nhật thông tin.','thay-doi-thong-tin.html');
	}
?>
