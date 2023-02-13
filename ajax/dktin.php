<?php 
	include ("ajax_config.php");
	
	$ten = trim(strip_tags($_POST['ten_lienhe']));
	$dienthoai = trim(strip_tags($_POST['dienthoai_lienhe']));
	$email = trim(strip_tags($_POST['email_lienhe']));
	$tieude = 'Đăng ký nhận tin';
	$noidung = trim(strip_tags($_POST['noidung_lienhe']));
	
	if($ten!=''&&$dienthoai!=''&&$email!=''&&$tieude!=''&&$noidung!=''){
		
			$data['ten'.$lang] = $ten;
			$data['tenkhongdau'.$lang] = changeTitle($ten);
			$data['dienthoai'] = $dienthoai;
			$data['email'] = $email;
			$data['chude'.$lang] = $tieude;
			$data['noidung'.$lang] = $noidung;
			$data['hienthi'] = 0;
			$data['stt'] = 1;
			$data['type'] = 'nhantin';
			$d->setTable('lienhe');
			$d->insert($data);
						
			$data_k['email'] = $email;
			$d->setTable('newsletter');
			$d->insert($data_k);
			
			include_once "../sources/phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;  
	
			//Thiết lập thông tin người gửi và email người gửi
			$mail->SetFrom($mail_host,$ten);
	
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
						<th colspan="2">Thư đăng ký nhận tin từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
					</tr>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th>Họ tên :</th><td>'.$ten.'</td>
					</tr>
					<tr>
						<th>Điện thoại :</th><td>'.$dienthoai.'</td>
					</tr>
					<tr>
						<th>Email :</th><td>'.$email.'</td>
					</tr>
					<tr>
						<th>Nội dung :</th><td>'.$noidung.'</td>
					</tr>';
				$body .= '</table>';

				$mail->Body = $body;
				if($mail->Send())
				{
					$return['thongbao'] = 'Đăng ký nhận tin thành công';
					$return['nhaplai'] = 'nhaplai';
				}
				else
				{
					$return['thongbao'] = 'Đăng ký nhận tin thất bại';
					$return['nhaplai'] = '2';
				}
	}
	echo json_encode($return);
?>
