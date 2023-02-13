<?php
if($v['tiente']==2){
	$currency='usd';
}else{
	$currency='vnđ';
}	
?>

<div class="item clearfix eff-btn-ac">
	<span class="masp"><?=$v['masp']?></span>
	<div class="sp_img zoom_hinh">
		<a data-id="<?=$v['id']?>" <?php if($deviceType=='computer') {?>  <?php }?> href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html">
			<img class="lazy" src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=" data-src="thumb/400x400/2/<?php if($v['photo']!=NULL) echo _upload_sanpham_l.$v['photo']; else echo 'images/noimage.png';?>" alt="<?=$v['ten']?>" />
		</a>
		<!--<div class="btn_sp">
			<div class="btn_ac add_cart" data-id="<?=$v['id']?>"><i class="fas fa-shopping-cart"></i></div>
			<div class="btn_ac add_quantam" data-id="<?=$v['id']?>"><i class="fas fa-heart"></i></div>
			<div class="btn_ac add_sosanh" data-id="<?=$v['id']?>"><i class="fas fa-sync-alt"></i></div>
		</div>-->
	</div>
	<div class="thongtin-sp">
		<h3 class="sp_name"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>" ><?=$v['ten']?></a></h3>
		<p class="sp_gia">
			
			<span class="giakm ads"><?php if($v['gia']>0) echo number_format($v['gia'],0, ',', '.').' '.$currency;else echo _lienhe;?></span>

			<span class="gia">
				<i class="<?php if($v['giakm']>0)echo 'giacu'?>"><?php if($v['giakm']>0)echo number_format($v['giakm'],0, ',', '.');?></i> 
				<?php if($v['giakm']>0){?>
					<i class="giams">(Giảm: -<?=tinh_phantram($v['giakm'],$v['gia']);?>%)</i> 
				<?php }?>
				</span>
		</p>
		
		<!--<div class="btn_sp_mb">
			<div class="btn_ac add_cart" data-id="<?=$v['id']?>"><i class="fas fa-shopping-cart"></i></div>
			<div class="btn_ac add_quantam" data-id="<?=$v['id']?>"><i class="fas fa-heart"></i></div>
			<div class="btn_ac add_sosanh" data-id="<?=$v['id']?>"><i class="fas fa-sync-alt"></i></div>
		</div>-->
	</div>
</div>