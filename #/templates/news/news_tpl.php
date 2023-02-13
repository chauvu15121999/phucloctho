<div class="title-main"><span><?=(@$title_cat!='')?$title_cat:@$title_crumb?></span></div>
<div class="content-main custom-row row">
    <?php if(!empty($news)) { foreach($news as $k => $v) { ?>
        <div class="news col-12 col-sm-6 col-lg-4">
            <div class="news-frame">
                <a class="news-image scale-img" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
                    <img class="lazy w-100" onerror="this.src='<?=THUMBS?>/380x275x1/assets/images/noimage.png';" data-src="<?=THUMBS?>/380x275x1/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
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
    <?php } } else { ?>
        <div class="alert alert-warning w-100" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
    <div class="clear"></div>
    <div class="pagination-home"><?=(!empty($paging)) ? $paging : ''?></div>
</div>