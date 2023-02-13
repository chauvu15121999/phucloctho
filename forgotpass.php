<?php
	session_start();
	$session=session_id();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');

	$lang_default = array("","en");
	if(!isset($_SESSION['lang']) or !in_array($_SESSION['lang'], $lang_default))
	{
		$_SESSION['lang'] = '';
	}
	$lang = $_SESSION['lang'];
	require_once _source."lang$lang.php";
	include_once _lib."config.php";
	$config['arrayDomainSSL']=array("www.hungvuongcoltd.com");
	include_once _lib."checkSSL.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _lib."file_requick.php";
	include_once _source."counter.php";
	include_once "vendor/autoload.php";
	include_once _lib."breadcrumb.php";
	$bread = new breadcrumb();

	$id = magic_quote($_GET['uid']);
	$key = magic_quote($_GET['key']);

	$d->reset();
	$sql = "select email,hoten,md5_key from table_thanhvien where id=$id";
	$d->query($sql);

	$row = $d->fetch_array();

	if(!empty($row)){

		if($key==$row['md5_key']){

			function unique_id($l = 6) {
			    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
			}

			$ran = unique_id();

			$pass_new = encrypt_password($config['salt_sta'],$ran,$config['salt_end']);

			$d->reset();

			$sql = "UPDATE table_thanhvien SET password='$pass_new' WHERE id=$id";

			if($d->query($sql)){

				include_once "phpMailer/class.phpmailer.php";

				

				include_once "./sources/phpMailer/class.phpmailer.php";
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

				


				//Thiết lập tiêu đề
				$mail->Subject    =  'Cấp lại mật khẩu Website '.$config_url;

				$mail->IsHTML(true);

				//Thiết lập định dạng font chữ

				$mail->CharSet = "utf-8";

				$body = '<div style="padding: 15px; line-height: 35px; font-size: 14px;">';

				$body .= '<div>'.'Xin chào '.$row['hoten'].',</div>';

				$body .= '<div>Hệ thống đã reset lại mật khẩu cho bạn như sau:</div>';

				$body .= '<div>Password: '.$ran.'</div>';

				$body .= '<div style="color:red;">Lưu ý: Nên đổi lại mật khẩu của bạn khi đăng nhập vào Website.</div>';

				$body .= '</div>';

				$mail->Body = $body;
				$mail->Send();

				transfer('Mật khẩu mới đã được gửi vào email của bạn. Vui lòng kiểm tra hợp thư email của bạn.', $http.$config_url);

			}

		

		}else{

			transfer('Đường link không hợp lệ. Vui lòng kiểm tra lại.', $http.$config_url);

		}

	}else{

		transfer('Tài khoản không tồn tại. Vui lòng kiểm tra lại tài khoản.', $http.$config_url);

	}

?>