<?php if(count($slider)) { ?>
    <div class="slideshow">
        <div class="slideshow-inner">
            <div class="owl-page owl-carousel owl-theme"
                data-xsm-items = "1:0" 
                data-sm-items = "1:0" 
                data-md-items = "1:0" 
                data-lg-items = "1:0" 
                data-xlg-items = "1:0" 
                data-rewind = "1" 
                data-autoplay = "1" 
                data-loop = "0" 
                data-lazyLoad = "0" 
                data-mouseDrag = "0" 
                data-touchDrag = "0" 
                data-smartSpeed = "800" 
                data-autoplaySpeed = "800" 
                data-autoplayTimeout = "3500" 
                data-dots = "0" 
                data-animateIn = "animate__animated animate__fadeInLeft" 
                data-animateOut = "animate__animated animate__fadeOutRight" 
                data-nav = "1" 
                data-navText = "<i class='fas fa-chevron-left'></i>:<i class='fas fa-chevron-right'></i>" 
                data-navContainer = ".control-slideshow">
                <?php foreach($slider as $v) { ?>
                    <div>
                        <a class="slideshow-item" href="<?=$v['link']?>" target="_blank" title="<?=$v['ten'.$lang]?>">
                            <img class="lazy w-100" onerror="this.src='<?=THUMBS?>/1366x440x2/assets/images/noimage.png';" data-src="<?=THUMBS?>/1366x440x1/<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>" title="<?=$v['ten'.$lang]?>"/>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="control-slideshow control-owl transition"></div>
        </div>
    </div>
<?php } ?>