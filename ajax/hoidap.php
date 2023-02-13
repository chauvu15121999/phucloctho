<?php 
	include ("ajax_config.php");
 
		if(!empty($_POST) && isset($_POST['recaptcha_response_hoidap'])){
	    $recaptchaName = $_POST['recaptcha_response_hoidap'];
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

	    if($rep->score >= 0.5 && $rep->action=='hoidap') {
			$data['product_id'] = (int)$_POST['product_id'];
			$data['parent_id'] = (int)$_POST['parent_id'];
			$data['lang'] = $lang;
			$data['ten'.$lang] = $d->escape_str(trim($_POST['ten_commnet1']));
			$data['dienthoai'] = $d->escape_str(trim($_POST['dienthoai_commnet1']));
			$data['email'] = $d->escape_str(trim($_POST['email_commnet1']));
			$data['mota'] = $d->escape_str(trim($_POST['noidung_comment1']));
			$data['comment_type'] = $d->escape_str(trim($_POST['type_comment']));
			$data['type'] = $d->escape_str(trim($_POST['type']));
			$data['hienthi'] = 1;
			$data['ngaytao'] = time();
			
			$d->setTable('comment');
			if($d->insert($data)){
				
			$email=$d->escape_str(trim($_POST['email_commnet1']));
			$sql = "select email from #_lienhe where email='$email' and type='thongtin' ";
			$d->query($sql);	
			if($d->num_rows()==0){
				$data1['ten'.$lang] = $d->escape_str(trim($_POST['ten_commnet1']));
				$data1['dienthoai']=$d->escape_str(trim($_POST['dienthoai_commnet1']));
				$data1['email'] = $email;
				$data1['hienthi'] = 1;
				$data1['stt'] = 1;
				$data1['type'] = 'thongtin';
				$d->setTable('lienhe');
				$d->insert($data1);
			} 
				
				$return['thongbao'] = _binhluanthanhcong;
				$return['nhaplai'] = 'nhaplai';
			}
			else
			{
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
