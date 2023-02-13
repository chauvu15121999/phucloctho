<div class="box_container">
	<div class="tieude_giua"><div><?=_giohang?></div></div>
	<div class="box-sliderz">
		<div class="wap_l bxgh">
			<div class="left_gh">
				<div class="td_gh" style="margin-bottom:8px;"><?=_thongtingiohang?></div>
				<div class="wrap_tbl_res">
					<table class="tbl_giohang">
						<?php
								 // unset($_SESSION['cart']);
								// echo '<pre>'; print_r($_SESSION['cart']); echo '</pre>';
						if(is_array($_SESSION['cart'])){
							echo '<tr style="height:45px; font-weight:bold;" class="nowrap">
							<td rowspan="2" align="center">No</td>
							<td style="text-align:center;">'._hinhanh.'</td>

							<td style="text-align:center;">'._tenhang.'</td>

							<td align="center">'._dongia.'</td>
							<td align="center">'._soluong.'</td>
							<td align="center" class="">'._thanhtien.'</td>
							<td align="center">'._xoa.'</td>
							</tr>
							<tr style=" height:35px; font-weight:bold;">

							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>

							</tr>';
							$i=1;
							foreach($_SESSION['cart'] as $k => $v){
								if(empty($v['productid'])) continue;
								$pid = $v['productid'];
								$size = $v['size'];
								$mausac = $v['mausac'];
								$q = $v['qty'];
								$pmasp = get_code($pid);
								$pname = get_product_name($pid);
								$pbaohanh = get_baohanh($pid);
								$pcongsuat = get_congsuat($pid);
								$tiente = get_tiente($pid);
								$trongluong = get_trongluong($pid);
								$pphoto = get_product_photo($pid);
								if($tiente==2){
									$currency='usd';
								}else{
									$currency='vnđ';
								}	
								if($q == 0) continue;
								?>
								<tr class="dong_gh nowrap" data-vitri="<?=$k?>" data-size="<?=$size?>" data-mau="<?=$mausac?>" data-id="<?=$pid?>">
									<td width="5%"><?=$i?></td>

									<td width="15%" style="padding: 5px;"><img class="img_gh" src="<?=_upload_sanpham_l.$pphoto?>" alt="<?=$pname?>"/></td>

									<td width="20%" class="prewrap"><?=$pname?></td>

									<td width="10%"><?=number_format(get_price($pid),0, ',', '.')?> <?=$currency?></td>
									<td width="10%"><input class="sl_gh" type="number" value="<?=$q?>" maxlength="5" size="2" min="1" max="999" data-trongluong="<?=$trongluong?>"/></td>
									<td width="10%" class="gia_gh"><?=number_format(get_price($pid)*$q,0, ',', '.') ?> <?=$currency?></td>
									<td width="5%"><a class="xoa_gh"><i class="fas fa-trash-alt"></i></a></td>
								</tr>
								<?php $i++; } ?>
								<tr>
									<td colspan="9" class="tongtien_tam">Tạm tính: <span><?=number_format(get_order_total(),0, ',', '.')?> đ </span></td>
								</tr>
								<tr>

									<td colspan="9" class="phi_vanchuyen">
										<div>Phí vận chuyển (dự kiến): <span data-ship="0">0 đ</span></div>
										
									</td>
								</tr>
								<tr>
									<td colspan="9" class="tongtien_gh"><?=_tongtien?>: <span><?=number_format(get_order_total(),0, ',', '.')?> đ</span></td>
								</tr>
							<?php } else{
								echo "<tr><td>"._khongcosanphamtronggiohang."</td>";}?>
							</table>
						</div>

					</div><!--.left_gh-->



					<div class="right_gh">
						<div class="td_gh"><?=_thongtinkhachhang?></div>

						<div class="frm_lienhe">
							<form method="post" name="frm_order" id="frm_order" action="" enctype="multipart/form-data" onsubmit="return check();">
								<div class="box-giohang clearfix">
										<div class="item_lienhe">
										<select name="httt" id="httt">
											<option value=""><?=_htthanhtoan?>*</option>
											<?php foreach($get_httt as $k => $v) { ?>
												<option value="<?=$v['id']?>"><?=$v['ten']?></option>
											<?php } ?>
										</select>
									</div>

									 <div class="item_lienhe">
							            <select name="htvc" id="htvc">
							                <option value="">Hình thức vận chuyển </option>
							                <?php for($i = 0, $count_hinhthuc_tt = count($hinhthuc_vc); $i < $count_hinhthuc_tt; $i++){ ?>
							                    <option value="<?=$hinhthuc_vc[$i]['ten']?>"><?=$hinhthuc_vc[$i]['ten']?></option>
							                <?php } ?>
							            </select>
							        </div>

										<div class="item_lienhe">
											<input name="hoten" type="text" placeholder="<?=_hovaten?>*" id="hoten" value="<?php if($_POST['hoten']!='')echo $_POST['hoten'];else echo $info_user['hoten']?>" /></div>

											<div class="item_lienhe">
												<input placeholder="<?=_dienthoai?>*" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="dienthoai" id="dienthoai" value="<?php if($_POST['dienthoai']!='')echo $_POST['dienthoai'];else echo $info_user['dienthoai']?>" type="text"  /></div>

												<div class="item_lienhe">
													<input placeholder="Email" name="email" type="text" id="email" value="<?php if($_POST['email']!='')echo $_POST['email'];else echo $info_user['email']?>" /></div>

													<div class="item_lienhe"> 
														<select name="thanhpho" id="thanhpho">
															<option value="">Tỉnh thành*</option>
															<?php foreach($place_city as $k => $v) { ?>
																<option value="<?=$v['PROVINCE_ID']?>"><?=$v['PROVINCE_NAME']?></option>
															<?php } ?>
														</select>
													</div>

													<div class="item_lienhe"> 
														<select name="quan" id="quan">
															<option>Quận huyện*</option>
														</select>
													</div>

													<div class="item_lienhe"> 
														<select name="phuong" id="phuong">
															<option>Phường/xã*</option>
														</select>
													</div>
													<div class="item_lienhe box-noidung-gh">
														<input placeholder="<?=_diachi?>*" name="diachi" type="text" id="diachi" value="<?php if($_POST['diachi']!='')echo $_POST['diachi'];else echo $info_user['diachi']?>" />
													</div>
												</div>
												<input type="hidden" name="phi_vanchuyen" id="phi_vanchuyen" value="0">
												<input type="hidden" name="diachi_txt" id="diachi_txt" value="">
												<div class="box-giohang clearfix">
													<div class="item_lienhe box-noidung-gh">
														<textarea name="noidung" placeholder="<?=_ghichu2?>" cols="50" rows="4" ><?=$_POST['noidung']?></textarea></div>
													</div>
													<input type="hidden" id="recaptchaResponse_order" name="recaptcha_response_order">
												</form>
											</div>

											<div class="btn-gr">
												<input class="tieptuc click_ajax green" type="button" value="<?=_tieptucmuahang?>" onclick="window.location.href='index.html'" />
												<input title='<?=_dathang?>' type="button" class="click_ajax click_ajax2 yellow" value="<?=_dathang?>" />
												<input class="tieptuc indonhang red" type="button" value="In đơn hàng" onclick="document.frm_order.submit();" />
											</div>
										</div>
									</div>

								</div>
								</div>

								<script type="text/javascript">
									$(document).ready(function(e) {

										function update_qty_cart(){
											$.ajax({
												url:"ajax/cart.php",
												type:"POST",
												data:{act:"update_qty_cart"},
												success: function(kq){
													$(".qty_cart").text(kq);
												}
											})
										}

										$('.xoa_gh').click(function(){
											var root = $(this).parents('.dong_gh');
											var id = root.data('id');
											var size = root.data('size');
											var mau = root.data('mau');
											$.ajax({
												url:"ajax/cart.php",
												type:"POST",
												data:{id:id,act:"delete",size:size,mau:mau},
												success: function(kq){
													root.remove();
													$(".tongtien_tam span").html(kq);
													$(".tongtien_gh span").html(kq);
													getShip();
													update_qty_cart();
												}
											})
										});

										$('.sl_gh').change(function(){
											var root = $(this).parents('.dong_gh');
											var soluong = root.find('.sl_gh').val();
											var vitri = root.data('vitri');
											var id = root.data('id');
											console.log(id);
											$.ajax({
												url:"ajax/cart.php",
												type:"POST",
												dataType:'json',
												data:{soluong: soluong,vitri:vitri,id:id,act:"update"},
												success: function(kq){
													root.find('.gia_gh').html(kq.tonggia);
													$(".tongtien_tam span").html(kq.tongtien);
													$(".tongtien_gh span").html(kq.tongtien);
													$(".qty_cart").text(kq.total_qty);
													getShip();
												}
											})
										});

										$('#thanhpho').change(function(){
											var id_city = $(this).val();
											$.ajax({
												type:'post',
												url:'ajax/place.php',
												data:{act:'dist',id_city:id_city},
												success:function(rs){
													$('#quan').html(rs);
													$('#phuong').html('<option>PHƯỜNG/XÃ*</option>');
												}
											});
										});

										$('#quan').change(function(){
											var id_quan = $(this).val();
											$.ajax({
												type:'post',
												url:'ajax/place.php',
												data:{act:'ward',id_quan:id_quan},
												success:function(rs){
													$('#phuong').html(rs);
												}
											});
											getShip();
										});

										$('#phuong').change(function(){
											get_diachi_txt();
										});

										$('.indonhang').click(function(){	
											$('#frm_order').attr('action','indonhang.php');
											frm_order.submit();
										});

										function getShip(){
											$(".page-loading").show();
											let trongluong = 0;
											$("input[data-trongluong]").each(function(index, el) {
												trongluong += (parseInt($(this).attr('data-trongluong')) * parseInt($(this).val()));
											});
			// console.log(trongluong);
											var id_city = $("#thanhpho").val();
											var id_quan = $("#quan").val();
											$.ajax({
												url: 'ajax/getship.php',
												type: 'POST',
												data: {id_city:id_city,id_quan:id_quan,trongluong:trongluong},
												success:function(data){
													let obj = jQuery.parseJSON(data);
													$("#phi_vanchuyen").val(obj.ship);
													$(".phi_vanchuyen span").html(obj.ship_txt);
													$(".phi_vanchuyen span").attr('data-ship',obj.ship);
													total_donhang();
													$(".page-loading").fadeOut('fast');
												}
											});
										}

										function get_diachi_txt(){
											var txt1 = $("#thanhpho option:selected").text();
											var txt2 = $("#quan option:selected").text();
											var txt3 = $("#phuong option:selected").text();
											var diachi_txt = txt3+', '+txt2+', '+txt1;
											$("#diachi_txt").val(diachi_txt);
										}

										function total_donhang(){
											let ship = $(".phi_vanchuyen span").attr('data-ship');
											$.ajax({
												url: 'ajax/total_donhang.php',
												type: 'POST',
												data: {ship:ship},
												success:function(data){
													let obj = jQuery.parseJSON(data);

													$(".tongtien_tam span").html(obj.tamtinh);
													$(".phi_vanchuyen span").html(obj.ship_txt);
													$(".phi_vanchuyen span").attr('data-ship',obj.ship);
													$(".tongtien_gh span").html(obj.tong_txt);

												}
											});
										}

										$('.click_ajax2').click(function(){
											if(isEmpty($('#httt').val(), "<?=_chonhinhthucthanhtoan?>"))
											{
												$('#httt').focus();
												return false;
											}
											if(isEmpty($('#htvc').val(), "Chọn hình thức vận chuyển"))
											{
												$('#htvc').focus();
												return false;
											}
											if(isEmpty($('#hoten').val(), "<?=_nhaphoten?>"))
											{
												$('#hoten').focus();
												return false;
											}
											if(isEmpty($('#dienthoai').val(), "<?=_nhapsodienthoai?>"))
											{
												$('#dienthoai').focus();
												return false;
											}
											if(isEmpty($('#email_lienhe').val(), "<?=_emailkhonghople?>"))
											{
												$('#email_lienhe').focus();
												return false;
											}
											if(isEmpty($('#thanhpho').val(), "<?=_chontinhthanhpho?>"))
											{
												$('#thanhpho').focus();
												return false;
											}
											if(isEmpty($('#quan').val(), "<?=_chonquanhuyen?>"))
											{
												$('#quan').focus();
												return false;
											}
											if(isEmpty($('#phuong').val(), "<?=_chonphuongxa?>"))
											{
												$('#phuong').focus();
												return false;
											}

											if(isEmpty($('#diachi').val(), "<?=_nhapdiachi?>"))
											{
												$('#diachi').focus();
												return false;
											}			
											if(isEmpty($('#noidung').val(), "<?=_nhapnoidung?>"))
											{
												$('#noidung').focus();
												return false;
											}

											$('#frm_order').attr('action','gio-hang.html');
											frm_order.submit();
										});
									});
								</script>

								<div class="xvcb">
									<?php 
										echo $d->fetch_array($d->query("select noidung from #_about where type='bank'"))['noidung'];
									?>

								</div>

								<div class="xvcb">
									<div class="box_container">
									   <div class="content">
									   		<div class="tt_lh">
									        <?=lay_text('lienhe');?>
									
									        </div>

									        <div class="bando">
												<?=$company['bando']?>          
									        </div><!--.bando-->
									        <div class="clearfix"></div>
									   </div><!--.content-->
									</div><!--.box_container-->


								</div>
