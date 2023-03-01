<?php 

	include ("ajax_config.php");
	$return = [];
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
	    if($rep->score >= 0.5 && $rep->action=='dangky' || $config['env'] == 'production') {
			$v = new Valitron\Validator($_POST);
			$v->rule('required', 'emailSignup')->message('Vui lòng nhập email');
			$v->rule('required','nameSignup')->message('Vui lòng nhập họ và tên');
			$v->rule('required', 'phoneSignup')->message('vui lòng nhập số điện thoại');
			$v->rule('required', 'passwordSignup')->message('vui lòng nhập password');
			$v->rule('required','confirmPasswordSignup')->message('vui lòng nhập lại password');
			$v->rule('equals', 'passwordSignup', 'confirmPasswordSignup')->message('password chưa trùng khớp');
			$v->rule('email', 'emailSignup')->message('vui lòng nhập đúng định dạng email');
			if($v->validate()) {
				$email = magic_quote($_POST['emailSignup']);
				$d->reset();
				$sql = "select * from #_thanhvien where email='".$email."'";
				$d->query($sql);
				$row = $d->fetch_array();
				if(!empty($row)){
					$return['status'] = 302;
					$return['message'] = array(
						'emailSignup' => array('Email đã tồn tại')
					);
				}else{
					$data = [];
					$mkn = magic_quote($_POST['passwordSignup']);
					$data['email'] = $email;
					$data['hoten'] = magic_quote($_POST['nameSignup']);
					$data['dienthoai'] = magic_quote($_POST['phoneSignup']);
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
					$return['status'] = 200;
					$return['message'] = 'Đăng ký thành công';
				}
			} else {
				// statuss
				$return['status'] = 500;
				$return['message'] = $v->errors();
			}	    	
		}else{
			$return['status'] = 500;
			$return['message'] = 'Vui lòng tải lại trang.';
		}
	}
	
	echo json_encode($return);
?>
