<?php if(!empty($product_new)) { ?>
	<div class="wrap-product-new section-page">
		<div class="wrap-content container">
			<div class="title-main">
				<span><?=newproduct?></span>
				<strong><?=$slogan_product['ten'.$lang]?></strong>
			</div>
			<div class="block-product-new">
				<div class="owl-page owl-carousel owl-theme"
					data-xsm-items = "2:10" 
		            data-sm-items = "2:10" 
		            data-md-items = "3:10" 
		            data-lg-items = "4:10" 
		            data-xlg-items = "5:20" 
		            data-rewind = "1" 
		            data-autoplay = "1" 
		            data-loop = "0" 
		            data-lazyLoad = "0" 
		            data-mouseDrag = "1" 
		            data-touchDrag = "1" 
		            data-smartSpeed = "700" 
		            data-autoplaySpeed = "700"
		            data-autoplaySpeed = "4500"
					data-dots = "0" 
					data-nav = "1" 
					data-navText = "<i class='fas fa-chevron-left'></i>:<i class='fas fa-chevron-right'></i>" 
					data-navContainer = ".control-product-new">
					<?php foreach($product_new as $v) { $product_price = $func->getPrice($v); ?>
						<div>
							<div class="product-frame">
								<div class="product-photo">
									<a class="product-image scale-img" href="product/<?=$v[$sluglang]?>-<?=$v['id']?>.html" title="<?=$v['ten'.$lang]?>">
										<img class="lazy w-100" onerror="this.src='<?=THUMBS?>/280x345x1/assets/images/noimage.png';" data-src="<?=WATERMARK?>/product/280x345x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
									</a>
									<div class="product-view transition">
										<a class="product-detail-view transition" href="<?=$v[$sluglang]?>">
											<i class="fas fa-search"></i>
										</a>
										<a class="product-quick-view transition" data-slug="<?=$v[$sluglang]?>">
											<i class="far fa-eye"></i>
										</a>
									</div>
								</div>
								<h3 class="product-name">
									<a class="text-split transition" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></a>
								</h3>
								<div class="product-price">
									<?php if(!empty($product_price['giamoi'])) { ?>
										<span id="new"><?=$func->format_money($product_price['giamoi'])?></span>
										<span id="old"><?=$func->format_money($product_price['gia'])?></span>
										<span id="per"><b><?='-'.$product_price['giakm'].'%'?></b></span>
									<?php } else { ?>
										<span id="new"><?=(!empty($product_price['gia'])) ? $func->format_money($product_price['gia']) : lienhe?></span>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="control-product-new control-owl transition"></div>
			</div>
		</div>
	</div>
<?php } ?>

<?php if(!$func->isGoogleSpeed()) { if(!empty($product_list)) { foreach($product_list as $klist => $vlist) { if(!empty($vlist['noibat'])) {

	 $product_highlight = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, id_mau, id_size, photo, id_list from #_product where id_list = ? and type = ? and noibat > 0 and hienthi > 0 order by stt,id desc limit 10",array($vlist['id'],'san-pham'));
	 if(count($product_highlight)){

 ?>
	<div class="">
		<div class="wrap-content container">
			<div class="title-main d-flex justify-content-between align-items-center">
				<span><?=$vlist['ten'.$lang]?></span>
				<a class="product-list-view transition" href="<?=$vlist[$sluglang]?>" title="<?=xemthem?>"><i class="icon-right-open-mini"></i><?=xemthem?></a>
			</div>
			<div class="row">
				
				<div class="product-list-info col-lg-12 <?=($klist % 2 == 0) ? 'order-2' : 'order-1'?>">
					
					<div class="row row-5">
					
							<?php $limit_product = 0; $block_product = 0; ?>
							<?php foreach($product_highlight as $k => $v) { ?>
								<?php if(($v['id_list'] == $vlist['id']) && $limit_product < 10) {
									$limit_product++;
									$block_product++;
									$product_price = $func->getPrice($v);
									unset($product_highlight[$k]); ?>
									<div class="product col-6 col-sm-4 col-lg-3">
									<div class=" product-frame">
										<div class="product-photo">
											<a class="product-image scale-img" href="product/<?=$v[$sluglang]?>-<?=$v['id']?>.html" title="<?=$v['ten'.$lang]?>">
												<img class="lazy w-100" onerror="this.src='<?=THUMBS?>/280x345x2/assets/images/noimage.png';" data-src="<?=WATERMARK?>/product/280x345x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
											</a>
											<div class="product-view transition">
												<a class="product-detail-view transition" href="<?=$v[$sluglang]?>">
													<i class="fas fa-search"></i>
												</a>
												<a class="product-quick-view transition" data-slug="<?=$v[$sluglang]?>">
													<i class="far fa-eye"></i>
												</a>
											</div>
										</div>
										<h3 class="product-name">
											<a class="text-split transition" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></a>
										</h3>
										<div class="product-price">
											<?php if(!empty($product_price['giamoi'])) { ?>
												<span id="new"><?=$func->format_money($product_price['giamoi'])?></span>
												<span id="old"><?=$func->format_money($product_price['gia'])?></span>
												<span id="per"><b><?='-'.$product_price['giakm'].'%'?></b></span>
											<?php } else { ?>
												<span id="new"><?=(!empty($product_price['gia'])) ? $func->format_money($product_price['gia']) : lienhe?></span>
											<?php } ?>
										</div>
									</div>
									</div>
								<?php } ?>
								
							<?php } ?>
						
					</div>
				</div>
			</div>
			
		</div>
	</div>
<?php } } } } ?>

<?php if(!empty($news_home)) { ?>
	<div class="wrap-news section-page">
		<div class="wrap-content container">
			<div class="title-main">
				<span>Tin tức</span>
				<strong><?=$slogan_news['ten'.$lang]?></strong>
			</div>
			<div class="owl-page owl-carousel owl-theme"
				data-xsm-items = "1:0" 
	            data-sm-items = "2:10" 
	            data-md-items = "3:15" 
	            data-lg-items = "3:15" 
	            data-xlg-items = "3:30" 
	            data-rewind = "1" 
	            data-autoplay = "1" 
	            data-loop = "0" 
	            data-lazyLoad = "0" 
	            data-mouseDrag = "1" 
	            data-touchDrag = "1" 
	            data-smartSpeed = "700" 
	            data-autoplaySpeed = "700"
	            data-autoplaySpeed = "4500">
				<?php foreach($news_home as $v) { ?>
					<div>
						<div class="news-frame">
							<a class="news-image scale-img" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
								<img class="lazy w-100" onerror="this.src='<?=THUMBS?>/380x275x1/assets/images/noimage.png';" data-src="<?=THUMBS?>/380x275x2/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
							</a>
							<h3 class="news-name">
								<a class="text-split transition" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></a>
							</h3>
							<div class="news-time">
								<strong>Ngày đăng</strong>
								<span>// <?=date("d/m/Y",$v['ngaytao'])?></span>
							</div>
							<div class="news-desc text-split"><?=$v['mota'.$lang]?></div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
 
<div class="wrap-intro section-page">
	<div class="wrap-content container">
		<div class="row">
			<div class="intro-left col-lg-7">
				<div class="title-main text-left">
					<span>Video clips</span>
					<strong><?=$slogan_video['ten'.$lang]?></strong>
				</div>
				<?=$addons->setAddons('video-intro', 'video-srcoll', 10);?>
			</div>
			<div class="intro-right col-lg-5 overflow-hidden">
				<div class="title-main text-left">
					<span>Fanpage facebook</span>
					<strong><?=$slogan_fanpage['ten'.$lang]?></strong>
				</div>
				<?=$addons->setAddons('fanpage-intro', 'fanpage-facebook', 10);?>
			</div>
		</div>
	</div>
</div>

<?php if(!empty($partner)) { ?>
	<div class="wrap-partner section-page">
		<div class="wrap-content container">
			<div class="row align-items-center">
				<div class="partner-left col-lg-3">
					<img class="lazy" onerror="this.src='<?=THUMBS?>/170x130x1/assets/images/noimage.png';" data-src="<?=THUMBS?>/170x130x2/<?=UPLOAD_PHOTO_L.$icon['photo']?>"/>
				</div>
				<div class="partner-right col-lg-9">
					<div class="owl-page owl-carousel owl-theme"
						data-xsm-items = "2:10" 
			            data-sm-items = "3:10" 
			            data-md-items = "4:10" 
			            data-lg-items = "4:10" 
			            data-xlg-items = "4:10" 
			            data-rewind = "1" 
			            data-autoplay = "1" 
			            data-loop = "0" 
			            data-lazyLoad = "0" 
			            data-mouseDrag = "1" 
			            data-touchDrag = "1" 
			            data-smartSpeed = "700" 
			            data-autoplaySpeed = "700"
			            data-autoplaySpeed = "4500">
						<div>
							<?php foreach($partner as $k => $v) { ?>
								<a class="partner" href="<?=$v['link']?>" target="_blank" title="<?=$v['ten'.$lang]?>">
									<img class="lazy w-100" onerror="this.src='<?=THUMBS?>/190x85x1/assets/images/noimage.png';" data-src="<?=THUMBS?>/190x85x2/<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>"/>
								</a>
								<?php if((($k+1)%2==0) && ($k+1)<count($partner)) { ?></div><div><?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } } ?>