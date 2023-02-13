<div class="title-main"><span><?=@$title_crumb?></span></div>
<div class="content-main form-row">
    <?php if(!empty($video)) { foreach($video as $k => $v) { ?>
        <div class="video col-6 col-md-4 col-lg-3 col-xl-3" data-fancybox="video" data-src="<?=$v['link_video']?>">
            <div class="video-image scale-img">
                <img class="lazy w-100" onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" data-src="https://img.youtube.com/vi/<?=$func->getYoutube($v['link_video'])?>/0.jpg" alt="<?=$v['ten'.$lang]?>"/>
            </div>
            <h3 class="video-name text-split"><?=$v['ten'.$lang]?></h3>
        </div>
    <?php } } else { ?>
        <div class="alert alert-warning" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
    <div class="clear"></div>
    <div class="pagination-home"><?=(!empty($paging)) ? $paging : ''?></div>
</div>