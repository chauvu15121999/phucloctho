<div class="title-main"><span><?=$title_crumb?></span></div>
<div class="content-main form-row">
    <?php if(!empty($product)) { foreach($product as $k => $v) { ?>
        <div class="album col-6 col-md-4 col-lg-3 col-xl-3">
            <a class="album-image scale-img" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
                <img class="lazy w-100" onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" data-src="<?=THUMBS?>/480x360x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>"/>
            </a>
            <h3 class="album-name"><a href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></a></h3>
        </div>
    <?php } } else { ?>
        <div class="alert alert-warning w-100" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
    <div class="clear"></div>
    <div class="pagination-home"><?=(!empty($paging)) ? $paging : ''?></div>
</div>