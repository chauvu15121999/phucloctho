<div class="tieude_giua"><div><?=$title_cat?></div></div>
<div class="wap_item">
<?php foreach($tintuc as $k => $v) { ?>
    <div class="item">
        <p class="sp_img zoom_hinh"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>">
        <img src="thumb/250x200/1/<?=_upload_tintuc_l.$v['photo'];?>" alt="<?=$v['ten']?>" /></a></p>
        <h3 class="sp_name"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>" ><?=$v['ten']?></a></h3>
    </div><!---END .item-->
<?php } ?>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div><!---END .wap_item-->
