<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$login_name_admin = md5($config['salt_sta'].$config['salt_end']);
	$d = new database($config['database']);
	$do = (isset($_REQUEST['do'])) ? addslashes($_REQUEST['do']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	if($do=='admin'){
		if($act=='login'){
			$username = (string)$_POST['email'];
			$password = (string)$_POST['pass'];

			$sql = "select * from #_user where username='".$username."'";
			// $sql = "select * from #_user where id=3";
			$d->query($sql);
			
			if($d->num_rows() == 1){
				$row = $d->fetch_array();
				// if(1){
					#echo encrypt_password($config['salt_sta'],$password,$config['salt_end']);die;
				#$d->query("update #_user set password='".encrypt_password($config['salt_sta'],$password,$config['salt_end'])."' where username='$username'");
				if($row['password'] == encrypt_password($config['salt_sta'],$password,$config['salt_end'])){
					$_SESSION[$login_name_admin] = true;
					$_SESSION['login_admin']['role'] = $row['role'];
					$_SESSION['login_admin']['nhom'] = $row['nhom'];
					$_SESSION['login_admin']['com'] = $row['com'];
					$_SESSION['isLoggedIn'] = true;
					$_SESSION['login_admin']['username'] = $username;
					$_SESSION['login_admin']['name'] = $row['ten'];
					$_SESSION['ck'] = $config_url;
					echo '{"page":"index.php"}';
				}else echo '{"mess":"Mật khẩu không chính xác!"}';
			}else
			echo '{"mess":"Tên đăng nhập không tồn tại!"}';
		}
	}

	//Cap nhat so thu tu
	if($do=='number'){
		if($act=='update'){
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);;
			$num=(int)$_POST['num'];
			$sql="update #_$table set stt='$num' where id='$id' ";
			$d->query($sql);
		}
	}

	//Cap nhat trang thai
	if($do=='status'){
		if($act=='update'){
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);
			$field=addslashes($_POST['field']);
			$d->reset();
			$sql="update #_$table set $field =  where id='$id' ";

			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($id_cart));
			echo json_encode($cart);
		}
	}

	//Cap nhat gio hang
	if($do=='cart'){
		if($act=='update'){
			$phi_vanchuyen = (int)$_POST['phi_vanchuyen'];
			$id=(int)$_POST['id'];
			$sl=(int)$_POST['sl'];

			$d->reset();
			$d->query("update #_chitietdonhang set soluong='".$sl."' where id='".$id."'");

			$d->reset();
			$sql="select * from #_chitietdonhang where id='".$id."'";
			$d->query($sql);
			$result=$d->fetch_array();
			if($result['tiente']==2){
				$currency='usd';
			}else{
				$currency='vnđ';
			}	
			
			$thanhtien=$result['gia']*$result['soluong'];
			
			$thanhtien=number_format($thanhtien,0,'.',',').' '.$currency;
			
			$tongtien_vnđ=get_tong_tien($result['madonhang']);
			if($tongtien_vnđ<=0){
				$tongtien_vnđ=0;
			}else{
				$tongtien_vnđ+=$phi_vanchuyen;
			}
			$tongtien_usd=get_tong_tien_usd($result['madonhang']);
			
			$tongtien= number_format($tongtien_vnđ,0,'.',',').' vnđ + '.number_format($tongtien_usd,0,'.',',').' usd';
			

			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>$tongtien);

			$d->reset();
			$d->query("update #_donhang set tonggia='".$tongtien_vnđ."',tonggia_usd='".$tongtien_usd."' where madonhang='".$result['madonhang']."'");

			echo json_encode($cart);
		}
	}

	//Xoa gio hang
	if($do=='cart'){
		if($act=='delete'){

			$phi_vanchuyen = (int)$_POST['phi_vanchuyen'];

			$id=(int)$_POST['id'];
			$id_order=(int)$_POST['id_order'];
			$d->reset();
			$d->query("delete from #_chitietdonhang where id='".$id."'");

			$d->reset();
			$sql="select * from #_chitietdonhang where id='".$id."'";
			$d->query($sql);
			$result=$d->fetch_array();

			$tongtien_vnđ=get_tong_tien($result['madonhang']);
			$tongtien_usd=get_tong_tien_usd($result['madonhang']);
			
			$tongtien= number_format($tongtien_vnđ,0,'.',',').' vnđ + '.number_format($tongtien_usd,0,'.',',').' usd';
			
			$d->reset();
			$d->query("update #_donhang set tonggia='".$tongtien_vnđ."',tonggia_usd='".$tongtien_usd."' where id='".$id_order."'");

			$cart=array('tongtien'=>$tongtien);
			echo json_encode($cart);

		}
	}

	//Xoa tag san pham
	if($do=='products'){
		if($act=='tags'){
			$uni_tag = $_POST['uni_tag'];
			$id=(int)$_POST['id'];
			$d->reset();
			$d->query("delete from #_tag where item_id='".$id."' and  	unique_key_tag='$uni_tag'");
		}
	}
?>
