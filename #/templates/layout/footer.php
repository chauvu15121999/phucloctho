<div class="footer">
    <div class="container">
    <div class="footer-article">
        <div class="wrap-content">
            <div class="row justify-content-between">
                <div class="footer-news col-lg-5">
                    <h2 class="footer-name"><?=$footer['ten'.$lang]?></h2>
                    <div class="footer-info"><?=htmlspecialchars_decode($footer['noidung'.$lang])?></div>
                </div>
                <div class="footer-news col-3">
                    <h2 class="footer-title"><?=chinhsach?></h2>
                    <ul class="footer-ul">
                        <?php foreach($policy as $v) { ?>
                            <li><a class="transition" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="footer-news col-lg-4">
                    <h2 class="footer-title"><?=dangkynhantin?></h2>
                    <form class="form-row validation-newsletter" novalidate method="post" action="" enctype="multipart/form-data">
                        <div class="col-lg-9">
                            <div class="newsletter-input">
                                <input type="email" class="form-control" id="email-newsletter" name="dataNewsletter[email]" placeholder="<?= nhapemail?>" required />
                            </div>
                            <div class="newsletter-input">
                                <input type="number" class="form-control" id="dienthoai-newsletter" name="dataNewsletter[dienthoai]" placeholder="<?=nhapdienthoai?>" required />
                            </div>
                            <div class="newsletter-input">
                                <input type="text" class="form-control" id="ten-newsletter" name="dataNewsletter[ten]" placeholder="<?=nhaphoten?>" required />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="newsletter-button">
                                <input type="submit" class="btn btn-sm btn-danger w-100" name="submit-newsletter" value="<?=dangky?>" disabled>
                                <input type="hidden" class="btn btn-sm btn-danger w-100" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter">
                            </div>
                        </div>
                    </form>
                    <ul class="footer-social social">
                        <?php foreach($social2 as $k => $v) { ?>
                            <li>
                                <a href="<?=$v['link']?>" target="_blank">
                                    <img class="lazy" data-src="<?=THUMBS?>/40x40x2/<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="footer-powered">
        <div class="container">
            <div class="wrap-content">Copyright © 2021 <?=$model->get("setting.ten".$lang)?>.</div>
        </div>
    </div>
    <?php /*&$addons->setAddons('footer-map', 'footer-map', 10);*/?>
    <?=$addons->setAddons('messages-facebook', 'messages-facebook', 10);?>
</div>
<?php if($com!='gio-hang') { ?>
    <a class="cart-fixed text-decoration-none" href="cart" title="<?=giohang?>">
        <i class="fas fa-shopping-bag"></i>
        <span class="count-cart"><?=(!empty($_SESSION['cart'])) ? count($_SESSION['cart']) : 0?></span>
    </a>
<?php } ?>
<a class="btn-zalo btn-frame text-decoration-none" target="_blank" href="https://zalo.me/<?=preg_replace('/[^0-9]/','',$optsetting['zalo']);?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i><img class="lazy" data-src="assets/images/zl.png" alt="Zalo"></i>
</a>
<a class="btn-phone btn-frame text-decoration-none" href="tel:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i><img class="lazy" data-src="assets/images/hl.png" alt="Hotline"></i>
</a>