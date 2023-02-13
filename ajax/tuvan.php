<?php 
	error_reporting(1);
	include ("ajax_config.php");
	
	$ten = (string)trim(strip_tags($_POST['ten_lienhe']));
	$diachi = '';
	$dienthoai = (string)trim(strip_tags($_POST['dienthoai_lienhe']));
	$email = (string)trim(strip_tags($_POST['email_lienhe']));
	$tieude = 'Tư vấn';
	$noidung = (string)trim(strip_tags($_POST['noidung_lienhe']));
	
	$ip_host1 = '210.211.121.143';
	$mail_host1 = 'no-reply@hungvuongcoltd.com';
	$pass_mail1 = 'tOj9WxmGaE';


		
	if(!empty($_POST) && isset($_POST['recaptcha_response_footer'])){
	    $recaptchaName = $_POST['recaptcha_response_footer'];
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
	    if($rep->score >= 0.1 && $rep->action=='tuvan_footer') {
			
			$data['ten'.$lang] = $ten;
			$data['tenkhongdau'.$lang] = changeTitle($ten);
			$data['dienthoai'] = $dienthoai;
			$data['diachi'.$lang] = $diachi;
			$data['email'] = $email;
			$data['chude'.$lang] = $tieude;
			$data['noidung'.$lang] = $noidung;
			$data['hienthi'] = 0;
			$data['stt'] = 1;
			$data['type'] = 'tuvan';
			$d->setTable('lienhe');
			$d->insert($data);
			
			include_once "../sources/phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host1;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host1; // SMTP account username
			$mail->Password   = $pass_mail1;  
			
			//Thiết lập thông tin người gửi và email người gửi
			$mail->SetFrom($mail_host1,$ten);
	
			//Thiết lập thông tin người nhận và email người nhận
			$mail->AddAddress($company['email'], $company['ten']);
			
			//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($email,$ten);
	
			//Thiết lập file đính kèm nếu có
			if(!empty($_FILES['file']))
			{
				$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
			}
			
			//Thiết lập tiêu đề email
			$mail->Subject    = $tieude." - ".$ten;
			$mail->IsHTML(true);
			
			//Thiết lập định dạng font chữ tiếng việt
			$mail->CharSet = "utf-8";	
				$body = '<table>';
				$body .= '
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="2">Thư liên hệ từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
					</tr>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th>Họ tên :</th><td>'.$ten.'</td>
					</tr>
					<tr>
						<th>Email :</th><td>'.$email.'</td>
					</tr>
					<tr>
						<th>Điện thoại :</th><td>'.$dienthoai.'</td>
					</tr>
					<tr>
						<th>Nội dung :</th><td>'.$noidung.'</td>
					</tr>';
				$body .= '</table>';
				
				

				$mail->Body = $body;
				if($mail->Send())
				{
					$return['thongbao'] = 'Đăng ký tư vấn thành công';
					$return['nhaplai'] = 'nhaplai';
				}
				else
				{
					$return['thongbao'] = 'Đăng ký tư vấn thất bại';
					$return['nhaplai'] = '2';
				}		
	
		}else{
			$return['thongbao'] = 'Mã xác thực không đúng';
			$return['nhaplai'] = 'nhaplai';
		}
	}
	echo json_encode($return);
?>
