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
	    if($rep->score >= 0.5 && $rep->action=='login' || $config['env'] == 'production') {
			$v = new Valitron\Validator($_POST);
			$v->rule('required', 'emailLogin')->message('Vui lòng nhập email');
			$v->rule('required', 'passwordLogin')->message('vui lòng nhập password');
			$v->rule('email', 'emailLogin')->message('vui lòng nhập đúng định dạng email');
	    	$email = magic_quote($_POST['emailLogin']);
			$password = magic_quote($_POST['passwordLogin']);
			if($v->validate()) {
				$d->reset();
				$sql = "select * from #_thanhvien where email='".$email."'";
				$d->query($sql);
				$row = $d->fetch_array();
				if(!empty($row)){
					if($row['password'] == encrypt_password($config['salt_sta'],$password,$config['salt_end']))
					{
						$_SESSION[$login_name] = true;
						$_SESSION['user_login']['id'] = $row['id'];
						$_SESSION['user_login']['hoten'] = $row['hoten'];
						$_SESSION['user_login']['email'] = $row['email'];
						$_SESSION['user_login']['dienthoai'] = $row['dienthoai'];

						$return['status'] = 200;
						$return['message'] = 'Đăng nhập thành công';
					}
					else
					{
						$return['status'] = 400;
						$return['message'] = array(
							'passwordLogin' => array('Mật khẩu không chính xác.')
						);
					}
				}else{
					$return['status'] = 302;
					$return['message'] = array(
						'emailLogin' => array('Tài khoản không tồn tại. Vui lòng kiểm tra lại email.'),
						'passwordLogin' => array('')
					);
				}
			} else {
				$return['status'] = 500;
				$return['message'] = $v->errors();
			}
		}else{
			$return['status'] = 500;
			$return['mess'] = 'Vui lòng tải lại trang để đăng nhập lại.';
		}
	}
	
	echo json_encode($return);
?>
