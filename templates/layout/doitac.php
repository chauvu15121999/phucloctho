<?php 
	$d->reset();
	$sql = "select id,ten$lang as ten,photo,photo1,thumb,thumb1,tenkhongdau,mota$lang as mota from #_news where hienthi=1 and type='du-an' order by stt,id desc";
	$d->query($sql);
	$rs_duan = $d->result_array();

	$d->reset();
	$sql = "select id,ten$lang as ten,yahoo,dienthoai,email,photo,skype from #_yahoo where hienthi=1 and type='yahoo' order by stt,id desc limit 3";
	$d->query($sql);
	$rs_hotro = $d->result_array();
?>


		<?php if($template=='product_detail'){?>
			<div class="wap_doitac clearfix">
	<div class="doitac clearfix <?php if($source!='index'){ echo 'no_border_home';} ?>">
		<div class="dknt_index">
			<p class="title_dknt_index"><span>ĐĂNG KÝ NHẬN TIN KHUYẾN MÃI</span></p>
			<div class="dknt_index_content clearfix">
				<form method="post" name="frm_dk_dknt" class="frm_dk_dknt" action="" enctype="multipart/form-data">
					<input type="text" placeholder="Nhập họ tên" name="index_ten_dknt" id="index_ten_dknt" />
					<input type="text" placeholder="Nhập số điện thoại" name="index_dienthoai_dknt" id="index_dienthoai_dknt" />
					<input type="email" placeholder="<?=_nhapemail?>" name="index_email_dknt" id="index_email_dknt" />
					<input type="hidden" id="recaptchaResponsedknt" name="recaptcha_response_dknt">
					<input type="button" value="Đăng ký" id="index_hoantat_dknt" />
				</form>
			</div>
		</div>
			</div>
</div>
		<?php }?>
		
			

		<?php 
		$str = lay_doitac('doi-tac');
		if($str){
			?>
			<div class="wap_doitac clearfix">
	<div class="doitac clearfix <?php if($source!='index'){ echo 'no_border_home';} ?>">
			<?php echo '<ul id="scroller">'.$str.'</ul>'; ?>
		</div>
		</div>
		<?php 

		}
		?>
		<?php /*<div class="marquee" id="mycrawler2">
			<?=lay_slider('doi-tac')?>
		</div>*/?>

<?php /*<script src="js/hiei.js"></script>
<script>
	marqueeInit({
		uniqueid: 'mycrawler2',
		style: {'width': '100% !important'},
		inc: 5,
		mouse: 'cursor driven',
		moveatleast:1,
		neutral: 150,
		savedirection: true,
		random: true
	});
	$(document).ready(function(){
		$(".marquee0 div div").css({'left':'0px !important'});
		setTimeout(function(){
			$(".marquee0 div div").css({'left':'0px'}); 
		}, 500);
	});
</script>*/?>
<div class="wr-support">
	<div class="main-support">
		
		<div class="col-support">
			<div class="title_duan">Dự án tiêu biểu</div>
			<div class="owl-duan owl-carousel owl-theme">
				<?php foreach ($rs_duan as $key => $value) { ?>
					<div class="box_duan">
						<div class="img_duan">
							<a href="du-an/<?=$value['tenkhongdau']?>-<?=$value['id']?>.html" title="<?=$value['ten']?>">
								<span><img src="thumb/200x173/1/<?=_upload_tintuc_l.$value['photo']?>" alt="<?=$value['ten']?>"/></span>
								
							</a>
						</div>
						<div class="info">
						<h3 class="name_duan"><a href="du-an/<?=$value['tenkhongdau']?>-<?=$value['id']?>.html" title="<?=$value['ten']?>"><?=$value['ten']?></a></h3>
						<div class="mota_duan catchuoi3"><?=$value['mota']?></div>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<div class="box-tag">
		<div class="main_content">
			<div class="title_duan">Tìm kiếm nhanh</div>
			<div style="padding-left:15px;padding-right:15px">
			<div class="wrap">
	<?php 
		foreach($d->query("select * from #_news_danhmuc where type='tag-seo' and hienthi > 0 order by stt asc,id desc") as $k=>$v){
		
			?>
			<div class="col">
				<div class='title'><?=$v['ten'.$lang]?></div>
				<ul class="col-item">
					<?php 
					foreach($d->result_array($d->query("select * from #_news where id_danhmuc = '".$v['id']."' and hienthi > 0 order by stt asc,id desc")) as $k2=>$v2){?>
					<li><a href="tim-kiem.html&keyword=<?=$v2['ten'.$lang]?>"> -  <?=$v2['ten'.$lang]?></a></li>
				<?php } ?>

				</ul>


			</div>
			<?php 
		
		}
	?>


</div>
</div>
</div>
</div>