<?php
if($v['tiente']==2){
	$currency='usd';
}else{
	$currency='vnđ';
}	
?>

<div class="item clearfix">
	<span class="masp"><?=$v['masp']?></span>
	<p class="sp_img zoom_hinh">
		<a data-id="<?=$v['id']?>" <?php if($deviceType=='computer') {?> onmouseover="AJAXShowToolTip('tolltip.php?id=<?=$v['id']?>'); return false;" onmouseout="AJAXHideTooltip();" <?php }?> href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html">
			<img class="lazy" data-src="thumb/175x175/2/<?php if($v['photo']!=NULL) echo _upload_sanpham_l.$v['photo']; else echo 'images/noimage.png';?>" alt="<?=$v['ten']?>" />
		</a>
	</p>
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
		<div class="des_sp">Công suất: <?=$v['congsuat']?></div>
		<div class="des_sp">Bảo hành: <?=$v['baohanh']?></div>
		<span class="hinhk"><img class="lazy" data-src="images/free-ship.png" alt="free ship"></span>
	</div>
</div>