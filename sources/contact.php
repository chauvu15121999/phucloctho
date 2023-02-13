<?php  if(!defined('_source')) die("Error");

	$title_cat = _lienhe;	
	$title = $company_contact['title'];
	$keywords = $company_contact['keywords'];
	$description = $company_contact['description'];	
	
	if(!empty($_POST)){
		if(strtoupper($_POST['capcha']) != $_SESSION['key'])
		{
			$loicapcha = _mabaovesai;
		}
		else
		{
			include_once "phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;  
	
			//Thiết lập thông tin người gửi và email người gửi
			$mail->SetFrom($mail_host,$_POST['ten_lienhe']);
	
			//Thiết lập thông tin người nhận và email người nhận
			$mail->AddAddress($company['email'], $company['ten']);
			
			//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($_POST['email_lienhe'],$_POST['ten_lienhe']);
	
			//Thiết lập file đính kèm nếu có
			if(!empty($_FILES['file']))
			{
				$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
			}
			
			//Thiết lập tiêu đề email
			$mail->Subject    = $_POST['tieude_lienhe']." - ".$_POST['ten_lienhe'];
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
						<th>Họ tên :</th><td>'.$_POST['ten_lienhe'].'</td>
					</tr>
					<tr>
						<th>Địa chỉ :</th><td>'.$_POST['diachi_lienhe'].'</td>
					</tr>
					<tr>
						<th>Điện thoại :</th><td>'.$_POST['dienthoai_lienhe'].'</td>
					</tr>
					<tr>
						<th>Email :</th><td>'.$_POST['email_lienhe'].'</td>
					</tr>
					
					<tr>
						<th>Tiêu đề :</th><td>'.$_POST['tieude_lienhe'].'</td>
					</tr>
					<tr>
						<th>Nội dung :</th><td>'.$_POST['noidung_lienhe'].'</td>
					</tr>';
				$body .= '</table>';
				
				$mail->Body = $body;
				if($mail->Send())
					transfer(_guilienhethanhcong, "index.html");
				else
					transfer(_guilienhethatbai, "lien-he.html");
		}
	}			
?>
