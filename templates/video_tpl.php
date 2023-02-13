<div class="tieude_giua"><div><?=$title_cat?></div></div>
<div class="link_seo"><span><?=$linkseo?></span></div>
<div class="wap_item">
    <?php foreach($product as $k => $v) { ?>
        <div class="item">
             <p class="sp_img zoom_hinh hover_sang3"><a data-fancybox='video' href="<?=$v['link']?>" title="<?=$v['ten']?>">
            <img src="http://img.youtube.com/vi/<?=getYoutubeIdFromUrl($v['link'])?>/0.jpg" alt="<?=$v['ten']?>" /></a></p>
            <h3 class="sp_name"><a data-fancybox href="<?=$v['link']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
        </div><!---END .item-->
    <?php } ?>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div><!---END .wap_item-->
