<?php
	if(!defined('SOURCES')) die("Error");

	$action = htmlspecialchars($match['params']['action']);
	
	switch($action)
	{
		case 'login':
			$title_crumb = dangnhap;
			$template = "account/dangnhap";
			if(!empty($_SESSION[$login_member]['active'])) $func->transfer(error_404,$config_base, false);
			if(!empty($_POST['dangnhap'])) login();
			break;

		case 'register':
			$title_crumb = dangky;
			$template = "account/dangky";
			if(!empty($_SESSION[$login_member]['active'])) $func->transfer(error_404,$config_base, false);
			if(!empty($_POST['dangky'])) signup();
			break;

		case 'forgot':
			$title_crumb = quenmatkhau;
			$template = "account/quenmatkhau";
			if(!empty($_SESSION[$login_member]['active'])) $func->transfer(error_404,$config_base, false);
			if(!empty($_POST['quenmatkhau'])) doimatkhau_user();
			break;

		case 'active':
			$title_crumb = kichhoat;
			$template = "account/kichhoat";
			if(!empty($_SESSION[$login_member]['active'])) $func->transfer(error_404,$config_base, false);
			if(!empty($_POST['kichhoat'])) active_user();
			break;

		case 'profile':
			if(empty($_SESSION[$login_member]['active'])) $func->transfer(error_404,$config_base, false);
			$template = "account/thongtin";
			$title_crumb = capnhatthongtin;
			info_user();
			break;

		case 'logout':
			if(empty($_SESSION[$login_member]['active'])) $func->transfer(error_404,$config_base, false);
			logout();
		
		default:
			header('HTTP/1.0 404 Not Found', true, 404);
			include("404.php");
			exit();
	}

	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	if(!empty($title_crumb)) $breadcr->setBreadCrumbs('',$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();

	function info_user()
	{
		global $d, $func, $row_detail, $config_base, $login_member,$model;
		$iduser = $_SESSION[$login_member]['id'];

		if($iduser){
			$error = false;
			$msg = [];
			if(isset($_POST['submit'])){
				if($_POST['submit']=="account"){
					$data = array();
					$data['ten'] = encode($_POST['ten']);
					$data['dienthoai'] = encode($_POST['dienthoai']);
					$data['diachi'] = encode($_POST['diachi']);
					$data['gioitinh'] = encode($_POST['gioitinh']);
					$data['ngaysinh'] = encode($_POST['ngaysinh']);
					$data['ngaysinh'] = $model->carbon->parse($data['ngaysinh'])->format('Y-m-d H:i:s');
					if(!$data['ten']){
						$msg[] = vuilongnhaphoten;
					}
					if(!count($msg)){
						$d->where('id', $iduser);
			        	if($d->update('member',$data)){
			        		$model->setFlash("toast",array("type"=>"success","msg"=>UpdateSuccess));
			        	}else{
			        		$model->setFlash("toast",array("type"=>"error","msg"=>UpdateFail));
			        	}
					}else{
						$model->set("error_account",$msg);
					}
				}
				if($_POST['submit']=="password"){
					$error = [];
					$password = encode($_POST['password']);
					$new_password = encode($_POST['new-password']);
					$new_password_confirm = encode($_POST['new-password-confirm']);
					if(!$password){
						$error[] = error_nhapmatkhaucu;
					}
					if(!$error && !$new_password){
						$error[] = error_nhapmatkhaumoi;
					}
					if(!count($error) && ($new_password)!=$new_password_confirm){
						$error[] = ConfirmPasswordNotMatch;
					}
					
					if(!count($error)){
						$row = $d->rawQueryOne("select m.id,ten,ref, username, gioitinh,password,ngaysinh, email, dienthoai, diachi,l.tron_address as wallet from #_member m,#_wallet l where l.id_member = m.id and m.id = ? limit 0,1",array($iduser));
						if(md5($password)!=$row['password']){
							$error[] = OldPasswordNotCorrect;		
						}
					}
					if(!count($error) && !validPassword($new_password)){
						$error[] = error_passwordvalid;		
					}
					if(!count($error)){
						$data = array();
						$data['password'] = md5($new_password);
						if($d->update('member',$data)){
			        		$model->setFlash("toast",array("type"=>"success","msg"=>UpdateSuccess));
			        	}else{
			        		$model->setFlash("toast",array("type"=>"error","msg"=>UpdateFail));
			        	}
					}else{
						$model->set("error_password",$error);
					}
				}
			}
		}
		else
		{
			$func->transfer(error_404,$config_base, false);
		}
		$row_detail = $d->rawQueryOne("select m.id,ten,ref, username, gioitinh, ngaysinh, email, dienthoai, diachi,l.tron_address as wallet from #_member m,#_wallet l where l.id_member = m.id and m.id = ? limit 0,1",array($iduser));
		$data = $d->rawQuery("select * from #_tron_transaction_log   where address ='".getUserInfo("wallet")."' order by id desc");
		$model->set("data",$data);
		$model->set("cart",$d->rawQuery("select * from #_order   where id_user ='".getUserInfo("id")."' order by id desc"));

	}

	function active_user()
	{
		global $d, $func, $row_detail, $config_base,$model;

		$id = (!empty($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
		$maxacnhan = (!empty($_POST['maxacnhan'])) ? htmlspecialchars($_POST['maxacnhan']) : '';

		/* Kiểm tra thông tin */
        $row_detail = $d->rawQueryOne("select hienthi, maxacnhan, id from #_member where id = ? limit 0,1",array($id));

        if(!$row_detail['id']) $func->transfer(_user_not_active,$config_base, false);
        else if($row_detail['hienthi']) $func->transfer(_user_actived,$config_base);
        else
        {
    		if($row_detail['maxacnhan'] == $maxacnhan)
        	{
        		$data['hienthi'] = 1;
        		$data['maxacnhan'] = '';
				$d->where('id', $id);
				if($d->update('member',$data)){ 
					$model->createWallet($row_detail);
					$func->transfer(AccontActivationSuccessful,$config_base."account/login");}
        	}
        	else
        	{
        		$func->transfer(IncorrectActivationCode,$config_base."account/active?id=".$id, false);
        	}
        }
	}

	function login()
	{
		global $d, $func, $login_member, $config_base,$model;

		$username = (!empty($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$password = (!empty($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$passwordMD5 = md5($password);
		$remember = (!empty($_POST['remember-user'])) ? htmlspecialchars($_POST['remember-user']) : false;

		if(!$username) $func->transfer(EnterUsername,'account/login', false);
		if(!$password) $func->transfer(EnterPassword,'account/login', false);
		
		$row = $d->rawQueryOne("select id, password, username, dienthoai, diachi, email, ten from #_member where username = ? and hienthi > 0 limit 0,1",array($username));

		if(!empty($row['id']))
		{
			if($row['password'] == $passwordMD5)
			{
				/* Tạo login session */
				$id_user = $row['id'];
				$lastlogin = time();
				$login_session = md5($row['password'].$lastlogin);
				$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?",array($login_session,$lastlogin,$id_user));
				$row['login_session'] = $login_session;
				$row['active'] = true;
				$model->savingUserLogin($row);
				/* Nhớ mật khẩu */
				setcookie('login_member_id',"",-1,'/');
				setcookie('login_member_session',"",-1,'/');
				if($remember)
				{
					$time_expiry = time()+3600*24;
					setcookie('login_member_id',$row['id'],$time_expiry,'/');
					setcookie('login_member_session',$login_session,$time_expiry,'/');
				}

				$func->transfer(_login_success, $config_base);
			}
			else
			{
				$func->transfer(_login_fail_1, $config_base."account/login", false);
			}
		}
		else
		{
			$func->transfer(_login_fail_1, $config_base."account/login", false);
		}
	}

	function signup()
	{
		global $d, $func, $config_base,$model;

		$username = (!empty($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$password = (!empty($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$passwordMD5 = md5($password);
		$repassword = (!empty($_POST['repassword'])) ? htmlspecialchars($_POST['repassword']) : '';
		$email = (!empty($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$maxacnhan = $func->digitalRandom(0,3,6);
		
		
		if($password != $repassword) $func->transfer(ConfirmPasswordNotMatch, $config_base."account/register", false);

		/* Kiểm tra tên đăng ký */
		$row = $d->rawQueryOne("select id from #_member where username = ? limit 0,1",array($username));

		if(!empty($row['id'])) $func->transfer(_error_register_2, $config_base."account/register", false);

		
		/* Kiểm tra email đăng ký */
		$row = $d->rawQueryOne("select id from #_member where email = ? limit 0,1",array($email));
		if(!empty($row['id'])) $func->transfer(_error_register_3, $config_base."account/register", false);
		foreach(array("admin","system","mod") as $k=>$v){
			if(strpos($username,$v)!==false){

				$func->transfer(_error_register_2, $config_base."account/register", false);
			}


		}
		
		if(isset($_SESSION['ref'])){
			$data['ref'] = $_SESSION['ref'];
			unset($_SESSION['ref']);
		}
		$data['ten'] = (!empty($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
		$data['username'] = $username;
		$data['password'] = md5($password);
		$data['email'] = $email;
		$data['dienthoai'] = (!empty($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
		$data['diachi'] = (!empty($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
		$data['gioitinh'] = (!empty($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;
		
		$data['ngaysinh'] = $model->carbon->parse($_POST['ngaysinh'])->format('Y-m-d H:i:s');
		$data['maxacnhan'] = $maxacnhan;
		$data['hienthi'] = 0;
		$error = false;
		$msg = array();
		if(strlen($username) > 50 || strpos($username,"http")!==false || strpos($username," ")!==false || !$data['dienthoai'] || strlen($data['dienthoai']) < 10 || strlen($data['dienthoai']) > 12){
			redirect(baseUrl()."account/register");
		}
		
		if(!$data['ten']){
			$error = true;
			$msg[] = EnterUsername;
		}
		if(!$error && !$data['username']){
			$error = true;
			$msg[] = UsernameNotEnter;
		}
		if(!$error && !$data['email']){
			$error = true;
			$msg[] = vuilongnhapdiachiemail;
		}
		if(!$error){
			if($d->insert('member',$data))
			{
				send_active_user($username);
				$func->transfer(_lang(array("email"),array($data['email']),_login_success_2), $config_base."account/login");
			}
			else
			{
				$func->transfer(_error_register_4, $config_base, false);
			}
		}
		$model->setFlash("error",$msg);
	}

	function send_active_user($username)
	{
		global $d, $setting, $emailer, $func, $config_base, $lang;

		/* Lấy thông tin người dùng */
		$row = $d->rawQueryOne("select id, maxacnhan, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1",array($username));

		/* Gán giá trị gửi email */
		$iduser = $row['id'];
		$maxacnhan = $row['maxacnhan'];
		$tendangnhap = $row['username'];
		$matkhau = $row['password'];
		$tennguoidung = $row['ten'];
		$emailnguoidung = $row['email'];
		$dienthoainguoidung = $row['dienthoai'];
		$diachinguoidung = $row['diachi'];
		$linkkichhoat = $config_base."account/active?id=".$iduser;

		/* Thông tin đăng ký */
		$thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: '.$tendangnhap.'</span><br>Password: *******'.substr($matkhau,-3).'<br>Verify code: '.$maxacnhan.'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
		if($tennguoidung)
		{
			$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
		}
		if($emailnguoidung)
		{
			$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
		}
		if($diachinguoidung)
		{
			$thongtindangky.=$diachinguoidung.'<br>';
		}
		if($dienthoainguoidung)
		{
			$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
		}

		$contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																		</td>
																		<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table>
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách đã đăng ký tại '.$emailer->getEmail('company:website').'</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">'._lang(array("website"),array($emailer->getEmail('company:website')),	_email_info_1).'</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">'._email_info_2.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.date('d',$emailer->getEmail('datesend')).'-'.date('m',$emailer->getEmail('datesend')).'-'.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'._email_info_2.'</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'._User_information.'</th>
													</tr>
												</thead>
												<tbody>
													<tr>'.$thongtindangky.'</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>'._email_info_4.'</i>
											<div style="margin:auto"><a href="'.$linkkichhoat.'" style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:38%;margin-top:5px" target="_blank">Kích hoạt tài khoản</a></div>
											</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">'._lang(array("email","color","hotline","worktime"),array($emailer->getEmail('company:email'),$emailer->getEmail('color'),$emailer->getEmail('company:hotline'),$emailer->getEmail('company:worktime')),_email_info_7).'</p>
											</td>
										</tr>
										
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				
			</tbody>
		</table>';

		/* Send email admin */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $row['username'],
				"email" => $row['email']
			)
		);
		$subject = _subject_active_account.$_SERVER['HTTP_HOST'];
		$message = $contentMember;
		$file = '';

		if(!$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) $func->transfer(_register_fail_1,$config_base."contact-us", false);
	}

	function doimatkhau_user()
	{
		global $d, $setting, $emailer, $func, $login_member, $config_base, $lang;

		$username = (!empty($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$email = (!empty($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$newpass = substr(md5(rand(0,999)*time()), 15, 6);
		$newpassMD5 = md5($newpass);

		if(!$username) $func->transfer(EnterUsername, $config_base."account/forgot", false);
		if(!$email) $func->transfer(_change_password_fail1, $config_base."account/forgot", false);

		/* Kiểm tra username và email */
		$row = $d->rawQueryOne("select id from #_member where username = ? and email = ? limit 0,1",array($username,$email));
		if(empty($row['id'])) $func->transfer(_change_password_fail2, $config_base."account/forgot", false);

		/* Cập nhật mật khẩu mới */
		$data['password'] = $newpassMD5;
		$d->where('username', $username);
		$d->where('email', $email);
		$d->update('member',$data);

		/* Lấy thông tin người dùng */
		$row = $d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1",array($username));

		/* Gán giá trị gửi email */
		$iduser = $row['id'];
		$tendangnhap = $row['username'];
		$matkhau = $row['password'];
		$tennguoidung = $row['ten'];
		$emailnguoidung = $row['email'];
		$dienthoainguoidung = $row['dienthoai'];
		$diachinguoidung = $row['diachi'];

	    /* Thông tin đăng ký */
	    $thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: '.$tendangnhap.'</span><br>Password: *******'.substr($matkhau,-3).'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
	    if($tennguoidung)
	    {
	    	$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
	    }

	    if($emailnguoidung)
	    {
	    	$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
	    }

	    if($diachinguoidung)
	    {
	    	$thongtindangky.=$diachinguoidung.'<br>';
	    }

	    if($dienthoainguoidung)
	    {
	    	$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
	    }




	    $contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<table style="width:100%;">
															<tbody>
																<tr>
																	<td>
																		<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																	</td>
																	<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table>
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">'._kinhchao.'</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">'._email_info_5.'</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">'._email_info_2.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.date('d-m-Y H:i',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'._email_info_2.'</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'._User_information.'</th>
													</tr>
												</thead>
												<tbody>
													<tr>'.$thongtindangky.'</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>'._email_info_6.'</i>
											<div style="margin:auto"><p style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:33%;margin-top:5px" target="_blank">'.matkhaumoi.': '.$newpass.'</p></div>
											</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px 
												'.$emailer->getEmail('color').'
												dashed;padding:10px;list-style-type:none">'._lang(array("email","color","hotline","worktime"),array($emailer->getEmail('company:email'),$emailer->getEmail('color'),$emailer->getEmail('company:hotline'),$emailer->getEmail('company:worktime')),_email_info_7).'</p>
											</td>
										</tr>
										
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				
			</tbody>
		</table>';

		/* Send email admin */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $tennguoidung,
				"email" => $email
			)
		);
		$subject = _subject_reset_password.$_SERVER['HTTP_HOST'];
		$message = $contentMember;
		$file = '';

		if($emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file))
		{
			unset($_SESSION[$login_member]);
			setcookie('login_member_id',"",-1,'/');
			setcookie('login_member_session',"",-1,'/');
			$func->transfer(_email_info_8." :".$email, $config_base);
		}
		else
		{
			$func->transfer(_error_reset_password, $config_base."account/forgot", false);
		}
	}

	function logout()
	{
		global $d, $func, $login_member, $config_base;

		unset($_SESSION[$login_member]);
		setcookie('login_member_id',"",-1,'/');
		setcookie('login_member_session',"",-1,'/');

		$func->redirect($config_base);
	}
?>