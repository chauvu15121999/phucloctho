<?php 

	include ("ajax_config.php");
	
	if(!empty($_POST) && !empty($_POST['recaptcha_response'])){
	    $recaptchaName = $_POST['recaptcha_response'];
	    $req = array(
            'secret' => $secret_key,
            'response' => $recaptchaName
        );
		$verify = curl_init();
		curl_setopt($verify, CURLOPT_URL, $api_url);
		curl_setopt($verify, CURLOPT_POST, true);
		curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($req));
		curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
		$rep = curl_exec($verify);
		curl_close($rep);
	    $rep = json_decode($rep);
	    if($rep->score >= 0.5 && $rep->action=='dangky') {

	    	
	    	$email_dk = magic_quote($_POST['email_dk']);


			$d->reset();
			$sql = "select * from #_thanhvien where email='".$email_dk."'";
			$d->query($sql);
			$row = $d->fetch_array();
			if(!empty($row)){
				
				$return['error'] = 1;
				$return['mess'] = 'Email đã tồn tại vui lòng nhập email khác.';

			}else{

				$mkn = magic_quote($_POST['pass_dk']);
		    	$data['email'] = $email_dk;
				$data['hoten'] = magic_quote($_POST['hoten_dk']);
				$data['dienthoai'] = magic_quote($_POST['dienthoai_dk']);
				$data['password'] = encrypt_password($config['salt_sta'],$mkn,$config['salt_end']);
				$data['ngaytao'] = time();
				$data['active'] = 1;
				$d->setTable('thanhvien');
				if($d->insert($data)){
					$id_insert=mysql_insert_id();
					
					$md5_user = md5('!@#'.$id_insert.$email_dk);
					$d->reset();
					$sql = "update table_thanhvien set md5_key='$md5_user' where id=$id_insert";
					$d->query($sql);

					$_SESSION[$login_name] = true;
					$_SESSION['user_login']['id'] = $id_insert;
					$_SESSION['user_login']['hoten'] = $data['hoten'];
					$_SESSION['user_login']['email'] = $data['email'];
					$_SESSION['user_login']['dienthoai'] = $data['dienthoai'];
				}

				$return['error'] = 0;
				$return['mess'] = '';
			}

		}else{
			$return['error'] = 1;
			$return['mess'] = 'Vui lòng tải lại trang.';
		}
	}
	
	echo json_encode($return);
?>
