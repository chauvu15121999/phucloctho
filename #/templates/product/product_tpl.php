<div class="container">
<div class="title-main"><span><?=(@$title_cat!='')?$title_cat:@$title_crumb?></span></div>
<div class="content-main custom-row row">
    <?php if(!empty($product)) { foreach($product as $k => $v) { $product_price = $func->getPrice($v); ?>
        <div class="product col-6 col-sm-4 col-lg-3">
            <div class="product-frame">
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
                    <a class="text-split transition" href="product/<?=$v[$sluglang]?>-<?=$v['id']?>.html" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></a>
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
    <?php } } else { ?>
        <div class="alert alert-warning w-100" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
    <div class="clear"></div>
    <div class="pagination-home"><?=(!empty($paging)) ? $paging : ''?></div>
</div>
</div>