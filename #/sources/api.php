<?php
    if(!defined('SOURCES')) die("Error");
    $action = $model->get("params.action");
    $id = $model->get("params.id");
   
    switch($action)
    {
        case 'payment':
            _payment($id);
            break;     
        case 'confirm':
            _confirm();
            break; 
        case 'check':
            _check();
            break;
	   	case 'check-wallet':
            _check_wallet();
            break;
	   	case 'check-wt':
            _check_wt();
            break;
      case 'app': 
          _app();
          exit;
          break;
      default:
            header('HTTP/1.0 404 Not Found', true, 404);
            include("404.php");
            exit();
    }
    function _payment($id){
        switch ($id) {
            case 'successful-deposit':
                _create();
                break;
            default:
                break;
        }
    }
    function _app(){
       global $model,$d,$lang,$func;
       $type = $model->get("params.id");
	   
       $data = array();
		if($type=="login"){
			
			$post = json_decode(file_get_contents('php://input'),true);
			foreach($post as $k=>$v){
				$post[$k] = trim($v);
			}
			$username = addslashes($post['username']);
			$password = addslashes($post['password']);
			$data['error'] = 1;
			$data['msg'] = _login_fail_1;
			if(!$username || !$password){
				$data['msg'] = username_password_required;
			}else{
			
				$row = $d->rawQueryOne("select id, password, username, dienthoai as phone, diachi as address, email, ten as name from #_member where username = ? and hienthi > 0 limit 0,1",array($username));
				if(!empty($row['id']))
				{
					$passwordMD5 = md5($password);
					if($row['password'] == $passwordMD5)
					{
						/* Tạo login session */
						$id_user = $row['id'];
						$lastlogin = time();
						$login_session = md5($row['password'].$lastlogin);
						$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?",array($login_session,$lastlogin,$id_user));
						$data['msg'] = _login_success;
						$data['error'] = 0;
						unset($row['password']);
						$data['info'] = $row;
					}
					
				}
			}
		}
		if($type=="register"){
		
		$post = json_decode(file_get_contents('php://input'),true);
		
		foreach($post as $k=>$v){
			$post[$k] = trim($v);
		}
		
		$data['error'] = 0;
		$username =   addslashes($post['username']);
		$password =  addslashes($post['password']);
		$passwordMD5 = md5($password);
		$repassword = addslashes($post['repassword']);
		$email =  addslashes($post['email']);
		$maxacnhan = $func->digitalRandom(0,3,6);
		
		if(!$password){
			$data['error'] = 1;
			$data['msg'] = 	EnterPassword;
		}
		if(!$data['error'] && $password != $repassword){
			$data['error'] = 1;
			$data['msg'] = ConfirmPasswordNotMatch;
		}
		if(!$data['error']){

		
			$row = $d->rawQueryOne("select id from #_member where username = ? limit 0,1",array($username));
			
			if(isset($row['id'])){
				$data['error'] = 1;
				$data['msg'] = _error_register_2;
			}
			
		}
		if(!$data['error']){
			$row = $d->rawQueryOne("select id from #_member where email = ? limit 0,1",array($email));
			
			if(isset($row['id'])){
				
				$data['error'] = 1;
				$data['msg'] = _error_register_3;
			}
		}
		if(!$data['error']){
			foreach(array("admin","system","mod") as $k=>$v){
				if(strpos($username,$v)!==false){
					$data['error'] = 1;
					$data['msg'] = _error_register_2z;
				}
			}
		}
		
		if(!$data['error']){
			$data2['ref'] = addslashes($post['ref']);
			$data2['ten'] = addslashes($post['name']);
			$data2['username'] = $username;
			$data2['password'] = md5($password);
			$data2['email'] = $email;
			$data2['dienthoai'] =  addslashes($post['phone']);
			$data2['diachi'] = addslashes($post['address']);
			$data2['gioitinh'] = (int)addslashes($post['gender']);
			$data2['ngaysinh'] = $model->carbon->parse($post['dob'])->format('Y-m-d H:i:s');
			$data2['maxacnhan'] = $maxacnhan;
			$data2['hienthi'] = 0;
			$error = false;
			$msg = array();
			
			if(!$data2['ten']){
				$error = true;
				
				$data['error'] = 1;
				$data['msg'] = EnterUsername;
			}
			if(!$error && !$data2['username']){
				$error = true;
				
				$data['error'] = 1;
				$data['msg'] = UsernameNotEnter;
			}
			if(!$error && !$data2['email']){
				$error = true;
				
				$data['error'] = 1;
				$data['msg'] = vuilongnhapdiachiemail;
			}
			
			if(strlen($username) > 50 || strpos($username,"http")!==false || strpos($username," ")!==false || !$data2['dienthoai'] || strlen($data2['dienthoai']) != 10){
				
				$data['error'] = 1;
				$error = true;
				$data['msg'] = "Error phone or username";
			}
			
			if(!$error){
				if($d->insert('member',$data2))
				{
					send_active_user($username);
					
					$data['msg'] = _login_success_2;
				}
				else
				{
					
					$data['error'] = 1;
					$data['msg'] = _error_register_4;
				}
			}
			
			
		}
		
		}
        if($type=='get-banner'){
            $slider = $d->rawQuery("select id,ten$lang as name, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('slide'));
            $tmp = array();
            foreach($slider as $k=>$v){ 
                $v['photo'] = _baseUrl().UPLOAD_PHOTO_L.$v['photo'];
                $tmp[] = $v;
            }
            $data['data'] = $tmp;

        }
        if($type=='get-category-index'){
            $product_list = $d->rawQuery("select ten$lang as name, mota$lang as shortdesc,  id, photo2 as banner, photo3 as photo from #_product_list where type = ? and hienthi > 0 and noibat > 0 order by stt,id desc",array('san-pham'));
            $tmp = array();
            $product_highlight = array();
            foreach($d->rawQuery("select ten$lang as name, id,photo,id_size, id_list from #_product where id_list > 0 and type = ? and noibat > 0 and hienthi > 0 order by stt,id desc",array('san-pham')) as $k=>$v){
              $t = $v;
              $t['photo'] = _baseUrl().UPLOAD_PRODUCT_L.$t['photo'];
              

              $product_price = $func->getPrice($v);
              $t['price_old'] = 0;
              $t['price'] = 0;
              $t['discount'] = 0;
              if(isset($product_price['gia'])){
                if($product_price['giamoi']){
                   $t['price'] = $func->format_money_api($product_price['giamoi']);
                   $t['price_old'] = $func->format_money_api($product_price['gia']);
                   $t['discount'] = $product_price['giakm'];
                }else{
                  $t['price'] = $func->format_money_api($product_price['gia']);
                  
                }
              }
              unset($t['id_list']);
              $product_highlight[$v['id_list']][] = $t;
            }
            foreach($product_list as $k=>$v){
                $v['photo'] = _baseUrl().UPLOAD_PRODUCT_L.$v['photo'];
                $v['banner'] = _baseUrl().UPLOAD_PRODUCT_L.$v['banner'];
                $v['product'] = $product_highlight[$v['id']];
                $tmp[] = $v;
            }
            $data['data'] = $tmp;

        }


      if($type=='get-category'){
            $product_list = $d->rawQuery("select ten$lang as name, mota$lang as shortdesc,  id, photo2 as banner, photo3 as photo from #_product_list where type = ? and hienthi > 0 order by stt,id desc",array('san-pham'));
            $tmp = array();
            foreach($product_list as $k=>$v){
                $v['photo'] = _baseUrl().UPLOAD_PRODUCT_L.$v['photo'];
                $v['banner'] = _baseUrl().UPLOAD_PRODUCT_L.$v['banner'];
                /*$v['product'] = $product_highlight[$v['id']];*/
                $tmp[] = $v;
            }
            $data['data'] = $tmp;

        }


         if($type=='get-product-by-category'){
            $id = addslashes($_GET['id']);
           
            $tmp = array();
            foreach($d->rawQuery("select ten$lang as name, id,photo,id_size from #_product where id_list = ? and type = ? and noibat > 0 and hienthi > 0 order by stt,id desc",array($id,'san-pham')) as $k=>$v){
              $t = $v;
              $t['photo'] = _baseUrl().UPLOAD_PRODUCT_L.$t['photo'];
              $product_price = $func->getPrice($v);
              $t['price_old'] = 0;
              $t['price'] = 0;
              $t['discount'] = 0;
              if(isset($product_price['gia'])){
                if($product_price['giamoi']){
                   $t['price'] = $func->format_money_api($product_price['giamoi']);
                   $t['price_old'] = $func->format_money_api($product_price['gia']);
                   $t['discount'] = $product_price['giakm'];
                }else{
                  $t['price'] = $func->format_money_api($product_price['gia']);
                  
                }
                unset($t['id_list']);
              }
              $tmp[] = $t;
            }
            $data['data'] = $tmp;

        } 



        if($type=='get-product-same-type'){
          $id = addslashes($_GET['id']);
          $row_detail = $d->rawQueryOne("select * from #_product where id = ? and hienthi > 0 limit 0,1",array($id));

          $where = "";
          $where = "id <> ? and id_list = ? and type = ? and hienthi > 0";
          $params = array($id,$row_detail['id_list'],"san-pham");
          $sql = "select ten$lang as name, id,photo,id_size from #_product where $where order by stt,id desc ";

          $product = $d->rawQuery($sql,$params);

   
            $tmp = array();
            foreach($product as $k=>$v){
              $t = $v;
              $t['photo'] = _baseUrl().UPLOAD_PRODUCT_L.$t['photo'];
              $product_price = $func->getPrice($v);
              $t['price_old'] = 0;
              $t['price'] = 0;
              $t['discount'] = 0;
              if(isset($product_price['gia'])){
                if($product_price['giamoi']){
                   $t['price'] = $func->format_money_api($product_price['giamoi']);
                   $t['price_old'] = $func->format_money_api($product_price['gia']);
                   $t['discount'] = $product_price['giakm'];
                }else{
                  $t['price'] = $func->format_money_api($product_price['gia']);
                  
                }
                unset($t['id_list']);
              }
              $tmp[] = $t;
            }
            $data['data'] = $tmp;

        }



         if($type=='get-product-detail'){
            $id = addslashes($_GET['id']);
           
           $row_detail = $d->rawQueryOne("select * from #_product where id = ? and hienthi > 0 limit 0,1",array($id));
		   if(!isset($row_detail['id'])){
			     header('Content-Type: application/json; charset=utf-8');
				 echo json_encode($data);
				 exit;
		   }
           $type = $row_detail['type'];
           $hinhanhsp = $d->rawQuery("select photo from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc",array($row_detail['id'],$type,$type));


            $t = array();
              $t['id'] = $row_detail['id'];
              $t['price_old'] = 0;
              $t['price'] = 0;
              $t['discount'] = 0;

                $product_price = $func->getPrice($row_detail);
              $t['price_old'] = 0;
              $t['price'] = 0;
              $t['discount'] = 0;
              if(isset($product_price['gia'])){
                if($product_price['giamoi']){
                   $t['price'] = $func->format_money_api($product_price['giamoi']);
                   $t['price_old'] = $func->format_money_api($product_price['gia']);
                   $t['discount'] = $product_price['giakm'];
                }else{
                  $t['price'] = $func->format_money_api($product_price['gia']);
                  
                }
                unset($t['id_list']);
              }


              $t['name'] = $row_detail['ten'.$lang];
              $t['id_category'] = $row_detail['id_list'];
              $t['sku'] = $row_detail['masp'];
              $t['short_content'] = $row_detail['mota'.$lang];
              $t['content'] = $row_detail['noidung'.$lang];

              $t['photo'] = array();

              if($row_detail['photo']){
                 $t['photo'][] = _baseUrl().UPLOAD_PRODUCT_L.$row_detail['photo'];  
              }
              foreach($hinhanhsp as $k=>$v){
                  $t['photo'][] = _baseUrl().UPLOAD_PRODUCT_L.$v['photo'];  
              }

              $t['size'] = array();
              $t['color'] = array();

			$size = array();
             if($row_detail['id_size'])
              {
                $size = $d->rawQuery("select id, ten$lang from #_product_size where  find_in_set(id,'".$row_detail['id_size']."') and hienthi > 0 order by stt,id desc");
                $prices = $d->rawQuery("select id_size, gia, giamoi, giakm from #_product_price where id_product = ? order by id desc",array($row_detail['id']));
                foreach($prices as $k => $v)
                {
                  $prices[$v['id_size']] = $prices[$k];
                  unset($prices[$v['id_size']]['id_size']);
                  unset($prices[$k]);
                }
              }
              if($row_detail['id_mau']){
                $mau = $d->rawQuery("select  id, mau as color, ten$lang as name from #_product_mau where type='".$type."' and find_in_set(id,'".$row_detail['id_mau']."') and hienthi > 0 order by stt,id desc");
                $t['color'] = $mau;
              }
             
              if(count($size)){
                foreach($size as $k=>$v){
                  $id = $v['id'];
                    $v = array_merge($v,$prices[$v['id']]);
                   
                    $price=0;
                    $price_old=0;
                    $discount=0;
                    if($v['giamoi']){
                       $price = $func->format_money_api($v['giamoi']);
                        $price_old = $func->format_money_api($v['gia']);
                       $discount = $v['giakm'];
                  }else{
                     $price = $func->format_money_api($v['gia']);
                    
                  }

                 
                    $t['size'][] = array("id"=>$v['id'],"name"=>$v['ten'.$lang],"price"=>($price),"price_old"=>($price_old),"discount"=>$discount);
                }
              }

              $data['data'] = $t;

        }
      header('Content-Type: application/json; charset=utf-8');
       echo json_encode($data);
  }



	function _check_wt(){
		global $d;
		$id = trim(addslashes($_GET['id']));
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
		error_reporting(E_ALL);
		$data = array();
		if($id){
			$row = $d->rawQueryOne("select * from #_history_log where nickname_wt = ? and status_quote_amout=0 and pre_buy = 0 and status = 1 order by id desc",array($id));
			
			if(isset($row['id'])){
				$tmp['end_date'] = $row['at_time'];
				$tmp['status'] = "active";
				$tmp['quote'] = $row['quote'];
				
				$data = $tmp;
			}
		}
		echo json_encode($data);
		exit;		
	}
	function _check_wallet(){
		global $d;
		$id = addslashes($_GET['id']);
		
		$data = array('status'=>false);
		if($id){
			$row = $d->rawQuery("select * from #_wallet where tron_address = ?",array($id));
			if(count($row)){
				$data = array('status'=>true);
			}
		}
		echo json_encode($data);
		exit;		
	}
    function _confirm(){
        global $d,$optsetting,$emailer,$model;
       // dd($optsetting);
        $key = @$_GET['key'];
        if($key==$optsetting['keycron']){
			$d->rawQuery("update #_history_log set pre_buy=0 where create_at < '".currentDate()."' and status_quote_amout = 0 and pre_buy = 1");
			
            $rows = $d->rawQuery("select l.*,m.username,m.email,m.protect_status,m.end_date from #_history_log l,#_member m where m.id = l.id_member and pre_buy = 0 and l.status = 1 and send_verify = 0 order by l.id asc limit 5 ");
			
            foreach($rows as $k=>$v){
				
                #if($v['end_date'] < $v['at_time']){
                #    $d->rawQuery("update #_member set protect_status = 1,end_date='".$v['at_time']."' where id = '".$v['id_member']."'");
                #}
                $d->rawQuery("update #_history_log set send_verify = 1 where id = '".$v['id']."'");
                if($v['at_time'] > currentDate()){
                $arrayEmail = array(
                  "dataEmail" => array(
                    "name" => $v['name'],
                    "email" => $v['email']
                  )
                );

                $fee = $v['fee']/$v['week'];
                $content = getEmail("confirm");
                $subject = "ICG Confirms! at ".$v['create_at'];
                $message = str_replace(array("{nick}","{ca}","{link}","{nickwt}","{email}","{username}","{quote}","{fee}","{week}","{time}","{total_fee}","{end_day}","{txid}"),array($v['nickname_wt'],$model->getCA($v['ca'],"name"),$model->getCA($v['ca'],"link"),$v['nickname_wt'],$v['email'],$v['username'],_price($v['quote']),_price($fee),$v['week'],$v['create_at'],_price($v['fee']),$v['at_time'],$v['transaction_id']),$content);
              
                $emailer->sendEmail("customer", $arrayEmail, $subject, $message);
                echo '<h3>Send '.$v['email'].'</h3>';
                $subject = "[ADMIN] ICG Confirms! at ".$v['create_at'];
                $arrayEmail = array(
                  "dataEmail" => array(
                    "email" => $optsetting['email']

                  )
                );
                $emailer->sendEmail("admin", $arrayEmail, $subject, $message);
                echo '<h3>Send '.$optsetting['email'].'</h3>';
                }
            }
        }else{
           echo "Key error";
        }
        exit("SUCCESS");
    }
    function _check(){
        global $d,$optsetting,$emailer;
       // dd($optsetting);
        $key = @$_GET['key'];
        if($key==$optsetting['keycron']){
           #$d->rawQuery("update #_member set protect_status = 0 where protect_status = 1 and end_date <= CURRENT_DATE()");
		   
           foreach($d->rawQuery("select * from #_history_log where at_time <= '".currentDate()."'") as $k=>$v){
			   $d->rawQuery("update #_history_log set status = 2 where id = '".$v['id']."'");
		   }
           #foreach($d->rawQuery("select * from #_history_log where  create_at < CURRENT_DATE() and pre_buy = 1") as $k=>$v){
           # dd($v);

           #}
		   
         #  $d->rawQuery("update #_history_log set pre_buy = 0 where create_at < CURRENT_DATE() and pre_buy = 1");
        }else{
           echo "Key error";
        }
        exit;
    }
    function _create(){ 
       global $d;
       $xdata = (file_get_contents('php://input'));
       error_reporting(0);
       ini_set("log_errors", 1);
       ini_set("error_log", $_SERVER['DOCUMENT_ROOT']."/tmp/access.log");
     
       $ddata = json_decode($xdata);
       $insert = array();
       $success = false;
       $error_msg = "";
       
       foreach($ddata as $k=>$data){
        $success = false;
        $error = false;
       if(isset($data->blocknum)){
           if(count($d->rawQuery("select id from #_tron_transaction_log where transaction_id = '".$data->txid."'"))){
             $error_msg = "Duplicate";
           }else{
               if(count($d->rawQuery("select id from #_wallet where tron_address = '".$data->address."'"))){
                   $insert['block_id'] = $data->blocknum;
                   $insert['transaction_id'] = $data->txid;
                   $insert['address'] = $data->address;
                   $insert['from_address'] = $data->from;
                   $insert['currency'] = $data->type;
                   $insert['amount'] = $data->amount;
                   $insert['created_at'] = $data->time;
                   
                   foreach($insert as $k=>$v){
                        if(!$v){
                            $error_msg = "Missing label";
                            $error = true;
                        }
                   }

                   if(!$error){
                       
                        $insert['status'] = "";
                        $success = ($d->insert("tron_transaction_log",$insert))?true:false;
                        $error_msg = "Saving success";

                        if(!$success){
                            $error_msg = "Saving error";
                        }
                   }
                }else{
                    $error = true;
                    $error_msg = "Address not exist";
                }  
           }
       }
    }
       error_log($xdata." - ".date("d-m-Y H:i:s").json_encode(array("success"=>$success,"error"=>$error_msg)));
       echo json_encode(array("success"=>$success,"msg"=>$error_msg));
       exit;
    }
	
	
	
	
	
	
	
	/*send active */
	
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

