<?php 
if($model->get("show-login")){?>


   <div class="container">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
 <div class="card card0 border-0">
        <div class="row  ">
            
            <div class="col-lg-6 border-line">
                <div class=" card border-0 px-4 py-3">
                	<div class="xtitle">KHÁCH HÀNG ĐÃ ĐĂNG KÝ</div>
                    <form method="post" action="account/login" class="validation-user" novalidate>
                    <div class="row px-3 mb-2"> 
                        <label class="mb-1">
                            <h6 class="mb-2 text-sm">Username</h6>
                        </label> <input class="form-control" type="text" name="username" placeholder="" required> 
                        <div class="invalid-feedback"><?=vuilongnhaptaikhoan?></div>
                    </div>
                    <div class="row px-3 mb-2"> <label class="mb-1">
                            <h6 class="mb-2 text-sm">Password</h6>
                        </label> <input type="password" class=" form-control" name="password" placeholder="" required>
                         <div class="invalid-feedback"><?=vuilongnhapmatkhau?></div>
                         </div>
                    <div class="row px-3 mb-2">
                        <a href="account/forgot" class="ml-auto mb-0 text-sm"><?=quenmatkhau?></a>
                    </div>
                    <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center" name="dangnhap"><?=dangnhap?></button> </div>
                    <div class="row mb-4 px-3"> <small class="font-weight-bold"><?=banchuacotaikhoan?> <a class="text-danger" href="account/register"><?=dangkytaiday?></a></small> </div>
                    <input type="hidden" name="ref" value="<?=$func->getCurrentPageUrl()?>" />
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
            	<div class=" card border-0 px-4 py-3">
            	<div class="xtitle">BẠN LÀ KHÁCH HÀNG MỚI?</div>
                <div class="card1 pb-5">
                   <form method="post">

					    <div class="fb-content">
					    <p>Bạn mới biết đến 7sport</p>
					      <p>Thông tin tài khoản sẽ được tự động tạo trong quá trình thanh toán.<br/>
Tạo tài khoản tại website sẽ giúp bạn quản lý đơn hàng dễ dàng hơn.</p>
					      <div class="divButton mt">
					        <button type="submit" class="btn btn-blue text-center" name="guest">Tiếp tục thanh toán</button>
					      </div>
					    </div>
					  </form>
                </div>
                </div>
            </div>
        </div>
      
    </div>
    </div>
    </div>
    </div>




<?php } else {?>

<div class="container">
<form class="form-cart validation-cart" novalidate method="post" action="" enctype="multipart/form-data" >
	<div class="wrap-cart d-flex align-items-stretch justify-content-between">
		<?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])) { ?>
			<div class="top-cart">
				<p class="title-cart"><?=giohangcuaban?>:</p>
				<div class="list-procart">
					<div class="procart procart-label d-flex align-items-start justify-content-between">
						<div class="pic-procart"><?=hinhanh?></div>
						<div class="info-procart"><?=tensanpham?></div>
						<div class="quantity-procart">
							<p><?=soluong?></p>
							<p><?=thanhtien?></p>
						</div>
						<div class="price-procart"><?=thanhtien?></div>
					</div>
					<?php $max = count($_SESSION['cart']); for($i=0;$i<$max;$i++) {
						$pid = $_SESSION['cart'][$i]['productid'];
						$quantity = $_SESSION['cart'][$i]['qty'];
						$mau = ($_SESSION['cart'][$i]['mau'])?$_SESSION['cart'][$i]['mau']:0;
						$size = ($_SESSION['cart'][$i]['size'])?$_SESSION['cart'][$i]['size']:0;
						$code = ($_SESSION['cart'][$i]['code'])?$_SESSION['cart'][$i]['code']:'';
						$proinfo = $cart->get_product_info($pid);
						$price = $cart->get_product_price($pid,$size);
						if($price['gia']){
							$proinfo['gia'] = $price['gia'];
							$proinfo['giamoi'] = $price['giamoi'];
							$proinfo['giakm'] = $price['giakm'];
							
						}
						$pro_price = $proinfo['gia'];
						$pro_price_new = $proinfo['giamoi'];
						$pro_price_qty = $pro_price*$quantity;
						$pro_price_new_qty = $pro_price_new*$quantity; ?>
						<div class="procart procart-<?=$code?> d-flex align-items-start justify-content-between">
							<div class="pic-procart">
								<a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/85x85x2/assets/images/noimage.png';" src="<?=THUMBS?>/85x85x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
								
							</div>
							<div class="info-procart">
								<h3 class="name-procart"><a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><?=$proinfo['ten'.$lang]?></a></h3>
								<div class="properties-procart">
									<?php if($mau) { $maudetail = $d->rawQueryOne("select ten$lang from #_product_mau where type = ? and id = ? limit 0,1",array($proinfo['type'],$mau)); ?>
										<p>Màu: <strong><?=$maudetail['ten'.$lang]?></strong></p>
									<?php } ?>
									<?php if($size) { $sizedetail = $d->rawQueryOne("select ten$lang from #_product_size where type = ? and id = ? limit 0,1",array($proinfo['type'],$size)); ?>
										<p>Size: <strong><?=$sizedetail['ten'.$lang]?></strong></p>
									<?php } ?>
								</div>
							</div>
							<div class="quantity-procart">
								<div class="price-procart price-procart-rp">
									<?php if($proinfo['giamoi']) { ?>
										<p class="price-new-cart load-price-new-<?=$code?>">
											<?=$func->format_money($pro_price_new_qty)?>
										</p>
										<p class="price-old-cart load-price-<?=$code?>">
											<?=$func->format_money($pro_price_qty)?>
										</p>
									<?php } else { ?>
										<p class="price-new-cart load-price-<?=$code?>">
											<?=$func->format_money($pro_price_qty)?>
										</p>
									<?php } ?>
								</div>
				                <div class="quantity-counter-procart quantity-counter-procart-<?=$code?> d-flex align-items-stretch justify-content-between border-0 text-center">
			                       <span class="w-100"> <?=$quantity?></span>
			                    </div>
				                <div class="pic-procart pic-procart-rp">
									<a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/85x85x2/assets/images/noimage.png';" src="<?=THUMBS?>/85x85x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
									<a class="del-procart text-decoration-none" data-code="<?=$code?>">
										<i class="fa fa-times-circle"></i>
										<span><?=xoa?></span>
									</a>
								</div>
							</div>
							<div class="price-procart">
								<?php if($proinfo['giamoi']) { ?>
									<p class="price-new-cart load-price-new-<?=$code?>">
										<?=$func->format_money($pro_price_new_qty)?>
									</p>
									<p class="price-old-cart load-price-<?=$code?>">
										<?=$func->format_money($pro_price_qty)?>
									</p>
								<?php } else { ?>
									<p class="price-new-cart load-price-<?=$code?>">
										<?=$func->format_money($pro_price_qty)?>
									</p>
								<?php } ?>
							</div>
						</div>
			        <?php } ?>
				</div>
		        <div class="money-procart">
				    <?php 
					
					
					if($config['order']['ship']) { ?>
				        <div class="total-procart d-flex align-items-center justify-content-between">
				        	<p><?=tamtinh?>:</p>
				        	<p class="total-price load-price-temp"><?=$func->format_money($cart->get_order_total())?></p>
				        </div>
				    <?php } ?>
			        <?php if($config['order']['ship']) { ?>
			        	<div class="total-procart d-flex align-items-center justify-content-between">
				        	<p><?=phivanchuyen?>:</p>
				        	<p class="total-price load-price-ship">0đ</p>
				        </div>
				    <?php } ?>
			        <div class="total-procart d-flex align-items-center justify-content-between">
			        	<p><?=tongtien?>:</p>
			        	<p class="total-price load-price-total"><?=$func->format_money($cart->get_order_total())?></p>
			        </div>
			        <input type="hidden" class="price-temp" name="price-temp" value="<?=$cart->get_order_total()?>">
			        <input type="hidden" class="price-ship" name="price-ship">
	                <input type="hidden" class="price-total" name="price-total" value="<?=$cart->get_order_total()?>">
		        </div>
		    </div>
		    <div class="bottom-cart">
			    <div class="section-cart">
		    		<p class="title-cart"><?=hinhthucthanhtoan?>:</p>
			    	<div class="information-cart">
			    		<?php foreach($httt as $key => $value) { ?>
			    			<div class="payments-cart custom-control custom-radio">
								<input type="radio" class="custom-control-input" id="payments-<?=$value['id']?>" name="payments" value="<?=$value['id']?>" required>
								<label class="payments-label custom-control-label" for="payments-<?=$value['id']?>" data-payments="<?=$value['id']?>"><?=$value['ten'.$lang]?></label>
								<div class="payments-info payments-info-<?=$value['id']?> transition"><?=str_replace("\n","<br>",$value['mota'.$lang])?></div>
							</div>
			    		<?php } ?>
			    	</div>
			    	<p class="title-cart"><?=thongtingiaohang?>:</p>
			    	<div class="information-cart">
			    		<div class="input-double-cart w-clear">
			    			<div class="input-cart">
				                <input type="text" class="form-control" id="ten" name="ten" value="<?=getUser("ten")?>" placeholder="<?=hoten?>" required />
				                <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
				            </div>
				            <div class="input-cart">
				                <input type="number" class="form-control" id="dienthoai" value="<?=getUser("dienthoai")?>" name="dienthoai" placeholder="<?=sodienthoai?>" required />
				                <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
				            </div>
			    		</div>
			            <div class="input-cart">
			                <input type="email" class="form-control" id="email" name="email" value="<?=getUser("email")?>" placeholder="Email" required />
			                <div class="invalid-feedback"><?=vuilongnhapdiachiemail?></div>
			            </div>
			            <div class="input-triple-cart w-clear">
			            	<div class="input-cart">
								<select class="select-city-cart custom-select" required id="city" name="city">
									<option value=""><?=tinhthanh?></option>
									<?php for($i=0;$i<count($city);$i++) { ?>
										<option value="<?=$city[$i]['id']?>"><?=$city[$i]['ten']?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback"><?=vuilongchontinhthanh?></div>
			            	</div>
			            	<div class="input-cart">
								<select class="select-district-cart select-district custom-select" required id="district" name="district">
									<option value=""><?=quanhuyen?></option>
								</select>
								<div class="invalid-feedback"><?=vuilongchonquanhuyen?></div>
							</div>
							<div class="input-cart">
								<select class="select-wards-cart select-wards custom-select" required id="wards" name="wards">
									<option value=""><?=phuongxa?></option>
								</select>
								<div class="invalid-feedback"><?=vuilongchonphuongxa?></div>
							</div>
						</div>
						<div class="input-cart">
			                <input type="text" class="form-control" id="diachi" name="diachi" value="<?=getUser("diachi")?>" placeholder="<?=diachi?>" required />
			                <div class="invalid-feedback"><?=vuilongnhapdiachi?></div>
			            </div>
						<div class="input-cart">
			                <textarea class="form-control" id="yeucaukhac" name="yeucaukhac" placeholder="<?=yeucaukhac?>" /></textarea>
			            </div>
			    	</div>
		    		<input type="submit" class="btn-cart btn  btn-lg btn-block btn-blue" name="thanhtoan" value="<?=thanhtoan?>" disabled>
			    </div>
		    </div>
		<?php } else { ?>
			<a href="" class="empty-cart text-decoration-none">
				<i class="fa fa-cart-arrow-down"></i>
				<p><?=khongtontaisanphamtronggiohang?></p>
				<span><?=vetrangchu?></span>
			</a>
		<?php } ?>
	</div>
</form>
</div>
<?php } ?>