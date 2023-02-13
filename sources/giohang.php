<?php  if(!defined('_source')) die("Error");	
	//dump($_SESSION['cart']);
	//unset($_SESSION['cart']);
	if(count($_SESSION['cart'])>0){

		$vtp = new ViettelPost();

		#Lấy thông tin user nếu đã đăng nhập
		$d->reset();
		$sql_info_user = "select * from #_thanhvien where id='".$_SESSION['user_login']['id']."'";
		$d->query($sql_info_user);
		$info_user = $d->fetch_array();
		
		#Lấy tỉnh thành phố
		// $d->reset();
		// $sql = "select id,ten from #_place_city where hienthi=1 order by stt,id desc";
		// $d->query($sql);
		// $place_city = $d->result_array();

		$arr_get1 = $vtp->getProvince();
		$place_city = $arr_get1['data'];

		
		#Lấy httt
		$d->reset();
		$sql = "select id,ten$lang as ten from #_httt where hienthi=1 order by stt,id desc";
		$d->query($sql);
		$get_httt = $d->result_array();


				$d->reset();
	$sql = "select id,ten from #_news where type='htvc' and hienthi > 0 order by stt asc,id desc";
	$d->query($sql);
	$hinhthuc_vc = $d->result_array();	

		#Nếu click thanh toán thành công
		//if(!empty($_POST) && isset($_POST['recaptcha_response_order'])){
		if(!empty($_POST)){
		   /* $recaptchaName = $_POST['recaptcha_response_order'];
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
		    $rep = json_decode($rep);*/
		    if(1) {
		
			#Lấy thông tin đơn hàng
			$httt = $_POST['httt'];
			$htvc = $_POST['htvc'];
			$hoten = $_POST['hoten'];
			$dienthoai = $_POST['dienthoai'];
			$thanhpho = (int)$_POST['thanhpho'];
			$quan = (int)$_POST['quan'];
			$phuong = (int)$_POST['phuong'];
			$phi_vanchuyen = (float)$_POST['phi_vanchuyen'];
			$diachi = $_POST['diachi'];
			$email = $_POST['email'];
			$noidung = $_POST['noidung'];
			$ip = getRealIPAddress();
			$id_user = $_SESSION['user_login']['id'];
			$diachi_txt = $diachi.', '.$_POST['diachi_txt'];
			
			//validate dữ liệu
			$httt = (int)$httt;
			$hoten = trim(strip_tags($hoten));
			$dienthoai = trim(strip_tags($dienthoai));	
			$diachi = trim(strip_tags($diachi));	
			$email = trim(strip_tags($email));	
			$noidung = trim(strip_tags($noidung));

			$hoten = mysql_real_escape_string($hoten);
			$dienthoai = mysql_real_escape_string($dienthoai);
			$diachi = mysql_real_escape_string($diachi);
			$email = mysql_real_escape_string($email);
			$noidung = mysql_real_escape_string($noidung);	
			$diachi_txt = mysql_real_escape_string($diachi_txt);	
			$tonggia = get_order_total();				

			$ngaydangky = time();
			$ngaycapnhat = time();	
			
			$coloi = false;		
			if ($hoten == NULL) { 
				$coloi=true; $error = _nhaphoten;
			} 
			if ($dienthoai == NULL) { 
				$coloi=true; $error = _nhapsodienthoai;
			}
			if ($thanhpho == NULL) { 
				$coloi=true; $error = _nhaptinhthanhpho;
			}
			if ($quan == NULL) { 
				$coloi=true; $error = _nhapquanhuyen;
			}
			if ($diachi == NULL) { 
				$coloi=true; $error = _nhapdiachi;
			}
			
			#Nếu không điền đầy đủ thông tin cần thiết
			if($coloi==true)
			{
				transfer(_vuilongdiendayduthongtin, "gio-hang.html");
			}
			
			#Nếu điền đầy đủ thông tin cần thiết
			if ($coloi==false) 
			{	
			
				#Mẫu mã đơn hàng VD:05032016NN101
				$donhangmau = date('dmY').'NN';
				
				#Kiểm tra mã đơn hàng lớn nhất trong ngày
				$d->reset();
				$sql = "select id,madonhang from #_donhang where madonhang like '$donhangmau%' order by id desc limit 0,1";
				$d->query($sql);
				$max_order = $d->fetch_array();
				
				#Nếu không tồn tại đơn hàng nào trong ngày hôm nay
				if(empty($max_order['id']))
				{
					$songaunhien = 101;
				}
				else
				{
					(int)$songaunhien =  substr($max_order['madonhang'],10)+1;
				}
				#Mã đơn hàng của đơn hàng hiện tại là
				$madonhang = date('dmY').'NN'.$songaunhien;
				//dump($tonggia);
				$sql = "INSERT INTO  table_donhang (httt,htvc,madonhang,hoten,dienthoai,diachi,email,tonggia,noidung,ngaytao,tinhtrang,ngaycapnhat,ip,id_user,phi_vanchuyen,diachi_txt,id_tinhthanh,id_quan,id_phuong) 
				  VALUES ('$httt','$htvc','$madonhang','$hoten','$dienthoai','$diachi','$email','$tonggia','$noidung','$ngaydangky','1','$ngaycapnhat','$ip','$id_user','$phi_vanchuyen','$diachi_txt','$thanhpho','$quan','$phuong')";

			 
			#Nếu insert bảng đơn hàng thành công thì tiếp tự insert vào bảng chi tiết đơn hàng
			if(mysql_query($sql))
			{
				if(is_array($_SESSION['cart']))
				{
					$max = count($_SESSION['cart']);
					$coloi = false;
					for($i=0;$i<$max;$i++){
						$pid = $_SESSION['cart'][$i]['productid'];
						$q = $_SESSION['cart'][$i]['qty'];
						$size = $_SESSION['cart'][$i]['size'];
						$mausac = $_SESSION['cart'][$i]['mausac'];
						$pmasp = get_code($pid);					
						$pname = get_product_name($pid);
						$pphoto = get_product_photo($pid);
						$pgia = get_price($pid);
						$tiente = get_tiente($pid);
						$ptonggia = get_price($pid)*$q;
						$trongluong = get_trongluong($pid);

						#Nếu số lượng bàng ko thì bỏ qua
						if($q == 0) continue;
						$sql = "INSERT INTO table_chitietdonhang (madonhang,masp,ten,size,mausac,gia,tiente,soluong,tonggia,ngaytao,photo,id_sanpham) VALUES ('$madonhang','$pmasp','$pname','$size','$mausac','$pgia','$tiente','$q','$ptonggia','$ngaydangky','$pphoto','$pid')";
					
						if(mysql_query($sql) == true)
						{
							$coloi = true;
						}	
						else
						{
							transfer("Đơn hàng của bạn chưa được gửi<br>Vui lòng điền đầy đủ thông tin lại<br>Cảm ơn", "gio-hang.html");
						}
					}
					
					#Nếu insert bảng chitietdonhang thành công thì bắt đầu gửi mail
					if($coloi == true)
					{		

						$tongtien_vnd = get_order_total();
						$tongtien_usd = get_order_total_usd();

						include_once "phpMailer/class.phpmailer.php";	
						$mail = new PHPMailer();
						$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
						$mail->Host       = $ip_host;   // tên SMTP server
						$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
						$mail->Username   = $mail_host; // SMTP account username
						$mail->Password   = $pass_mail;  
				
						//Thiết lập thông tin người gửi và email người gửi
						$mail->SetFrom($mail_host,$_POST['ten_lienhe']);
						
						$mail->AddAddress($company['email'], 'Đơn hàng từ website '.$_SERVER["SERVER_NAME"]);
						$mail->AddAddress($email, 'Đơn hàng từ website '.$_SERVER["SERVER_NAME"]);
						//Thiết lập email nhận email hồi đáp
						
						//nếu người nhận nhấn nút Reply
						$mail->AddReplyTo($email,'Đơn hàng từ website'.$_SERVER["SERVER_NAME"]);
						/*=====================================
						 * THIET LAP NOI DUNG EMAIL
						*=====================================*/
						//Thiết lập tiêu đề
						$mail->Subject    = "Đơn hàng từ website ".$_SERVER["SERVER_NAME"];
						$mail->IsHTML(true);
						//Thiết lập định dạng font chữ
						$mail->CharSet = "utf-8";		
							$body = '<table>';
							$body .= '
								<tr>
									<th colspan="2">&nbsp;</th>
								</tr>
								<tr>
									<th colspan="2">Đơn hàng từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
								</tr>
								<tr>
									<th colspan="2">&nbsp;</th>
								</tr>
								<tr>
									<th>Mã đơn hàng :</th><td>'.$madonhang.'</td>
								</tr>
								<tr>
									<th>Họ tên :</th><td>'.$hoten.'</td>
								</tr>
								<tr>
									<th>Địa chỉ :</th><td>'.$diachi_txt.'</td>
								</tr>
								<tr>
									<th>Email :</th><td>'.$email.'</td>
								</tr>
								<tr>
									<th>Điện thoại :</th><td>'.$dienthoai.'</td>
								</tr>
								<tr>
									<th>Hình thức vận chuyển :</th><td>'.$htvc.'</td>
								</tr>
								<tr>
									<th>Số tiền :</th><td>'.number_format($tongtien_vnd+$phi_vanchuyen,0, ',', '.').' VNĐ'.' + '.number_format($tongtien_usd,0, ',', '.').' USD</td>
								</tr>
								<tr>
									<th>Nội dung :</th><td>'.$noidung.'</td>
								</tr>
								';
							$body .= '</table>';
							
							
							#------------Chi tiết đơn hàng---------------------
							$body.='<table border="0" cellpadding="5px" cellspacing="1px" style="color:#000000; background:#d4d4d4; width:100%;">';
							if(is_array($_SESSION['cart'])){
								

								$body.= '<tr bgcolor="#F0F0F0" height="55px">
									<td align="center">STT</td>
									<td style="text-align:center;">Hình ảnh</td>
									<td style="text-align:center;">Bảo hành</td> 
									<td style="text-align:center;" class="gh_an">Tên sản phẩm</td> 
									<td align="center">Công suất</td>
									<td align="center">Đơn giá</td>
									<td align="center">Số lượng</td>
									<td align="center">Thành tiền</td>
								</tr>';
								$max=count($_SESSION['cart']);
								for($i=0;$i<$max;$i++){
									$pid=$_SESSION['cart'][$i]['productid'];
									$size=$_SESSION['cart'][$i]['size'];
									$mausac=$_SESSION['cart'][$i]['mausac'];
									$q=$_SESSION['cart'][$i]['qty'];
									$pmasp=get_code($pid);					
									$pname=get_product_name($pid);
									$pbaohanh = get_baohanh($pid);
									$pcongsuat = get_congsuat($pid);
									$pphoto=get_product_photo($pid);
									$tiente = get_tiente($pid);
									if($tiente==2){
										$currency='usd';
									}else{
										$currency='vnđ';
									}				
									if($q==0) continue;
									
									$body.= '<tr bgcolor="#FFFFFF" style="color:#000000;">';
									$body.='<td width="10%" align="center">'.($i+1).'</td>';
									$body.='<td width="15%" align="center"><img src="http://'.$config_url.'/upload/sanpham/'.$pphoto.'" style="max-height:50px; margin:5px 0;" /></td>';
									
									$body.='<td width="10%" style="padding:0px 10px; box-sizing:border-box;">'.$pbaohanh.'</td>';	
									$body.='<td width="20%" style="padding:0px 10px; box-sizing:border-box;">'.$pname.'</td>';	
									$body.='<td width="10%" style="padding:0px 10px; box-sizing:border-box;">'.$pcongsuat.'</td>';	
									
									$body.="<td width='10%' align='center'>".number_format(get_price($pid),0, ',', '.')."&nbsp;<sup>".$currency."</sup></td>";                 
									
									$body.='<td width="10%" align="center">'.$q.'</td>';
									$body.="<td width='15%' align='center'>".number_format(get_price($pid)*$q,0, ',', '.') ."&nbsp;<sup>".$currency."</sup></td>";
									$body.='</tr>';
								}
								$body.='<tr>
						                	<td colspan="7" style="background:#F0F0F0; height:55px; text-align:right; padding-right:10px;">Tạm tính</td>
						                	<td style="background: #fff;text-align: center;">'.number_format($tongtien_vnd,0, ',', '.').'&nbsp;<sup>đ</sup> + '.number_format($tongtien_usd,0, ',', '.').'&nbsp;<sup>usd</sup></td>
						                </tr>';
						        $body.='<tr>
						                	<td colspan="7" style="background:#F0F0F0; height:55px; text-align:right; padding-right:10px;">Phí vận chuyển (dự kiến)</td>
						                	<td style="background: #fff;text-align: center;">'.number_format($phi_vanchuyen,0, ',', '.').'&nbsp;<sup>đ</sup></td>
						                </tr>';
								$body.='<tr>
						                	<td colspan="7" style="background:#F0F0F0; height:55px; text-align:right; padding-right:10px;">Tổng tiền</td>
						                	<td style="background: #fff;text-align: center;">'.number_format($tongtien_vnd+$phi_vanchuyen,0, ',', '.').'&nbsp;<sup>đ</sup> + '.number_format($tongtien_usd,0, ',', '.').'&nbsp;<sup>usd</sup></td>
						                </tr>';
							}
							else{
								$body.='<tr bgColor="#FFFFFF"><td>Không có sản phẩm nào trong giỏ hàng!</td>';
							}
					   $body.='</table>';
					   #------------Chi tiết đơn hàng---------------------
			
							$mail->Body = $body;
							$_SESSION['cart']=0;
							unset($_SESSION['cart']);
							if($mail->Send())
							{
								
								transfer("Bạn đã đặt hàng thành công.<br> Chúng tôi sẽ liên hệ với bạn sớm nhất.<br>Mã đơn hàng là: ".$madonhang, "http://".$config_url);
							}
							else
								transfer("Bạn đã đặt hàng thành công.<br> Chúng tôi sẽ liên hệ với bạn sớm nhất.<br>Mã đơn hàng là: ".$madonhang, "http://".$config_url);
							}
	            }
				else{
					transfer("Đơn hàng của bạn chưa có sản phẩm<br>Vui lòng chọn sản phẩm để đặt hàng<br>Cảm ơn", "http://".$config_url);
				}
			}
			else 
				transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, xin quý khách thử lại.", "http://".$config_url);	
			}
		}else{
				 
				transfer("Mã xác thực không đúng.<br>Xin quý khách thử lại.", "http://".$config_url);
			}
		
		}
	}
	else
	{
		transfer("Bạn chưa mua sản phẩm nào.Vui lòng chọn mua sản phẩm.<br/>Cảm Ơn!!!.", "index.html");
	}
?>

