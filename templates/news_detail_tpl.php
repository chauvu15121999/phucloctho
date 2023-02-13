<?php
	$d->reset();
	$sql="select ten$lang as ten,tenkhongdau,id,type,photo from #_product_thuonghieu where hienthi=1 and type='san-pham' order by stt,id desc";
	$d->query($sql);
	$product_br=$d->result_array();

	if($_GET['result']!=''){
		$d->reset();
		$sql="select ten$lang as ten from #_product_thuonghieu where hienthi=1 and type='san-pham' and id=".(int)$_GET['result']." order by stt,id desc";
		$d->query($sql);
		$detail_br=$d->fetch_array();
	}
?>
<div class="box-slider clearfix content">
    <div class="wap_l">
	
	
<div class="tieude_giua"><div><?=$title_cat?></div></div>
<div class="box_container">
     <div class="ngaytao1"><b><?=$row_detail['tacgia']?> - </b> Đăng lúc: <?=date('H:s d/m/Y',$row_detail['ngaytao'])?><span><?=_luotxem?>: <?=$row_detail['luotxem']?></span></div>
    <div class="content">
        
        <div id="popupimage">

           

            <?=$row_detail['noidung']?>
        </div>

        <?php if(!empty($tags_sp)) { ?>
            <div class="tukhoa">
                <div id="tags">
                    <span>Tags:</span>
                    <?php foreach($tags_sp as $k=>$tags_sp_item) { ?>
                       <a href="tag/<?=changeTitle($tags_sp_item['ten'])?>/<?=$tags_sp_item['id']?>" title="<?=$tags_sp_item['ten']?>"><?=$tags_sp_item['ten']?></a>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
        <?php } ?>
        <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_facebook_share" fb:share:layout="button_count"></a>
            <a class="addthis_button_tweet" style="margin-right: 15px;"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            <a class="addthis_counter addthis_pill_style"></a>
        </div>

        <div id="tabs1">
			<div id="content_tabs">
				<div class="tab">
                    <?php include _template."layout/hoidap.php";?>
                </div>
            </div><!---END #content_tabs-->
       </div><!---END #tabs-->
         

        <?php if(count($tintuc) > 0) { ?>
        <div class="othernews">
             <div class="cactinkhac"><?=$title_other?></div>
             <ul class="khac">
                <?php foreach($tintuc as $k => $v) { ?>
                    <li><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>"><i class="far fa-hand-point-right"></i><?=$v['ten']?></a> (<?=make_date($v['ngaytao'])?>)</li>
                <?php }?>
             </ul>
             <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
        </div><!--.othernews-->
        <?php }?>
    </div><!--.content-->
</div><!--.box_container-->

</div>
    <div class="wap_r">
        <?php include _template."layout/left.php";?>
    </div>
</div>

<style type="text/css">
	.addthis_button_facebook_like{
		float: left !important;
    width: 90px !important;
    margin-left: -10px;
    margin-right: 0px;
	}
</style>