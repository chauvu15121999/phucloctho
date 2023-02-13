<div class="header">

	<div class="header-top">
		<div class="container">
		<div class="wrap-content d-flex justify-content-between align-items-center">
			<div class="header-slogan">
				Kết nối:
				<?php 
				if($model->get("setting.fanpage")){?>
				<a href="<?=$model->get("setting.fanpage")?>" target="_blank" rel="nofollow"><i class="icon-facebook"></i></a>
				<?php } ?>
				<?php 
				if($model->get("setting.youtube")){?>
				<a href="<?=$model->get("setting.youtube")?>" target="_blank" rel="nofollow"><i class="icon-youtube"></i></a>
				<?php } ?>
				<?php 
				if($model->get("setting.tw")){?>
				<a href="<?=$model->get("setting.tw")?>" target="_blank" rel="nofollow"><i class="icon-twitter"></i></a>
				<?php } ?>
				<?php 
				if($model->get("setting.ins")){?>
				<a href="<?=$model->get("setting.ins")?>" target="_blank" rel="nofollow"><i class="icon-instagram-1"></i></a>
				<?php } ?>
			</div>
			
			<div class="header-contact">
				<!-- <i class="icon-location"></i>
				<span><?=$optsetting['diachi']?></span>
				<i class="icon-mail-alt"></i>
				<span><?=$optsetting['email']?></span>-->
				<ul class="menu-topz">
					<li><a href="ho-tro-khach-hang.html">Hỗ trợ khách hàng</a></li>
					<li><a href="download.html">Download</a></li>
					<li><a href="tin-tuc.html">Tin tức</a></li>
					<li><a href="lien-he.html">Liên hệ</a></li>

				</ul>
			</div>
			
			


		</div>
		</div>
		</div>
	<div class="container">
	<div class="header-middle">
		<div class="wrap-content d-flex align-items-center justify-content-between">
			<a class="header-logo" href="">
				<img class="lazy" onerror="this.src='<?=THUMBS?>/270x0x2/assets/images/noimage.png';" data-src="<?=THUMBS?>/270x0x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>"/>
			</a>
			<div class="header-tool ">
				<div class="header-search w-clear">
					<form class="search-form" action="search.html" />
						<select name="catogory">
							<option value="">Danh mục</option>
							<?php
								foreach($product_list as $klist => $vlist) {
									echo '<option value="'.$vlist['id'].'">'.$vlist['ten'.$lang].'</option>';
								}

							?>
						</select>
	                	<input type="text" id="keyword" placeholder="<?=nhapsanphamcantim?> ..." />
	                	<button type="submit"><i class="icon-search"></i></button>
	            	</form>
	            </div>
	            <div class="header-link">
	            	<?php 
	            	foreach(getNews("link") as $k=>$v){
	            		echo '<a href="'.$v['link'].'">'.$v['ten'.$lang].'</a>';
	            	}
	            	?>
	            </div>
            </div>
            <div class="hotline-bar align-items-center d-flex">
            	
				<a class="header-hotline header-cart" href="cart">
					<i class="icon-cart"></i>
					
				</a>
			</div>
			
			
		</div>
	</div>
	</div>
</div>
<?php /*
<div class="header-bottom">
	    <ul class="wrap-content d-flex align-items-center justify-content-center">
	        <li class="transition"><a class="transition" href="" title="<?=trangchu?>"><?=trangchu?></a></h2></li>
	        <?php if(!empty($product_list)) { foreach($product_list as $klist => $vlist) { if(!empty($vlist['menu'])) { ?>
	            
	                <li class="transition"><a class="transition" title="<?=$vlist['ten'.$lang]?>" href="<?=$vlist[$sluglang]?>"><?=$vlist['ten'.$lang]?></a></h2>
	                <?php if(!empty($product_cat)) { ?>
	                    <ul>
	                        <?php foreach($product_cat as $kcat => $vcat) { if($vcat['id_list'] == $vlist['id']) { ?>
	                            <li>
	                                <li class="transition"><a class="transition" title="<?=$vcat['ten'.$lang]?>" href="<?=$vcat[$sluglang]?>"><?=$vcat['ten'.$lang]?></a>
	                                <?php if(!empty($product_item)) { ?>
	                                    <ul>
	                                        <?php foreach($product_item as $kitem => $vitem) { if($vitem['id_cat'] == $vcat['id']) { ?>
	                                            
	                                                <li class="transition"><a class="transition" title="<?=$vitem['ten'.$lang]?>" href="<?=$vitem[$sluglang]?>"><?=$vitem['ten'.$lang]?></a>
	                                                <?php if(!empty($product_sub)) { ?>
	                                                    <ul>
	                                                        <?php foreach($product_sub as $ksub => $vsub) { ?>
	                                                           
	                                                                <li class="transition"><a class="transition" title="<?=$vsub['ten'.$lang]?>" href="<?=$vsub[$sluglang]?>"><?=$vsub['ten'.$lang]?></a></li>
	                                                            
	                                                        <?php } ?>
	                                                    </ul>
	                                                <?php } ?>
													</li>
	                                        <?php } } ?>
	                                    </ul>
	                                <?php } ?>
	                            </li>
	                        <?php } } ?>
	                    </ul>
	                <?php } ?>
	            </li>
	        <?php } } } ?>
	        <li class="transition <?php if($com=='promotion') echo 'active'; ?>"><a class="transition" href="promotion" title="<?=khuyenmai?>"><?=khuyenmai?></a></li>
	        <li class="transition <?php if($com=='news') echo 'active'; ?>"><a class="transition" href="news" title="<?=tintuc?>"><?=tintuc?></a></li>
	        <li class="transition <?php if($com=='contact-us') echo 'active'; ?>"><a class="transition" href="contact-us" title="<?=lienhe?>"><?=lienhe?></a></li>
	    </ul>
	</div>*/?>