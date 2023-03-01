


<?php $chinhsach = get_news('chinh-sach-mua-hang',5); ?>
<div class="wap_footer">
	<div class="footer container p-0">
		<div class="wrap-footer row">
			<div class="col col-1">
				<div class="big-title">CHĂM SÓC KHÁCH HÀNG</div>
				<div class="content">
					<ul>
					<?php 
						$rows = $d->result_array($d->query("select * from #_news where type='chinh-sach-mua-hang' and hienthi > 0 order by stt asc,id desc"));
						foreach($rows as $k=>$v){
							echo '<li><a href="chinh-sach-mua-hang/'.$v['tenkhongdau'].'-'.$v['id'].'.html">'.$v['ten'.$lang].'</a></li>';
						}
					?>
					</ul>
				</div>
			</div>
			<div class="col col-2">
				<div class="big-title">VỀ PHÚC LỘC THỌ</div>
				<div class="content">
					<ul>
					<?php 
						$rows = $d->result_array($d->query("select * from #_news where type='gioi-thieu' and hienthi > 0 order by stt asc,id desc"));
						foreach($rows as $k=>$v){
							echo '<li><a href="gioi-thieu/'.$v['tenkhongdau'].'-'.$v['id'].'.html">'.$v['ten'.$lang].'</a></li>';
						}
					?>
					
					<li><a href="tin-tuc.html">Tin tức</a></li>
					<li><a href="video.html">Video</a></li>
					<li><a href="lien-he.html">Liên hệ</a></li>
					</ul>
				</div>
			</div>
			<div class="col col-3">
				<div class="big-title">THANH TOÁN</div>
				<div class="content">
					<?php 
						$row = $d->fetch_array($d->query('select photo from #_background where type="payment"'));
						echo '<img src="'._upload_hinhanh_l.$row['photo'].'" />';
					?>
				</div>
				<div class="content mt-2 congthuong">
					<?php 
						$row = $d->fetch_array($d->query('select photo from #_background where type="congthuong"'));
						echo '<img src="'._upload_hinhanh_l.$row['photo'].'" />';
					?>
				</div>
			</div>
			<div class="col col-4">
				<div class="big-title">HỖ TRỢ NHANH</div>
				<div class="content">
					<?php 
						$rows = $d->result_array($d->query("select * from #_yahoo where type='yahoo' and hienthi > 0 order by stt asc,id desc"));
						foreach($rows as $k=>$v){
							?>
								<div class="support-item">
									<div class='name'><i class="fa fa-user"></i>&nbsp; <?=$v['ten']?></div>
									<div class="line"><i class="fa fa-phone"></i>&nbsp; Hotline: <span><?=$v['dienthoai']?></span></div>
									<div class="line"><i class="fa fa-envelope"></i>&nbsp; Email: <span><?=$v['email']?></span></div>
								</div>
							<?php 
						}
					?>
				</div>
			</div>
			<div class="col col-5">
				<div class="big-title">THEO DÕI CHÚNG TÔI TRÊN</div>
				<div class="content">
					<?php 
						foreach($d->result_array($d->query("select * from #_lkweb where type='mxh' and hienthi > 0 order by stt asc,id desc")) as $v){
							
							echo '<div class="social-item"><a href="'.$v['link'].'"><img src="'._upload_khac_l.$v['photo'].'" />&nbsp;'.$v['ten'].'</a></div>';
						}
					?>
				</div>
			</div>
		</div>
		<?php /*
		<?php if($deviceType == 'computer') {?>
			<div id="tuvan">
				<div class="td_ft">Hỗ trợ tư vấn</div>
				<div class="frm_lienhe">
					<form method="post" name="frm_fot" class="frm_fot" action="ajax/tuvan.php" enctype="multipart/form-data">
						<div class="loicapcha thongbao"></div>
						<div class="clearfix">
							<div class="item_lienhe"><input name="ten_lienhe" type="text" id="ten_lienhe_fot" placeholder="<?=_hovaten?>" /></div>
							<div class="item_lienhe"><input name="email_lienhe" type="text" id="email_lienhe_fot" placeholder="Email" /></div>
							<div class="item_lienhe"><input name="dienthoai_lienhe" type="text" id="dienthoai_lienhe_fot" placeholder="<?=_dienthoai?>" /></div>
							<div class="item_lienhe"><textarea name="noidung_lienhe" id="noidung_lienhe_fot" rows="5" placeholder="<?=_noidung?>"></textarea></div>
							
							<input type="hidden" id="recaptchaResponsefooter" name="recaptcha_response_footer">
							<div class="item_lienhe" >
								<input type="button" value="Đăng ký tư vấn" class="tuvanf" />
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php }?>
		<div id="fanpage-foot">
			<?php if($deviceType == 'computer') {?>
				<div class="td_ft">THÔNG TIN</div>
				<ul class="css_ul_foo">
					<?php foreach($chinhsach as $val){ ?>
						<li><a href="<?=$val['type']?>/<?=$val['tenkhongdau']?>-<?=$val['id']?>.html" title="<?=$val['ten']?>"><?=$val['ten']?></a></li>
					<?php }?>
					<li><a href="tai-nguyen.html" title="Tài nguyên">Tài nguyên</a></li>
				</ul>
				<div id="thongke">
					<ul>
						<li>Truy cập: <span><?php $count=count_online();echo $tong_xem=$count['dangxem'];?>/<?php $count=count_online();echo $tong_xem=$count['daxem'];?></span></li>
					</ul>
				</div>
			<?php }?>
			<?php if(layhinh('hienthi','congthuong')==1 && $deviceType == 'computer'){?>
				<a href="<?=layhinh('link','congthuong')?>" class="img-congthuong" target="_blank"><img class="lazy" data-src="<?=layhinh('photo','congthuong')?>" alt="<?=$company['ten']?>" /></a>
			<?php }?>
			<?php if(layhinh('hienthi','qc5')==1 && $deviceType == 'computer'){?>
				<a href="<?=layhinh('link','qc5')?>" class="img-congthuong" target="_blank"><img class="lazy" data-src="<?=layhinh('photo','qc5')?>" alt="<?=$company['ten']?>" /></a>
			<?php }?>
		</div>
		
		<div id="main_footer">
			<?php if($deviceType == 'computer') {?>
				<?php echo lay_text('footer');?>
			<?php }else{?>
			<div class="clearfix"></div>
			<div class="m_ft">
				<?php echo lay_text('footer_mobile');?>
			</div>
			<?php }?>
		</div>*/?>
		
		
		
	</div>
</div>
<div class="copy-right">
	<div class="wap_1200 clearfix">
		<div class="cop-l">© <span><?=$company['copy']?></span></div>
	</div>
</div>