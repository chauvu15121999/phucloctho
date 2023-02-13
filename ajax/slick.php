<?php 

include ("ajax_config.php");

$id= $_POST['id'];
$d->reset();
$sql_product = "select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,sao,luot,tiente from #_product where hienthi=1 and type='san-pham' and ".$id.">0 order by stt,id desc";
$d->query($sql_product);
$product = $d->result_array();
?>


<div class="slick-<?=$id?>">
	<?php foreach ($product as $k => $v) {
		
	if($v['tiente']==2){
		$currency='usd';
	}else{
		$currency='vnđ';
	}	
	?>
		<div>
			<div class="item-slick clearfix eff-btn-ac">
				<div class="sp_img zoom_hinh">
					<a data-id="<?=$v['id']?>" href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html">
						<img class="lazy"  data-src="thumb/240x220/2/<?php if($v['photo']!=NULL) echo _upload_sanpham_l.$v['photo']; else echo 'images/noimage.png';?>" alt="<?=$v['ten']?>" />
					</a>
				</div>
				<div class="thongtin-sp">
					<h3 class="sp_name"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>" ><?=$v['ten']?></a></h3>
					<p class="sp_gia">
						<span class="gia"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' '.$currency;else echo _lienhe;?></span>
					</p>
					<div class="rattings">
						<a class="rating_icon <?php if($v["sao"] > 0) echo 'active';?>" data-id="1" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
						<a class="rating_icon <?php if($v["sao"] >= 1.5) echo 'active';?>" data-id="2" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
						<a class="rating_icon <?php if($v["sao"] >= 2.5) echo 'active';?>" data-id="3" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
						<a class="rating_icon <?php if($v["sao"] >= 3.5) echo 'active';?>" data-id="4" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
						<a class="rating_icon <?php if($v["sao"] >= 4.5) echo 'active';?>" data-id="5" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
						<?php if($v['luot']>0) {?><span>(<?=$v['luot']?> đánh giá)</span><?php }?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>