<div class="container p-0">
	<div class="box_topsp row">
		<div class="title_slick col-12">
			<span class="lf-title_slick">Sản phẩm thông dụng</span>
			<div class="change_slick">
				<span data-id="spmoi" class="check_acti">Sản phẩm mới</span>
				<span data-id="sale">Sản phẩm khuyến mãi</span>
				<span data-id="spbanchay">Sản phẩm bán chạy</span>
			</div>
		</div>
		<div class="load_slick_sp"></div>
	</div>
	<?php
		$d->reset();
		$sql_video = "select id,ten$lang as ten,link from #_video where hienthi=1 and type='video' and id_pro=0 order by stt,id desc";
		$d->query($sql_video);
		$video = $d->result_array();
		foreach ($cap1 as $l => $vc1) {
			$d->reset();
			$d->query("select id from #_product where hienthi=1 and type='san-pham' and id_danhmuc=".$vc1['id']." order by stt,id desc");
			$count_product = $d->num_rows();
			$count_more_product = (int)$count_product-9;
			$product = get_product_id('noibat','san-pham','id_danhmuc',$vc1['id'],9);
			if(count($product)>0){
	?>
			<div class="box-sanpham-tc col-12">
				<div class="tieude_tc"><?=$vc1['ten']?>
					<a href="<?=$vc1['type']?>/<?=$vc1['tenkhongdau']?>-<?=$vc1['id']?>">Xem thêm: <?=$count_more_product?> Sản phẩm</a>
				</div>
				<div class="wap_item">
					<?php foreach ($product as $k => $v) { ?>
						<?php include _template."layout/sanpham.php";?>
					<?php } ?>
				</div>
			</div>
	<?php } }?>
	<div class="dm-list clearfix col-12">
		<?php foreach ($cap2 as $k => $v) { ?>
			<a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>/" title="<?=$v['ten']?>"><?=$v['ten']?></a>
		<?php } ?>
	</div>
	<div class="map-video clearfix col-12">
		<div class="bando-footer"></div>
		<div class="video-left">
			<span class="chu_video">Video</span>
			<div class="video-aaaa"></div>
			<select id="clickvideo" onchange="change_v()">
				<?php for($i=0,$count_video=count($video);$i<$count_video;$i++){?>
					<option value="<?=getYoutubeIdFromUrl($video[$i]['link'])?>"><?=$video[$i]['ten']?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div>