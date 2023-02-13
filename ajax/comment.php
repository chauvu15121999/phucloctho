<?php 
	include ("ajax_config.php");
	if(!empty($_POST) && isset($_POST['recaptcha_response_nhanxet'])){
	    $recaptchaName = $_POST['recaptcha_response_nhanxet'];
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
	    if($rep->score >= 0.5 && $rep->action=='nhanxet') {	
			$data['product_id'] = (int)$_POST['product_id'];
			$data['parent_id'] = (int)$_POST['parent_id'];
			$data['score'] = (int)$_POST['score'];
			$data['lang'] = $lang;
			$data['ten'.$lang] = (string)magic_quote(trim(strip_tags($_POST['ten_commnet'])));
			$data['dienthoai'] = (string)magic_quote(trim(strip_tags($_POST['dienthoai_commnet'])));
			$data['email'] = (string)magic_quote(trim(strip_tags($_POST['email_commnet'])));
			$data['mota'] = (string)magic_quote(trim(strip_tags($_POST['noidung_comment'])));
			$data['comment_type'] = (string)magic_quote(trim(strip_tags($_POST['type_comment'])));
			$data['type'] = (string)magic_quote(trim(strip_tags($_POST['type'])));
			$data['hienthi'] = 1;
			$data['ngaytao'] = time();
					
			$d->setTable('comment');
			if($d->insert($data)){
						
				$email=(string)magic_quote(trim(strip_tags($_POST['email_commnet1'])));
				$sql = "select email from #_lienhe where email='$email' and type='thongtin' ";
				$d->query($sql);	
				if($d->num_rows()==0){
					$data1['ten'.$lang] = (string)magic_quote(trim(strip_tags($_POST['ten_commnet'])));
					$data1['dienthoai']=(string)magic_quote(trim(strip_tags($_POST['dienthoai_commnet'])));
					$data1['email'] = $email;
					$data1['hienthi'] = 1;
					$data1['stt'] = 1;
					$data1['type'] = 'thongtin';
					$d->setTable('lienhe');
					$d->insert($data1);
				} 
				$return['thongbao'] = _binhluanthanhcong;
				$return['nhaplai'] = 'nhaplai';
			}else{
				$return['thongbao'] = _hethongloi;
				$return['nhaplai'] = '0';
			}
		}else{
			$return['thongbao'] = 'Mã xác thực không đúng';
			$return['nhaplai'] = 'nhaplai';
			
		}
		echo json_encode($return);
	}
?>
