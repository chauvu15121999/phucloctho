<div class="title-main"><span><?=$row_detail['ten'.$lang]?></span></div>
<div class="content-main album-gallery form-row w-clear">
    <?php if(!empty($hinhanhsp)) { foreach($hinhanhsp as $k => $v) { ?>
        <div class="album col-6 col-md-4 col-lg-3 col-xl-3">
            <a class="album-image scale-img mb-0" rel="album-<?=$row_detail['id']?>" href="<?=UPLOAD_PRODUCT_L.$v['photo']?>" title="<?=$row_detail['ten'.$lang]?>">
            	<img class="lazy w-100" onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" data-src="<?=THUMBS?>/480x360x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"/>
            </a>
        </div>
    <?php } } else { ?>
        <div class="alert alert-warning" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
</div>