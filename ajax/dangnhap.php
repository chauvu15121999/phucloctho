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
	    if($rep->score >= 0.5 && $rep->action=='login') {

	    	$email_dn = magic_quote($_POST['email_dn']);
			$pass_dn = magic_quote($_POST['pass_dn']);

			$d->reset();
			$sql = "select * from #_thanhvien where email='".$email_dn."'";
			$d->query($sql);
			$row = $d->fetch_array();
			if(!empty($row)){
				if($row['password'] == encrypt_password($config['salt_sta'],$pass_dn,$config['salt_end']))
				{
					$_SESSION[$login_name] = true;
					$_SESSION['user_login']['id'] = $row['id'];
					$_SESSION['user_login']['hoten'] = $row['hoten'];
					$_SESSION['user_login']['email'] = $row['email'];
					$_SESSION['user_login']['dienthoai'] = $row['dienthoai'];

					$return['error'] = 0;
					$return['mess'] = '';
				}
				else
				{
					$return['error'] = 1;
					$return['mess'] = 'Mật khẩu không chính xác';
				}
			}else{
				$return['error'] = 1;
				$return['mess'] = 'Tài khoản không tồn tại. Vui lòng kiểm tra lại tài khoản.';
			}

		}else{
			$return['error'] = 1;
			$return['mess'] = 'Vui lòng tải lại trang để đăng nhập lại.';
		}
	}
	
	echo json_encode($return);
?>
