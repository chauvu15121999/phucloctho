<?php $baiviet = get_news('bai-viet',3);  ?>
<div class="container">
	<div class="themthanhcong" id="themhang">Thêm giỏ hàng thành công.</div>
		<a class="box-giohang-fix" href="gio-hang.html">
			<b><?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)echo count($_SESSION['cart']);else echo '0';?></b> SP
		</a>
	<!-- TOP HEADER -->
	<div class="row py-2 head-line ">
		<div class="list-news col">
			<a href="thong-bao.html"><i class="fa fa-bell"></i>&nbsp;Thông báo</a>
			<a href="ho-tro.html"><i class="fa fa-info-circle"></i>&nbsp;Hỗ trợ</a>
			<a href="lien-he.html"><i class="fa fa-phone"></i>&nbsp;Liên hệ</a>
			<span class="social">Kết nối: <a href="<?=$company['fanpage']?>" target="_blanl"><i class="fab fa-facebook-square"></i></a>&nbsp;<a href="<?=$company['youtube']?>" target='_blank'><i class="fab fa-youtube"></i></a>
			</span>
		</div>
		<div class="dkc col d-flex justify-content-end ">
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
					<!-- CHECK IF USER LOGIN -->
					<? if(empty($_SESSION['user_login'])){ ?>
						<a href="#nav-signup" data-tab-id="nav-signup-tab" data-bs-toggle="modal" data-bs-target="#login-signup-modal">Đăng ký</a> | 
						<a href="#nav-login" data-tab-id="nav-login-tab" data-bs-toggle="modal" data-bs-target="#login-signup-modal">Đăng nhập</a>
					<?} else { ?>
						<span class="item-head link_user">
							Chào <?=last_word($_SESSION['user_login']['hoten'])?> !
							<ul>
								<li><a href="thay-doi-thong-tin.html">Thông tin tài khoản</a></li>
								<li><a href="don-hang-cua-ban.html">Quản lý đơn hàng</a></li>
								<li><a href="dang-xuat.html">Thoát tài khoản</a></li>
							</ul>
						</span>
					<? } ?>
					<div  id="google_language_translator"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row d-flex justify-content-between">
		<div class="col-md-1 col-12 d-flex flex-lg-row justify-content-between flex-row-reverse">
			<p class="icon_menu_mobi_mn"><i class="fas fa-bars"></i></p>
			<a href="" class="logo"><img src="<?=layhinh('photo','logo1')?>" alt="Banner" /></a>
		</div>
		<div class="col-md-6 col-12 search mt-lg-0 mt-2 d-flex align-items-center pe-0">
			<input type="text" name="keyword" id="keyword" class="keyword" 
				onKeyPress="doEnter(event,'keyword');" value="Bạn muốn tìm gì..." 
				onclick="if(this.value=='Bạn muốn tìm gì...'){this.value=''}" 
				onblur="if(this.value==''){this.value='Bạn muốn tìm gì...'}"
			>
			<i class="fa fa-search" aria-hidden="true" onclick="onSearch(event,'keyword');"></i>
		</div>
		<div class="col-4 ads d-lg-flex  d-none justify-content-end align-items-center p-0">
			<a href="<?=layhinh('link','qc2')?>" class="quangcao-2" target="_blank">
				<img src="thumb/0x80/1/<?=layhinh('photo','qc2')?>" alt="Banner" />
			</a>
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
		<div class="col-md-1 col-12 shopping-carts mt-lg-0 mt-2 d-flex align-items-center">
			<?php if($deviceType =='computer') {?>
				<div class="row d-flex justify-content-center justify-content-end pe-3">
								<?php  
									// if(!empty($_COOKIE['ds_sosanh'])){
									// 	echo count(explode('-', $_COOKIE['ds_sosanh']));
									// }else{
									// 	echo '0';
									// }
									// if(!empty($_COOKIE['ds_quantam'])){
									// 	echo count(explode('-', $_COOKIE['ds_quantam']));
									// }else{
									// 	echo '0';
									// }
								?>
					<div class="shoping-carts-btn">
						<a href="gio-hang.html">
							<div class="qty_cart"><?=get_total();?></div>
							<p class="icon mb-0"><i class="fas fa-shopping-cart"></i></p>
						</a>
					</div>
				</div>
			<?php }?>
			<!-- MOBILE -->
			<?php if($deviceType !='computer') {?>
			<div class="row d-flex justify-content-end px-2">
				<div class="langCon">
					<div class="execphpwidget">
						<div id="google_language_translator"></div>	
					</div>
				</div>
				<div class="shoping-carts-btn"><a href="gio-hang.html"><i class="fas fa-shopping-cart"></i></a></div>
			</div>
			<?php }?>
		</div>
	</div>
</div>
<?php if(empty($_SESSION['user_login'])){ ?>
<!-- Modal -->
<div class="modal fade modal-login" id="login-signup-modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<nav>
					<div class="nav nav-tabs" id="nav-tab" >
						<button class="nav-link active" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="true">ĐĂNG NHẬP</button>
						<button class="nav-link" id="nav-signup-tab" data-bs-toggle="tab" data-bs-target="#nav-signup" type="button" role="tab" aria-controls="nav-signup" aria-selected="false">ĐĂNG KÝ</button>
						<button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">NHẬN TIN</button>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
						<form class="row g-3 mt-3 login d-block" id="loginForm" method="post" enctype="multipart/form-data">
							<div class="col-12">
								<div class="row">
									<label for="emailLogin" class="form-label col-sm-3">Email</label>
									<div class="col-sm-9">
										<input name="emailLogin" type="email" class="form-control" id="emailLogin" placeholder="Nhập Email">
										<div id="emailLoginFeedback" class="invalid-feedback">
											<!-- JS APPEND HERE -->
										</div>
									</div>
								</div>	
							</div>
							<div class="col-12">
								<div class="row">
									<label for="inputPasswordLogin" class="col-sm-3 col-form-label">Mật khẩu</label>
									<div class="col-sm-9">
										<input name="passwordLogin" type="password" class="form-control" id="passwordLogin" placeholder="Nhập mật khẩu ">
										<div id="passwordLoginFeedback" class="invalid-feedback">
											<!-- JS APPEND HERE -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<a class="forget-trigger">Quên mật khẩu ?</a>
							</div>
							<div class="col-12 text-end">
								<input type="hidden" id="recaptchaResponseLogin" name="recaptcha_response">
								<button class="btn btn-danger" type="submit">ĐĂNG NHẬP</button>
							</div>
						</form>
						<div class="row login login-3rd mt-3">
							<div class="col-12 d-flex align-items-center">
								<div class="line"></div>
								<span>HOẶC</span>
								<div class="line"></div>
							</div>
							<div class="col-12 d-flex flex-wrap justify-content-between ">
								<button class="social">
									<div class="icon-socia me-2">
										<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="30px" height="30px"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
									</div>
									<div class="text">Google</div>
								</button>
								<button class="social">
									<div class="icon-socia me-2">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30px" height="30px"><path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"/><path fill="#fff" d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z"/></svg>
									</div>
									<div class="text">Facebook</div>
								</button>
							</div>
						</div>
						<form class="row g-3 mt-3 forget-pass d-none" id="forgetForm" method="post" enctype="multipart/form-data">
							<div class="col-12">
								<div class="row">
									<label for="emailLogin" class="form-label col-sm-3">Email</label>
									<div class="col-sm-9">
										<input name="emailForget" type="email" class="form-control" id="emailForget" placeholder="Nhập Email">
										<div id="emailForgetFeedback" class="invalid-feedback">
											<!-- JS APPEND HERE -->
										</div>
									</div>
								</div>	
							</div>
							<div class="col-12">
								<a class="return-login-trigger">Quay lại đăng nhập ?</a>
							</div>
							<div class="col-12 text-end">
							<input type="hidden" id="recaptchaResponseForget" name="recaptcha_response">
								<button class="btn btn-danger" type="submit">GỬI</button>
							</div>
						</form>
					</div>
					<div class="tab-pane fade" id="nav-signup" role="tabpanel" aria-labelledby="nav-signup-tab">
						<!-- <div class="alert alert-success alert-signup mt-3" role="alert">
							Đăng ký thành công
						</div> -->
						<form class="row g-3 mt-3"  id="signupForm" class="signupForm" method="post" enctype="multipart/form-data">
							<div class="col-12">
								<div class="row">
									<label for="emailSignup" class="form-label col-sm-3">Email</label>
									<div class="col-sm-9">
										<input name="emailSignup" type="email" class="form-control" id="emailSignup" placeholder="Nhập Email">
										<div id="emailSignupFeedback" class="invalid-feedback">
											<!-- JS APPEND HERE -->
										</div>
									</div>
								</div>	
							</div>
							<div class="col-12">
								<div class="row">
									<label for="name" class="form-label col-sm-3">Họ Tên</label>
									<div class="col-sm-9">
										<input name="nameSignup" type="text" class="form-control" id="nameSignup" placeholder="Nhập họ tên">
										<div id="nameSignupFeedback" class="invalid-feedback">
											<!-- JS APPEND HERE -->											
										</div>
									</div>
								</div>	
							</div>
							<div class="col-12">
								<div class="row">
									<label for="numberphone" class="form-label col-sm-3">Điện Thoại</label>
									<div class="col-sm-9">
										<input name="phoneSignup" type="text" class="form-control" id="phoneSignup" placeholder="Nhập số điện thoại">
										<div id="phoneSignupFeedback" class="invalid-feedback">
											<!-- JS APPEND HERE -->
										</div>
									</div>
								</div>	
							</div>
							<div class="col-12">
								<div class="row">
									<label for="inputPasswordSignup" class="col-sm-3 col-form-label">Mật khẩu</label>
									<div class="col-sm-9">
										<input name="passwordSignup" type="password" class="form-control" id="passwordSignup"  placeholder="Nhập mật khẩu">
										<div id="passwordSignupFeedback" class="invalid-feedback">
											<!-- JS APPEND HERE -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<label for="inputPasswordSignupAgian" class="col-sm-3 col-form-label">Mật khẩu</label>
									<div class="col-sm-9">
										<input name="confirmPasswordSignup" type="password" class="form-control" id="confirmPasswordSignup"  placeholder="Nhập lại mật khẩu">
										<div id="confirmPasswordSignupFeedback" class="invalid-feedback">
											<!-- JS APPEND HERE -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 text-end">
								<input type="hidden" id="recaptchaResponseSignup" name="recaptcha_response">
								<button class="btn btn-danger" id="signupSubmit" type="submmit">ĐĂNG KÝ</button>
							</div>
						</form>
						<div class="row login login-3rd mt-3">
							<div class="col-12 d-flex align-items-center">
								<div class="line"></div>
								<span>HOẶC</span>
								<div class="line"></div>
							</div>
							<div class="col-12 d-flex flex-wrap justify-content-between ">
								<button class="social">
									<div class="icon-socia me-2">
										<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="30px" height="30px"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
									</div>
									<div class="text">Google</div>
								</button>
								<button class="social">
									<div class="icon-socia me-2">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30px" height="30px"><path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"/><path fill="#fff" d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z"/></svg>
									</div>
									<div class="text">Facebook</div>
								</button>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
						<form class="row g-3 mt-3">
							<div class="col-12">
								<div class="row">
									<label for="emailContact" class="form-label col-sm-3">Email</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" id="emailContact" placeholder="Nhập Email">
									</div>
								</div>	
							</div>
							<div class="col-12">
								<div class="row">
									<label for="name" class="form-label col-sm-3">Họ Tên</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="name" placeholder="Nhập họ tên">
									</div>
								</div>	
							</div>
							<div class="col-12">
								<div class="row">
									<label for="numberphone" class="form-label col-sm-3">Điện Thoại</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="numberphone" placeholder="Nhập số điện thoại">
									</div>
								</div>	
							</div>
							<div class="col-12 text-end">
								<button class="btn btn-danger" type="submit">GỬI & HOÀN TẤT</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- JS  -->
<script type="text/javascript">
	$().ready(function(){
		// Load repcaptcha for form
		loadRecapchatFrm('recaptchaResponseSignup','signupForm');
		loadRecapchatFrm('recaptchaResponseLogin','loginForm');
		loadRecapchatFrm('recaptchaResponseForget','forgetForm');

		$(".return-login-trigger").click(function(){
			$('.login').addClass('d-block')
			$('.login').removeClass('d-none');
			$('.forget-pass').addClass('d-none')
			$('.forget-pass').removeClass('d-block');
		});

		$(".forget-trigger").click(function(){
			$('.forget-pass').addClass('d-block')
			$('.forget-pass').removeClass('d-none');
			$('.login').removeClass('d-block');
			$('.login').addClass('d-none')
		});


  		$("#signupForm").submit(function(e) {
			e.preventDefault();
			const result = submitSearch($(this) , 'ajax/dangky.php' , 'post')
			if (result) {
				alert('đăng ký thành công');
				reloadPage();
			} else {
				return result;
			}
		});


		$("#forgetForm").submit(function(e) {
			e.preventDefault();
			const result = submitSearch($(this) , 'ajax/quen_mk.php' , 'post');
			// if (result) {
			// 	alert('đăng nhập thành công');
			// 	reloadPage();
			// } else {
			// 	return result;
			// }
		});

		$("#loginForm").submit(function(e) {
			e.preventDefault();
			const result = submitSearch($(this) , 'ajax/dangnhap.php' , 'post');
			if (result) {
				alert('đăng nhập thành công');
				reloadPage();
			} else {
				return result;
			}
		});
				
		function act_mk_user(){
			$.ajax({
				type: 'post',
				url: 'ajax/quen_mk.php',
				data: $(".frm_quenmk").serialize(),
				dataType:'json',
				success:function(kq){
					$(".page-loading").fadeOut('fast');
					if(kq.status==0){
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
					if(kq.status==1){
						add_popup(kq.mess);
					}else{
						location.reload();
					}
	 			}
			});	
			return false;
		} 

		function reloadPage() {
			location.reload();		
		}
		
		function submitSearch( element , url , method ) {
			let data = element.serialize();
			let input = element.find('.form-control');
			let invalidFeedback = element.find('.invalid-feedback');
			// REMOVE CLASS INVALID IF HAVE
			input.each(function(i) {
				if($(this).hasClass('is-invalid')) {
					$(this).removeClass('is-invalid')
				}
				if($(this).hasClass('is-valid')) {
					$(this).removeClass('is-valid')
				} 
			})
			invalidFeedback.each(function(i) {
				$(this).empty();
			})
			// let invalid = 
			const res = callApi( url, data , method);
			let { status , message } = res;
			if (status != 200) {
				for (const mess in message) {
					$(`#${mess}`).addClass('is-invalid')
					$(`#${mess}Feedback`).append(message[mess][0])
				}
				// ADD CLASSIC IS-VALID
				input.each(function(i) {
					if(!$(this).hasClass('is-invalid')) {
						$(this).addClass('is-valid')
					} 
				})
				return false;
			} else {
				return true;
			}
		}
	})
</script>
<?php } ?>