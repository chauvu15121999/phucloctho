<div class="container p-0">
	<?php if($source=='index'){
		$d->reset();
		$sql_slider = "select ten$lang as ten,link,photo,mota$lang as mota from #_slider where hienthi=1 and type='slider' order by stt,id desc";
		$d->query($sql_slider);
		$slider=$d->result_array();
	?>
		<div class="slider box-slider row">
			<div class="col-md-8 col-12 p-0">
				<div class="slider-slick">
					<?php for($i=0,$count_slider=count($slider);$i<$count_slider;$i++){ ?>
						<div>
							<a href="<?=$slider[$i]['link']?>">
								<img src="thumb/830x308/1/<?php if($slider[$i]['photo']!='')echo _upload_hinhanh_l.$slider[$i]['photo'];else echo 'images/noimage.png' ?>" alt="slider"/>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-4 col-12 mt-md-0 mt-3">
				<a href="<?=layhinh('link','qc1')?>" class="quangcao" target="_blank"><img class="pb-3" src="thumb/435x147/1/<?=layhinh('photo','qc1')?>" alt="Banner" /></a>
				<a href="<?=layhinh('link','qc3')?>" class="quangcao" target="_blank"><img class="pt-3" src="thumb/435x147/1/<?=layhinh('photo','qc3')?>" alt="Banner" /></a>
			</div>
		</div>
	<?php } else{
		if($com!="gio-hang" && $template!="product_detail"){
			$d->reset();
			$sql_slider = "select ten$lang as ten,link,photo,mota$lang as mota from #_slider where hienthi=1 and type='slider1' order by stt,id desc";
			$d->query($sql_slider);
			$slider=$d->result_array();
	?>	
		<div class="slider box-slider row">
			<div class="col-md-8 col-12 p-0">
				<div class="slider-slick">
					<?php for($i=0,$count_slider=count($slider);$i<$count_slider;$i++){ ?>
						<div>
							<a href="<?=$slider[$i]['link']?>">
								<img src="thumb/830x308/1/<?php if($slider[$i]['photo']!='')echo _upload_hinhanh_l.$slider[$i]['photo'];else echo 'images/noimage.png' ?>" alt="slider"/>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-4 col-12 mt-md-0 mt-3">
				<a href="<?=layhinh('link','qc4')?>" class="quangcao" target="_blank"><img class="pb-2" src="thumb/435x147/1/<?=layhinh('photo','qc4')?>" alt="Banner" /></a>
				<a href="<?=layhinh('link','qc5')?>" class="quangcao" target="_blank"><img class="pt-3" src="thumb/435x147/1/<?=layhinh('photo','qc5')?>" alt="Banner" /></a>
			</div>
		</div>
	<?php } }?>
</div>

