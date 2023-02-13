<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$urlcu = "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";
 
	$tieude1=get_about_admin('tieude1');
	$tieude2=get_about_admin('tieude2');
	$tieude3=get_about_admin('tieude3');
	$tieude4=get_about_admin('tieude4');
	$tieude5=get_about_admin('tieude5');
	$tieude6=get_about_admin('tieude6');
	$tieude7=get_about_admin('tieude7');
	$tieude8=get_about_admin('tieude8');
	$tieude9=get_about_admin('tieude9');	
	$tieude10=get_about_admin('tieude10');
	$tieude11=get_about_admin('tieude11');
	$noidung1=get_about_admin('noidung1');
	$noidung2=get_about_admin('noidung2');
	$noidung3=get_about_admin('noidung3');
	
	$d->reset();
	$sql_slider = "select ten$lang as ten,link,photo from #_slider where hienthi=1 and type='ketnoi' order by stt,id desc";
	$d->query($sql_slider);
	$ketnoi=$d->result_array();
 	//print_r($_POST['listid']);die;
	if(isset($_POST['listid'])){
		$chkid =explode(",",$_POST['listid']);
		
		/*if($file = upload_image("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF', _upload_tailieu,$file_name)){
		$data['file'] = $file;
		}*/
		//Gửi tất cả mail nếu check "Chọn tất cả"
		/*if($_POST['titleCheck']=='on'){
			$d->reset();
			$sql = "select email,ten from #_lienhe where type='".$_GET['type']."' ";
			$d->query($sql);
			$mail_list = $d->result_array();
		}else{
			$d->reset();
			$sql = "select email,ten from #_lienhe where id IN (".$_POST['listid'].") and type='".$_GET['type']."' ";
			$d->query($sql);
			$mail_list = $d->result_array();
		}*/
		//Check chọn tất cả nhưng chỉ gửi của trang đang check
		$d->reset();
		$sql = "select email,ten from #_lienhe where id IN (".$_POST['listid'].") and type='".$_GET['type']."' ";
		$d->query($sql);
		$mail_list = $d->result_array();
		//dump($mail_list);
		include_once "phpMailer/class.phpmailer.php";
		$n = count($chkid);
		for($i=0; $i<count($mail_list); $i++ ){
			/*$id =  themdau($chkid[$i]);
			$d->reset();
			$sql = "select email,ten from #_lienhe where id='".$chkid[$i]."' and type='".$_GET['type']."' ";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					//code gửi mail
				}
			}*/
						
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;  
			$mail->SetFrom($mail_host, $company['ten']);
				 
			//Thiết lập thông tin người nhận
			//$mail->AddAddress($company_contact[0]['email'], $_POST['name']);
			$body='';
			$mail->AddAddress($mail_list[$i]['email'], $mail_list[$i]['ten']);
			$body .= '<div style="margin-bottom:15px; font-size:16px;">Dear <b>'.$mail_list[$i]['ten'].'</b></div>';
				
			$mail->Subject    = "[".$company['website']."] - ".$_POST['tieude'];
			$mail->IsHTML(true);
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";	
			$body .= '<div style="width:850px; margin:auto; max-width:100%;">
				<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
   <tbody>
      <tr>
         <td valign="top" bgcolor="#ffffff" align="center">
            <table width="850" cellspacing="0" cellpadding="0" border="0" align="center">
               <tbody>
                  <tr>
                     <td valign="top" align="center">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                           <tbody>
                              <tr>
                                 <td valign="top" bgcolor="#FFFFFF" align="center">
                                    <table style="max-width:670px;width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                                       <tbody>
                                          <tr>
                                             <td style="padding:26px 0px 6px 0px" valign="top" align="center">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                   <tbody>
                                                      <tr>
                                                         <td style="font-family:arial;font-size:16px;line-height:25px;color:#1a73e8;font-weight:500" valign="top" align="center">
                                                            <b>'.$tieude1['ten'].'</b>
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
                              <tr>
                                 <td valign="top" bgcolor="#ffffff" align="center">
                                    <table width="650" cellspacing="0" cellpadding="0" border="0" align="center">
                                       <tbody>
                                          <tr>
                                             <td valign="top" align="center">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                   <tbody>
                                                      <tr>
                                                         <td valign="top" align="center">
                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                               <tbody>
                                                                  <tr>
                                                                     <td style="padding-top:20px;padding-bottom:17px" valign="middle" align="left">
                                                                        <table style="vertical-align:middle" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                           <tbody>
	<tr>
		<td valign="middle" align="left">
			<a href="https://www.hungvuongcoltd.com/" style="display:block;width:179px"><img src="https://'.$config_url.'/'.layhinh('photo','banner').'" style=" height:48px; width:auto; box-sizing:border-box;"/></a>
		</td>
	</tr>
	<tr>
		<td style="display:none" valign="top" align="center">
			<table width="100%" cellspacing="0" cellpadding="0" align="center">
				<tbody>
					<tr>
						<td style="border-top:1px solid #9aa0a6" valign="top" align="center"></td>
                    </tr>
                </tbody>
			</table>
		</td>
    </tr>
																	</tbody>
																</table>
                                                                     </td>
                                                                     <td style="padding:20px 0 17px" valign="middle" align="right">
                                                                        <table cellspacing="0" cellpadding="0" border="0" align="right">
                                                                           <tbody>
	<tr>
		<td style="font-family:arial;font-size:12px;color:#202124;line-height:15px" valign="middle" align="right"><b>'.$tieude2['ten'].'</b></td>
         
        
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
                                                </table>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0" align="center">
                                       <tbody>
                                          <tr>
                                             <td style="border-top:1px solid #9aa0a6;padding:33px 0 0px" valign="top" align="center"></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td style="padding:3px 0px 61px" valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                       <tbody>
                                          <tr>
                                             <td valign="top" align="center">
                                                <table width="650" cellspacing="0" cellpadding="0" border="0">
                                                   <tbody>
                                                      <tr>
                                                         <td style="font-size:26px;color:#666666;line-height:1.1;font-family:arial" valign="top" align="center">
                                                            '.$noidung1['ten'].'
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td style="padding-top:5px" valign="top" align="center">
                                                            <div style="height:1px; width:165px; background:#b3b8bc; margin:auto;"></div>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td style="padding:30px 0px 40px;font-size:17px;line-height:1.6;color:#414141;font-family:arial" valign="top" align="center">
                                                            '.$noidung1['noidung'].'
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td valign="top" align="left">
                                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                               <tbody>
	<tr>
		<td style="font-family:arial;font-size:16px;line-height:20px;font-weight:500;padding-bottom:30px;letter-spacing:0.5px" width="296" valign="top" align="center">
			<a style="display:inline-block; padding:10px 30px; padding-top:13px; background:#7d1315; border-radius:5px; color:#fff; font-weight:bold; text-decoration:none; font-size:16px;" href="'.$noidung1['link'].'">ĐI ĐẾN WEBSITE</a>
        </td>
    </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td valign="top" align="center">
                                                            <table cellspacing="0" cellpadding="0" border="0">
                                                               <tbody>
	<tr>
		<td style="line-height:30px" height="30">
			<img src="https://ci3.googleusercontent.com/proxy/Zre1fAeZon4GoBOJld1BwQBOoDp_nPvbMfWpo_oz1aUl9pMZintgHpbeOa_lM19isQUdBIWybtskSbQzO011QdafXFOEgtL5DEZ2dw=s0-d-e1-ft#https://services.google.com/fh/files/emails/spacer_11.gif" alt="" style="display:block" width="1" height="1" border="0" class="CToWUd">
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
                                          <tr>
                                             <td valign="top" align="center">
                                                <table width="750" cellspacing="0" cellpadding="0" border="0">
                                                   <tbody>
	<tr>
		<td style="border:1px solid #b3b8bc;border-top:4px solid #7d1315;border-collapse:collapse" valign="top" align="center">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
            <tr>
				<td style="line-height:39px;font-size:20px;color:#666666;font-family:arial;padding:6px 10px 7px 65px" valign="middle" bgcolor="#e5e5e5" align="left">'.$noidung2['ten'].'</td>
            </tr>
			<tr>
				<td valign="top" align="center">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
					<tr>
					<td valign="top" align="center">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody>
						<tr>
							<td style="font-family:arial;font-size:17px;line-height:1.6;padding:16px 28px 0px 65px;color:#666" valign="top" align="left">'.$noidung2['noidung'].'</td>
						</tr>
						<tr>
							<td style="font-family:arial;font-size:18px;line-height:25px;font-weight:500;padding:26px 28px 0px 65px;color:#202124" valign="top" align="center"><a style="display:inline-block; width:260px; text-align:center; padding:8px 25px; padding-top:10px; background:#1972e8; border-radius:5px; color:#fff; font-weight:bold; text-decoration:none; font-size:16px; box-sizing:border-box;" href="'.$noidung2['link'].'">Xem Chi Tiết</a><br><br></td>
						</tr>
					</tbody>
					</table>
					</td>
					
					<td width="355" valign="top" align="center">
					<table cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                    <tr>
						<td valign="top" align="center" style="padding:10px 10px 10px 0;">
							<img src="https://'.$config_url.'/'._upload_hinhanh_l.$noidung2['photo'].'" style="margin-bottom:10px; width:100%; box-sizing:border-box; display:block;"/>
							<img src="https://'.$config_url.'/'._upload_hinhanh_l.$noidung2['photo2'].'" style="display:block; width:100%; box-sizing:border-box;"/>
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
                                                            </table>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td valign="top" align="center">
                    <table cellspacing="0" cellpadding="0" border="0">
					<tbody>
					<tr>
						<td style="line-height:40px" height="40">
							<img src="https://ci3.googleusercontent.com/proxy/Zre1fAeZon4GoBOJld1BwQBOoDp_nPvbMfWpo_oz1aUl9pMZintgHpbeOa_lM19isQUdBIWybtskSbQzO011QdafXFOEgtL5DEZ2dw=s0-d-e1-ft#https://services.google.com/fh/files/emails/spacer_11.gif" alt="" style="display:block" width="1" height="1" border="0" class="CToWUd">
                        </td>
                    </tr>
                    </tbody>
                    </table>
											</td>
                                          </tr>
                                           <tr>
                                             <td valign="top" align="center">
                                                <table width="750" cellspacing="0" cellpadding="0" border="0">
                                                   <tbody>
	<tr>
		<td style="border:1px solid #b3b8bc;border-top:4px solid #7d1315;border-collapse:collapse" valign="top" align="center">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
            <tr>
				<td style="line-height:39px;font-size:20px;color:#666666;font-family:arial;padding:6px 10px 7px 65px" valign="middle" bgcolor="#e5e5e5" align="left">'.$noidung3['ten'].'</td>
            </tr>
			<tr>
				<td valign="top" align="center">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
					<tr>
					<td valign="top" align="center">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody>
						<tr>
							<td style="font-family:arial;font-size:17px;line-height:1.6;padding:16px 28px 0px 65px;color:#666666" valign="top" align="left">'.$noidung3['noidung'].'</td>
						</tr>
						<tr>
							<td style="font-family:arial;font-size:18px;line-height:25px;font-weight:500;padding:26px 28px 0px 65px;color:#202124" valign="top" align="center"><a style="display:inline-block; width:260px; text-align:center; padding:8px 25px; padding-top:10px; background:#1972e8; border-radius:5px; color:#fff; font-weight:bold; text-decoration:none; font-size:16px; box-sizing:border-box;" href="'.$noidung3['link'].'">Báo Giá</a><br><br></td>
						</tr>
					</tbody>
					</table>
					</td>
					
					<td width="355" valign="top" align="center">
					<table cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                    <tr>
						<td valign="top" align="center" style="padding:10px 10px 10px 0;">
							<img src="https://'.$config_url.'/'._upload_hinhanh_l.$noidung3['photo'].'" style=" width:100%; box-sizing:border-box; display:block;"/>
							 
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
                                                            </table>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td valign="top" align="center">
                    <table cellspacing="0" cellpadding="0" border="0">
					<tbody>
					<tr>
						<td style="line-height:40px" height="40">
							<img src="https://ci3.googleusercontent.com/proxy/Zre1fAeZon4GoBOJld1BwQBOoDp_nPvbMfWpo_oz1aUl9pMZintgHpbeOa_lM19isQUdBIWybtskSbQzO011QdafXFOEgtL5DEZ2dw=s0-d-e1-ft#https://services.google.com/fh/files/emails/spacer_11.gif" alt="" style="display:block" width="1" height="1" border="0" class="CToWUd">
                        </td>
                    </tr>
                    </tbody>
                    </table>
											</td>
                                          </tr>
                                           
                                          <tr>
                                             <td valign="top" align="center">
					<table width="750" cellspacing="0" cellpadding="0" border="0">
					<tbody>
					<tr>
						<td style="line-height:67px" height="67"><img src="https://ci3.googleusercontent.com/proxy/Zre1fAeZon4GoBOJld1BwQBOoDp_nPvbMfWpo_oz1aUl9pMZintgHpbeOa_lM19isQUdBIWybtskSbQzO011QdafXFOEgtL5DEZ2dw=s0-d-e1-ft#https://services.google.com/fh/files/emails/spacer_11.gif" alt="" style="display:block" width="1" height="1" border="0" class="CToWUd"></td>
						<td style="line-height:27px" height="27"><img src="https://ci3.googleusercontent.com/proxy/Zre1fAeZon4GoBOJld1BwQBOoDp_nPvbMfWpo_oz1aUl9pMZintgHpbeOa_lM19isQUdBIWybtskSbQzO011QdafXFOEgtL5DEZ2dw=s0-d-e1-ft#https://services.google.com/fh/files/emails/spacer_11.gif" alt="" style="display:block" width="1" height="1" border="0" class="CToWUd"></td>
					</tr>
					<tr>
						<td style="font-family:arial;font-size:12px;line-height:1.6;color:#414141;font-weight:normal;padding:0px 0px 5px" valign="top" align="left">
							Hẹn gặp lại !
						</td>
					</tr>
					<tr>
						<td style="font-family:arial;font-size:12px;line-height:1.6;color:#414141;font-weight:500;padding:0px 0px 0px" valign="top" align="left">
							<b>'.$tieude3['ten'].'</b>
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
                              <tr>
                                 <td style="border-top:1px solid #9aa0a6" valign="top" align="center">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody>
					<tr>
						<td style="font-family:arial;font-size:12px;line-height:30px;color:#9aa0a6;padding:12px 0 4px 0px;font-weight:500" valign="top" align="center">
							Kết nối với chúng tôi !
						</td>
					</tr>
					<tr>
						<td style="padding:0 0 30px" valign="top" align="center">
						<table cellspacing="0" cellpadding="0" border="0" align="center">
						<tbody>
						<tr>';
							for($k=0;$k<count($ketnoi);$k++){ 
							$body.='<td dir="ltr" valign="top" align="center"><a href="'.$ketnoi[$k]['link'].'"><img src="https://'.$config_url.'/'._upload_hinhanh_l.$ketnoi[$k]['photo'].'" style="height:22px; margin:0px 4px;"/></a></td>';
							if($k+1<count($ketnoi)){
                            $body.='<td style="line-height:1px" width="6" valign="top" height="1" align="center"><img src="https://ci3.googleusercontent.com/proxy/Zre1fAeZon4GoBOJld1BwQBOoDp_nPvbMfWpo_oz1aUl9pMZintgHpbeOa_lM19isQUdBIWybtskSbQzO011QdafXFOEgtL5DEZ2dw=s0-d-e1-ft#https://services.google.com/fh/files/emails/spacer_11.gif" alt="" style="display:block" width="1" height="1" border="0" class="CToWUd"></td>';
							}
							}
						$body.='</tr>
						</tbody>
						</table>
						</td>
					</tr>
					</tbody>
					</table>
                                 </td>
                              </tr>
                              <tr>
                                 <td valign="top" bgcolor="#222222" style="padding-top:30px;">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                    <tbody>
                    <tr>
					<td valign="top" align="center">
					<table width="770" cellspacing="0" cellpadding="10" border="0" align="center">
					<tbody>
					<tr>
					<td width="144" valign="center" align="left" style="padding-right:10px;text-align:center;">
						<img src="https://'.$config_url.'/'.layhinh('photo','banner').'" style="box-sizing:border-box; max-height:48px; display:inline-block; max-width:100%;border:1px solid #bab6b6;border-radius:50%;  "/>
					</td>
					<td valign="top" align="left"></td>
					<td valign="top" align="left" style="border-left:1px solid #aeb0b3;"></td>
					<td valign="center" align="left" style=" color:#fff; font-size:11px; padding-top: 0px; padding-bottom: 0px;">
						'.$tieude4['ten'].'<br>'.$tieude5['ten'].'<br>'.$tieude6['ten'].'<br>'.$tieude9['ten'].'<br>'.$tieude10['ten'].'
					</td>
					</tr>
                    </tbody>
					</table>
                    </td>
                    </tr>
                                          <tr>
                                             <td style="padding-top:20px;padding-bottom:30px" valign="top" align="left">
                                                <table width="750" cellspacing="0" cellpadding="0" border="0" align="center">
                                                   <tbody>
                                                      <tr>
                                                         <td style="color:#ffffff;font-family:arial;font-size:10px;line-height:15px" valign="top" align="left">'.$tieude7['ten'].'<br>
                                                            '.$tieude8['ten'].'
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                      	<td style="color:#ffffff;font-family:arial;font-size:10px;line-height:15px;padding-top:15px;" valign="top" align="left">
                                                      			'.$tieude11['ten'].' <a href="'.$http.$config_url.'/unsubscribe.php?type='.$_GET['type'].'&email='.$mail_list[$i]['email'].'" style="color: #0d0abd; text-decoration: underline;">hủy đăng ký</a>.
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
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table></div>
			';
			 
			 
		 
			$mail->Body = $body;
			/*if($_FILES['file']['name']!=''){
				$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
			}*/
			if($mail->Send()){
				echo "Thư được gửi đến: ".$mail_list[$i]['email']."</br>";
				//transfer("Email đã được gửi đi.", "index.php?com=lienhe&act=man".$urlcu);
			}else{
				echo "Thư chưa được gửi đến: ".$mail_list[$i]['email']."</br>";
				//transfer("Hệ thống bị lỗi, xin thử lại sau.", "index.php?com=lienhe&act=man".$urlcu);
			}
		} 
		transfer("Email đã được gửi đi.", "index.php?com=lienhe&act=man".$urlcu);
	}
	
//===========================================================
switch($act){
	case "man":
		get_items();
		$template = "lienhe/items";
		break;
	case "add":
		$template = "lienhe/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "lienhe/item_add";
		break;
	case "save":
		save_item();
		break;
	case "savestt":
		savestt_item();
		break;
	case "delete":
		delete_item();
		break;		

	case "bohuy":
		bohuy_item();
		break;	

	default:
		$template = "index";
}
//===========================================================
function fns_Rand_digit($min,$max,$num){
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}
//===========================================================
function get_items(){
	/*global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	if($_REQUEST['type']!=''){
		$where.=" and type='".$_REQUEST['type']."'";
	}
	if($_REQUEST['key']!=''){
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.=" order by stt,id desc";	

	$sql="SELECT count(id) AS numrows FROM #_lienhe where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_lienhe where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=lienhe&act=man".$urlcu;*/

}
//===========================================================
function get_item(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=lienhe&act=man".$urlcu);
	
	$sql = "select * from #_lienhe where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực","index.php?com=lienhe&act=man".$urlcu);
	$item = $d->fetch_array();
}
//===========================================================
function save_item(){
	global $d,$config,$urlcu;
	$file_name = $_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=lienhe&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);		
		if($photo = upload_image("file", _format_duoihinh ,_upload_khac,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('lienhe');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_khac.$row['photo']);
			}
		}
		$data['tencty'] = $_POST['tencty'];
		$data['type'] = $_POST['type'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['email'] = $_POST['email'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['link'] = $_POST['link'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['huy'] = isset($_POST['huy']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];	
			$data['diachi'.$key] = $_POST['diachi'.$key];	
			$data['chude'.$key] = $_POST['tchudeen'.$key];	
			$data['noidung'.$key] = $_POST['noidung'.$key];		
		}	
		
		$d->setTable('lienhe');
		$d->setWhere('id', $id);
		if($d->update($data))			
				redirect("index.php?com=lienhe&act=man".$urlcu);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=lienhe&act=man".$urlcu);
	}else{
		
		$d->reset();
		$sql = "select email,ten from #_lienhe where email='".$_POST['email']."' and type='".$_GET['type']."' ";
		$d->query($sql);
		if($d->num_rows()>0){
			transfer("Email đã tồn tại tên hệ thống", "index.php?com=lienhe&act=man".$urlcu);
		}
		
		if($photo = upload_image("file", _format_duoihinh ,_upload_khac,$file_name)){
			$data['photo'] = $photo;	
		}
		$data['type'] = $_POST['type'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['link'] = $_POST['link'];
		$data['email'] = $_POST['email'];
		$data['tencty'] = $_POST['tencty'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['huy'] = isset($_POST['huy']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];	
			$data['diachi'.$key] = $_POST['diachi'.$key];	
			$data['chude'.$key] = $_POST['tchudeen'.$key];	
			$data['noidung'.$key] = $_POST['noidung'.$key];		
		}
		
		$d->setTable('lienhe');
		if($d->insert($data))
			redirect("index.php?com=lienhe&act=man".$urlcu);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=lienhe&act=man".$urlcu);
	}
}
//===========================================================
function delete_item(){
	global $d,$urlcu;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_lienhe where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_khac.$row['photo']);
			}
			$sql = "delete from #_lienhe where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=lienhe&act=man".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=lienhe&act=man".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_lienhe where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_khac.$row['photo']);
			}
			$sql = "delete from #_lienhe where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=lienhe&act=man".$urlcu);} else transfer("Không nhận được dữ liệu", "index.php?com=lienhe&act=man".$urlcu);
}



//===========================================================
function bohuy_item(){
	global $d,$urlcu;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_lienhe where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "UPDATE table_lienhe SET huy=0, lydo='' where id='".$id."'";
			$d->query($sql);
		}
		redirect("index.php?com=lienhe&act=man".$urlcu);

	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_lienhe where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				
				$sql = "UPDATE table_lienhe SET huy=0, lydo='' where id='".$id."'";
				$d->query($sql);
			}
			
		} redirect("index.php?com=lienhe&act=man".$urlcu);} else transfer("Không nhận được dữ liệu", "index.php?com=lienhe&act=man".$urlcu);
}

?>


