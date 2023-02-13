
<div class="container">
<div class="<?=(empty($quickview)) ? 'destop-pro-detail' : 'quickview-pro-detail'?> w-clear">
    <div class="content-top-product">
    <div class="row">

        <div class="left-pro-detail col-md-6 col-lg-5 mb-4">
            <a id="<?=(empty($quickview)) ? 'Zoom-1' : 'Zoom-quickview'?>" class="MagicZoom" data-options="zoomMode: off; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?=WATERMARK?>/product/560x690x2/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/560x690x2/assets/images/noimage.png';" src="<?=WATERMARK?>/product/560x690x2/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
            <?php if($hinhanhsp) { if(count($hinhanhsp) > 0) { ?>
                <div class="gallery-thumb-pro">
                    <div class="owl-page owl-carousel owl-theme owl-pro-detail"
                        data-xsm-items = "4:10" 
                        data-sm-items = "5:10" 
                        data-md-items = "5:10" 
                        data-lg-items = "5:10" 
                        data-xlg-items = "5:10" 
                        data-nav = "1" 
                        data-navText = "<i class='fas fa-chevron-left'></i>:<i class='fas fa-chevron-right'></i>" 
                        data-navContainer = ".control-pro-detail">
                        <div>
                            <a class="thumb-pro-detail" data-zoom-id="<?=(empty($quickview)) ? 'Zoom-1' : 'Zoom-quickview'?>" href="<?=WATERMARK?>/product/560x690x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>">
                                <img onerror="this.src='<?=THUMBS?>/560x690x1/assets/images/noimage.png';" src="<?=WATERMARK?>/product/560x690x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                            </a>
                        </div>
                        <?php foreach($hinhanhsp as $v) { ?>
                            <div>
                                <a class="thumb-pro-detail" data-zoom-id="<?=(empty($quickview)) ? 'Zoom-1' : 'Zoom-quickview'?>" href="<?=WATERMARK?>/product/560x690x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" title="<?=$row_detail['ten'.$lang]?>">
                                    <img onerror="this.src='<?=THUMBS?>/560x690x1/assets/images/noimage.png';" src="<?=WATERMARK?>/product/560x690x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="control-pro-detail control-owl transition"></div>
                </div>
            <?php } } ?>
        </div>

        <div class="right-pro-detail col-md-6 col-lg-7 mb-4">
            <p class="title-pro-detail"><?=$row_detail['ten'.$lang]?></p>
            <?php if(empty($quickview)) { ?>
                <div class="social-plugin social-plugin-pro-detail w-clear">
                    <div class="addthis_inline_share_toolbox_qj48"></div>
                    <div class="zalo-share-button" data-href="<?=$func->getCurrentPageURL()?>" data-oaid="<?=($optsetting['oaidzalo']!='')?$optsetting['oaidzalo']:'579745863508352884'?>" data-layout="1" data-color="blue" data-customize=false></div>
                </div>
            <?php } ?>
            <?php if(!empty($row_detail['mota'.$lang])) { $product_summary = explode("\n", $row_detail['mota'.$lang]); ?>
                <div class="desc-pro-detail">
                   <?=decode($row_detail['mota'.$lang]);?>
                </div>
            <?php } ?>
         
            <ul class="attr-pro-detail">
                <?php if(!empty($row_detail['masp'])) { ?>
                    <li class="w-clear"> 
                        <label class="attr-label-pro-detail"><?=masp?>:</label>
                        <div class="attr-content-pro-detail"><?=$row_detail['masp']?></div>
                    </li>
                <?php } ?>
                <?php if(isset($pro_brand['id']) && $pro_brand['id'] > 0) { ?>
                <li class="w-clear">
                    <label class="attr-label-pro-detail"><?=thuonghieu?>:</label>
                    <div class="attr-content-pro-detail"><a class="text-decoration-none" href="<?=$pro_brand[$sluglang]?>" title="<?=$pro_brand['ten'.$lang]?>"><?=$pro_brand['ten'.$lang]?></a></div>
                </li>
            <?php } ?>
                <li class="w-clear">
                    <label class="attr-label-pro-detail"><?=gia?>:</label>
                    <div class="attr-content-pro-detail">
                        <?php if(!empty($row_detail_price['giamoi'])) { ?>
                            <div class="price-new-pro-detail"><?=$func->format_money($row_detail_price['giamoi'], 'vnđ', true)?></div>
                            <div class="price-old-pro-detail"><?=$func->format_money($row_detail_price['gia'], 'vnđ', true)?></div>
                            <div class="price-per-pro-detail"><?='-'.$row_detail_price['giakm'].'%'?></div>
                        <?php } else { ?>
                            <div class="price-new-pro-detail"><?=(!empty($row_detail_price['gia'])) ? $func->format_money($row_detail_price['gia'], 'vnđ', true) : lienhe?></div>
                            <div class="price-old-pro-detail d-none"></div>
                            <div class="price-per-pro-detail d-none"></div>
                        <?php } ?>
                    </div>
                </li>
                <?php if(!empty($mau)) { ?>
                    <li class="color-block-pro-detail w-clear">
                        <label class="attr-label-pro-detail d-block"><?=mausac?>: <strong class="text-uppercase text-info"><?=$row_detail['ten'.$lang]?></strong></label>
                        <div class="attr-content-pro-detail d-block">
                            <?php foreach($mau as $k => $v) { ?>
                                <?php if($v['loaihienthi']==1) { ?>
                                    <a class="color-pro-detail text-decoration-none" data-idpro="<?=$row_detail['id']?>" data-color-text="<?=$v['ten'.$lang]?>" data-product-name="<?=$row_detail['ten'.$lang]?>">
                                        <input style="background-image: url(<?=UPLOAD_COLOR_L.$v['photo']?>)" type="radio" value="<?=$v['id']?>" name="<?=(!empty($quickview)) ? 'quickview-' : ''?>color-pro-detail">
                                    </a>
                                <?php } else { ?>
                                    <a class="color-pro-detail text-decoration-none" data-idpro="<?=$row_detail['id']?>" data-color-text="<?=$v['ten'.$lang]?>" data-product-name="<?=$row_detail['ten'.$lang]?>">
                                        <input style="background-color: #<?=$v['mau']?>" type="radio" value="<?=$v['id']?>" name="<?=(!empty($quickview)) ? 'quickview-' : ''?>color-pro-detail">
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
                <?php if(!empty($size)) { ?>
                    <li class="size-block-pro-detail w-clear">
                        <label class="attr-label-pro-detail d-block"><?=kichthuoc?>: <?=(!empty($size)) ? '<strong class="text-uppercase text-info">'.$size[0]['ten'.$lang].'</strong>' : ''?></label>
                        <div class="attr-content-pro-detail d-block">
                            <?php foreach($size as $k => $v) {
                                $price_origin = 0;
                                $price_new = 0;
                                $price_promotion = 0;
                                if(!empty($prices[$v['id']]))
                                {
                                    $price_origin = $prices[$v['id']]['gia'];
                                    $price_new = $prices[$v['id']]['giamoi'];
                                    $price_promotion = $prices[$v['id']]['giakm'];
                                } ?>
                                <a class="size-pro-detail <?=($k == 0) ? 'active' : ''?> text-decoration-none" data-price-origin="<?=$price_origin?>" data-price-new="<?=$price_new?>" data-price-promotion="<?=$price_promotion?>" data-price-text="<?=$v['ten'.$lang]?>">
                                    <input type="radio" value="<?=$v['id']?>" name="<?=(!empty($quickview)) ? 'quickview-' : ''?>size-pro-detail" <?=($k == 0) ? 'checked' : ''?>>
                                    <?=$v['ten'.$lang]?>
                                </a>
                            <?php } ?>
                        </div> 
                    </li>
                <?php } ?>
                <li class="w-clear"> 
                    <label class="attr-label-pro-detail d-block"><?=soluong?>:</label>
                    <div class="attr-content-pro-detail d-block">
                        <div class="quantity-pro-detail">
                            <span class="quantity-minus-pro-detail">-</span>
                            <input type="number" class="qty-pro" min="1" value="1" readonly />
                            <span class="quantity-plus-pro-detail">+</span>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="cart-pro-detail">
                <a class="btn btn-dark addcart rounded-0 mr-2" data-id="<?=$row_detail['id']?>" data-action="addnow">
                    <i class="fas fa-shopping-bag mr-1"></i>
                    <span><?=addtobag?></span>
                </a>
                <a class="btn btn-dark addcart rounded-0 mr-2" data-id="<?=$row_detail['id']?>" data-action="buynow">
                    <i class="fas fa-shopping-bag mr-1"></i>
                    <span><?=buynow?></span>
                </a>
                <?php if(!empty($pro_list['noidung'.$lang]) && empty($quickview)) { ?>
                    <a class="btn btn-info rounded-0" data-toggle="modal" data-target="#popup-size-chart">
                        <span>Size chart</span>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>

    <?php if(empty($quickview)) { ?>
        <div class="tabs-pro-detail">
           
            <div class="tab-content p-2" id="tabsProDetailContent">
                <div class="btitle">Thông tin sản phẩm</div>
                    <?=htmlspecialchars_decode($row_detail['noidung'.$lang])?>
                
                    <div class="btitle">Bình luận</div>
               
                    <div class="fb-comments" data-href="<?=$func->getCurrentPageURL()?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div>
               
            </div>
        </div>
    <?php } ?>
</div>

<?php if(empty($quickview)) { ?>
    <div class="title-main"><span><?=sanphamcungloai?></span></div>
    <div class="content-main custom-row row">
        <?php if(!empty($product)) { foreach($product as $k => $v) { $product_price = $func->getPrice($v); ?>
            <div class="product col-sm-3 col-6">
                <div class="product-frame">
                    <div class="product-photo">
                        <a class="product-image scale-img" href="product/<?=$v[$sluglang]?>-<?=$v['id']?>.html" title="<?=$v['ten'.$lang]?>">
                            <img class="lazy w-100" onerror="this.src='<?=THUMBS?>/280x345x2/assets/images/noimage.png';" data-src="<?=WATERMARK?>/product/280x345x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                        </a>
                        <div class="product-view transition">
                            <a class="product-detail-view transition" href="product/<?=$v[$sluglang]?>-<?=$v['id']?>.html">
                                <i class="fas fa-search"></i>
                            </a>
                            <a class="product-quick-view transition" data-slug="product/<?=$v[$sluglang]?>-<?=$v['id']?>.html">
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
           
        <?php } ?>
        <div class="clear"></div>
       
    </div>
<?php } ?>
</div>