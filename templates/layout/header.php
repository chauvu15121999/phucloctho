<?php $baiviet = get_news('bai-viet',3); ?>
<div class="header clearfix">
	<div class="themthanhcong" id="themhang">Thêm giỏ hàng thành công.</div>
	<a class="box-giohang-fix" href="gio-hang.html">
		<b><?php if(count($_SESSION['cart'])>0)echo count($_SESSION['cart']);else echo '0';?></b> SP
	</a>
	<div class="wap_1200 clearfix">
<div class="head-line">
	<div class="list-news">
		<a href="thong-bao.html"><i class="fa fa-bell"></i>&nbsp;Thông báo</a>
		<a href="ho-tro.html"><i class="fa fa-info-circle"></i>&nbsp;Hỗ trợ</a>
		<span class="social">Kết nối: <a href="<?=$company['fanpage']?>" target="_blanl"><i class="fab fa-facebook-square"></i></a>&nbsp;<a href="<?=$company['youtube']?>" target='_blank'><i class="fab fa-youtube"></i></a></span>



	</div>
<div class="dkc">
				<div class="langCon">
					<div class="execphpwidget">
						<!--<div id="flags">
							<a href="" onclick="doGoogleLanguageTranslator('vi|vi'); return false;" title="Việt Nam" class="flag vi"><img src="images/vietnam.png" border="0" /></a>
							<a href="" onclick="doGoogleLanguageTranslator('vi|en'); return false;" title="English" class="flag en"><img src="images/anh.png" border="0" /></a>
						</div>-->
						<span class="w-select">
							<i class="fa fa-globe"></i>
						<select onchange="doGoogleLanguageTranslator('vi|'+$(this).val());">
							<option value="vi">Tiếng Việt</option>
							<option value="en">Tiếng Anh</option>
						</select>
						</span>
						<a href="" class="trigger-login" data-tab="tab_dangky">Đăng ký</a> | <a href="" class="trigger-login" data-tab="tab_dangnhap">Đăng nhập</a>
						<div  id="google_language_translator"></div>
					</div>
				</div>
			</div>

</div>

		<p class="icon_menu_mobi_mn"><i class="fas fa-bars"></i></p>
		<a href="" class="logo"><img src="<?=layhinh('photo','logo1')?>" alt="Banner" /></a>
		<div class="search">
			<input type="text" name="keyword" id="keyword" class="keyword" onKeyPress="doEnter(event,'keyword');" value="Bạn muốn tìm gì..." onclick="if(this.value=='Bạn muốn tìm gì...'){this.value=''}" onblur="if(this.value==''){this.value='Bạn muốn tìm gì...'}">
			<i class="fa fa-search" aria-hidden="true" onclick="onSearch(event,'keyword');"></i>
		</div>
		<div class="a_header">
			<a href="<?=layhinh('link','qc2')?>" class="quangcao-2" target="_blank"><img src="thumb/0x80/1/<?=layhinh('photo','qc2')?>" alt="Banner" />
			
			<?php /* ?><a href="gio-hang.html" class="item-head giohanghead">Giỏ hàng</a><?php */ ?>
			<?php /*if(!empty($_SESSION['user_login'])){ ?>
				<div class="item-head link_user">
					Chào <?=last_word($_SESSION['user_login']['hoten'])?> !
					<ul>
						<li><a href="thay-doi-thong-tin.html">Thông tin tài khoản</a></li>
						<li><a href="don-hang-cua-ban.html">Quản lý đơn hàng</a></li>
						<li><a href="dang-xuat.html">Thoát tài khoản</a></li>
					</ul>
				</div>
			<?php }else{ ?>
				<a class="item-head loginhead">Tài khoản</a>
			<?php }*/ ?>
		</div>


		 
		<?php if($deviceType =='computer') {?>
			

			<div class="btn_head">
				<!-- <div class="link-h no-bg">
					<a href="javascript:void(0)">
						
						<p class="icon"><i><img src="images/award.png" /></i></p>
						<p>Bảo đảm</p>
					</a>
				</div>
				<div class="link-h no-bg">
					<a href="javascript:void(0)">
						
						<p class="icon"><i><img src="images/truck.png" /></i></p>
						<p>Giao hàng</p>
					</a>
				</div>
				<div class="link-h no-bg">
					<a href="javascript:void(0)">
						
						<p class="icon"><i><img src="images/refund.png" /></i></p>
						<p>Đổi trả</p>
					</a>
				</div>
				<div class="link-h">
					<a href="so-sanh.html">
						<div class="num_sosanh">
							<?php  
							if(!empty($_COOKIE['ds_sosanh'])){
								echo count(explode('-', $_COOKIE['ds_sosanh']));
							}else{
								echo '0';
							}
							?>
						</div>
						<p class="icon"><i class="fas fa-sync-alt"></i></p>
						<p>So sánh</p>
					</a>
				</div>
				<div class="link-h">
					<a href="quan-tam.html">
						<div class="num_quantam">
							<?php  
							if(!empty($_COOKIE['ds_quantam'])){
								echo count(explode('-', $_COOKIE['ds_quantam']));
							}else{
								echo '0';
							}
							?>
						</div>
						<p class="icon"><i class="fas fa-heart"></i></p>
						<p>Quan tâm</p>
					</a>
				</div>
				-->
				<div class="link-h">
					<a href="gio-hang.html">
						<div class="qty_cart"><?=get_total();?></div>
						<p class="icon"><i class="fas fa-shopping-cart"></i></p>
						
					</a>
				</div>
			</div>
		<?php }?>


		<?php if($deviceType !='computer') {?>
		<div class="dkc1">
			<div class="langCon">
				<div class="execphpwidget">
					<!--<div id="flags">
						<a href="" onclick="doGoogleLanguageTranslator('vi|vi'); return false;" title="Việt Nam" class="flag vi"><img src="images/vietnam.png" border="0" /></a>
						<a href="" onclick="doGoogleLanguageTranslator('vi|en'); return false;" title="English" class="flag en"><img src="images/anh.png" border="0" /></a>
					</div>-->
					<div id="google_language_translator"></div>
					<div class="btn_head_mb">
						<!-- <div class="link-h"><a href="so-sanh.html"><i class="fas fa-sync-alt"></i></a></div>-->
						<!-- <div class="link-h"><a href="quan-tam.html"><i class="fas fa-heart"></i></a></div>-->
						<div class="link-h"><a href="gio-hang.html"><i class="fas fa-shopping-cart"></i></a></div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>

		


	</div>
	
</div>
 

<?php if(empty($_SESSION['user_login'])){ ?>
<div class="dknt_fix_content">
	<div class="dknt_fix ">
		<span class="close_dknt">X Close</span>

		<div class="tab_head">
			<div class="head_tab">
				<div class="tab_h" data-id="tab_dangky">ĐĂNG KÝ</div>
				<div class="tab_h active" data-id="tab_dangnhap">ĐĂNG NHẬP</div>
				<div class="tab_h" data-id="tab_nhantin">NHẬN TIN</div>
			</div>
			<div class="body_tab">
				<div id="tab_dangky" class="content_tab">
					<form method="post" name="frm_dk1" class="frm_dk" action="" enctype="multipart/form-data">
						<div class="item_dknt clearfix"> 
							<span>Email</span>
							<div>
								<input type="email" placeholder="<?=_nhapemail?>" name="email_dk" id="email_dk" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>Họ tên</span>
							<div>
								<input type="text" placeholder="Nhập họ tên" name="hoten_dk" id="hoten_dk" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>Điện thoại</span>
							<div>
								<input type="text" placeholder="Nhập số điện thoại" name="dienthoai_dk" id="dienthoai_dk" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>Mật khẩu</span>
							<div>
								<input type="password" placeholder="Nhập mật khẩu" name="pass_dk" id="pass_dk" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span style="line-height: normal;">Nhập lại mật khẩu</span>
							<div>
								<input type="password" placeholder="Nhập lại mật khẩu" name="re_matkhau_dk" id="re_matkhau_dk" />
							</div>
						</div>
						<input type="hidden" id="recaptchaResponsedk" name="recaptcha_response">
						<input type="button" value="ĐĂNG KÝ" id="btn_dangky" class="btn_sub_h"/>
					</form>
				</div>
				<div id="tab_dangnhap" class="content_tab active">
					<form method="post" name="frm_dk2" class="frm_dn" action="" enctype="multipart/form-data">
						<div class="item_dknt clearfix"> 
							<span>Email</span>
							<div>
								<input type="email" placeholder="<?=_nhapemail?>" name="email_dn" id="email_dn" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>Mật khẩu</span>
							<div>
								<input type="password" placeholder="Mật khẩu" name="pass_dn" id="pass_dn" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>&nbsp;</span>
							<div class="r-dknt">
								<a class="tab_h" data-id="tab_quenmk">Quên mật khẩu ?</a>
							</div>
						</div>
						<input type="hidden" name="act" value="dangnhap">
						<input type="hidden" id="recaptchaResponselogin" name="recaptcha_response">
						<input type="button" value="ĐĂNG NHẬP" id="btn_dangnhap" class="btn_sub_h" />
						<div class="clearfix"></div>
						<?php /*<div class="other-login-method__wrapper">
                            <div class="other-login-method">
                                Hoặc
                            </div>
                        </div>
						<div class="login-social-box">
                            <a onclick="loginFb()" class="checkout_login nk-text-facebook facebook-link cm-login-provider login-social button login-fb has-ripple">
                                <img src="./images/icon-fb.svg" width="30" height="30" alt="icon-fb">
                                Đăng nhập bằng facebook
                            </a>
                            <a id="login_gg" class="checkout_login nk-text-google google-link cm-login-provider login-social button login-gg">
                                <img src="images/30x30xicon-gg.png.pagespeed.ic.5MNmYFIWdX.webp" width="30" height="30" alt="icon-gg">
                                Đăng nhập bằng google
                            </a>
                        </div>*/?>

					</form>
				</div>
				<div id="tab_nhantin" class="content_tab dknt_fix_content">
					<form method="post" name="frm_dk_top" class="frm_dk_top" action="" enctype="multipart/form-data">
						<div class="item_dknt clearfix"> 
							<span>Email</span>
							<div>
								<input type="email" placeholder="<?=_nhapemail?>" name="email_dknt" id="email_dknt" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>Họ tên</span>
							<div>
								<input type="text" placeholder="Nhập họ tên" name="ten_dknt" id="ten_dknt" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>Điện thoại</span>
							<div>
								<input type="text" placeholder="Nhập số điện thoại" name="dienthoai_dknt" id="dienthoai_dknt" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>&nbsp;</span>
							<div class="r-dknt">
								Chúng tôi sẽ phản hồi bạn sớm nhất!
							</div>
						</div>
						<input type="hidden" id="recaptchaResponsedknt" name="recaptcha_response">
						<input type="button" value="<?=_guivahoantat?>" id="hoantat_dknt" />
					</form>
				</div>
				<div id="tab_quenmk" class="content_tab">
					<form method="post" name="frm_dk3" class="frm_quenmk" action="" enctype="multipart/form-data">
						<div class="item_dknt clearfix"> 
							<span>Email*</span>
							<div>
								<input type="email" placeholder="<?=_nhapemail?>" name="email_quenmk" id="email_quenmk" />
							</div>
						</div>
						<div class="item_dknt clearfix"> 
							<span>&nbsp;</span>
							<div class="r-dknt">
								<a class="tab_h" data-id="tab_dangnhap">< Trở lại đăng nhập</a>
							</div>
						</div>
						<input type="hidden" id="recaptchaResponsequenmk" name="recaptcha_response">
						<input type="button" value="GỬI" id="btn_quenmk" class="btn_sub_h"/>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	
</div>
<script type="text/javascript">
	$().ready(function(){
		$(".tab_h").click(function(){
			if($(this).hasClass('active')){}else{
				$(".tab_h").removeClass('active');
				$(this).addClass('active');
				$(".body_tab .content_tab").hide();
				let item_tab = $(this).attr('data-id');
				$(".tab_h[data-id='"+item_tab+"']").addClass('active');
				$("#"+item_tab).fadeIn('fast');
			}
		});


  		$(document).on('click','#btn_dangky',function() {
  			
			var root = $('.frm_dk');
			loadRecapchatFrm('recaptchaResponsedk','dangky');
			if(isEmpty(root.find('#email_dk').val(), "Xin nhập email")){
				root.find('#email_dk').focus();
				return false;
			}
			if(isEmail(root.find('#email_dk').val(), "Email không hợp lệ")){
				root.find('#email_dk').focus();
				return false;
			}
			if(isEmpty(root.find('#hoten_dk').val(),"Xin nhập Họ tên")){
				root.find('#hoten_dk').focus();
				return false;
			}
			if(isEmpty(root.find('#dienthoai_dk').val(),"Xin nhập số điện thoại")){
				root.find('#dienthoai_dk').focus();
				return false;
			}
			if(isEmpty(root.find('#pass_dk').val(),"Xin nhập mật khẩu")){
				root.find('#pass_dk').focus();
				return false;
			}
			if(isEmpty(root.find('#re_matkhau_dk').val(),"Xin nhập lại mật khẩu")){
				root.find('#re_matkhau_dk').focus();
				return false;
			}
			if(root.find('#pass_dk').val()!=root.find('#re_matkhau_dk').val()){
				alert('Nhập lại mật khẩu không đúng');
				root.find('#re_matkhau_dk').focus();
				return false;
			}
			$(".page-loading").show();
			setTimeout(function(){
				act_dk_user();
			},1000);
			// root.find('.dknt_fix').removeClass('dknt_fix_active');
			// root.find('.shadow_dknt').removeClass('shadow_dknt_avtic');
			
			return false;
		});

		$(document).on('click','#btn_dangnhap',function() {
			
			var root = $('.frm_dn');
			loadRecapchatFrm('recaptchaResponselogin','login');
			if(isEmpty(root.find('#email_dn').val(), "Xin nhập email")){
				root.find('#email_dn').focus();
				return false;
			}
			if(isEmail(root.find('#email_dn').val(), "Email không hợp lệ")){
				root.find('#email_dn').focus();
				return false;
			}
			if(isEmpty(root.find('#pass_dn').val(),"Xin nhập mật khẩu")){
				root.find('#pass_dn').focus();
				return false;
			}
			$(".page-loading").show();
			setTimeout(function(){
				act_login_user();
			},1000);
			// root.find('.dknt_fix').removeClass('dknt_fix_active');
			// root.find('.shadow_dknt').removeClass('shadow_dknt_avtic');

			return false;
		});


		$(document).on('click','#btn_quenmk',function() {
			
			var root = $('.frm_quenmk');
			loadRecapchatFrm('recaptchaResponsequenmk','quenmk');
			if(isEmpty(root.find('#email_quenmk').val(), "Xin nhập email")){
				root.find('#email_quenmk').focus();
				return false;
			}
			if(isEmail(root.find('#email_quenmk').val(), "Email không hợp lệ")){
				root.find('#email_quenmk').focus();
				return false;
			}
			$(".page-loading").show();
			setTimeout(function(){
				act_mk_user();
			},1000);
			// root.find('.dknt_fix').removeClass('dknt_fix_active');
			// root.find('.shadow_dknt').removeClass('shadow_dknt_avtic');

			return false;
		});
		
		function act_mk_user(){
			$.ajax({
				type: 'post',
				url: 'ajax/quen_mk.php',
				data: $(".frm_quenmk").serialize(),
				dataType:'json',
				success:function(kq){
					$(".page-loading").fadeOut('fast');
					if(kq.error==0){
						$(".frm_quenmk")[0].reset();
					}
					add_popup(kq.mess);
	 			}
			});	
			return false;
		}

		function act_login_user(){
			$.ajax({
				type: 'post',
				url: 'ajax/dangnhap.php',
				data: $(".frm_dn").serialize(),
				dataType:'json',
				success:function(kq){
					$(".page-loading").fadeOut('fast');
					if(kq.error==1){
						add_popup(kq.mess);
					}else{
						location.reload();
					}
	 			}
			});	
			return false;
		} 

		function act_dk_user(){
			$.ajax({
				type: 'post',
				url: 'ajax/dangky.php',
				data: $(".frm_dk").serialize(),
				dataType:'json',
				success:function(kq){
					$(".page-loading").fadeOut('fast');
					if(kq.error==1){
						add_popup(kq.mess);
					}else{
						location.reload();
					}
	 			}
			});	
			return false;
		} 

	})
</script>
<?php } ?>