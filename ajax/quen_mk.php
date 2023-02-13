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
	    if($rep->score >= 0.5 && $rep->action=='quenmk') {

	    	$email = magic_quote($_POST['email_quenmk']);

			$d->reset();
			$sql = "select * from #_thanhvien where email='".$email."'";
			$d->query($sql);
			$row = $d->fetch_array();
			if(!empty($row)){

				

				include_once "../sources/phpMailer/class.phpmailer.php";
				$mail = new PHPMailer();
				$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
				$mail->Host       = $ip_host;   // tên SMTP server
				$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
				$mail->Username   = $mail_host; // SMTP account username
				$mail->Password   = $pass_mail;

				//Thiết lập thông tin người gửi và email người gửi
				$mail->SetFrom($mail_host,$company['ten']);

				//Thiết lập thông tin người nhận và email người nhận
				$mail->AddAddress($row['email'], $row['hoten']);

				//Thiết lập tiêu đề email
				$mail->Subject    = $company['ten']." xin cung cấp lại thông tin tài khoản của bạn trên website ".$_SERVER["SERVER_NAME"];
				$mail->IsHTML(true);

				//Thiết lập định dạng font chữ tiếng việt
				$mail->CharSet = "utf-8";
				$body = 'Xin chào '.$row['hoten'].',';
				$body .= '<br/>';
				$body .= 'Bạn vừa thực hiện yêu cầu lấy lại mật khẩu. Để hoàn tất việc lấy lại mật khẩu, vui lòng nhấn vào đường dẫn dưới đây hoặc chép và dán vào trình duyệt:';
				$body .= '<br/>';
				$body .= '<a href="'.$http.$config_url.'/forgotpass.php?uid='.$row['id'].'&key='.$row['md5_key'].'" target="_blank">'.$http.$config_url.'/forgotpass.php?uid='.$row['id'].'&key='.$row['md5_key'].'</a>';
				$body .= '<br/>';
				$body .= 'Nếu không phải bạn thực hiện, vui lòng <b>KHÔNG</b> nhấn vào đường dẫn trên.';

				$mail->Body = $body;
				if($mail->Send()){
					$return['error'] = 0;
					$return['mess'] = 'Chúng tôi đã gửi đường link reset lại mật khẩu vào email '.$email.' của bạn. Vui lòng làm theo hướng dẫn trong mail để lấy lại mật khẩu. Cảm ơn.';
				}else{
					$return['error'] = 1;
					$return['mess'] = 'Hệ thống gửi mail đang được bảo trì';
				}

			}else{
				$return['error'] = 1;
				$return['mess'] = 'Tài khoản không tồn tại. Vui lòng kiểm tra lại tài khoản.';
			}



		}else{
			$return['error'] = 1;
			$return['mess'] = 'Vui lòng tải lại trang.';
		}
	}
	
	echo json_encode($return);
?>
