<div class="box-slider clearfix">
    <div class="wap_l">
        <div class="tieude_giua"><div><?=$title_cat?></div></div>
<div class="box_container">
    <div class="content">
        <div id="popupimage">
        <?=$row_detail['noidung']?>
        </div>     
        <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_facebook_share" fb:share:layout="button_count"></a>
            <a class="addthis_button_tweet" style="margin-right: 15px;"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            <a class="addthis_counter addthis_pill_style"></a>
        </div>
        <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-width="100%"></div>
    </div><!--.content-->
</div><!--.box_container-->
    </div><!--.content-->

    <div class="wap_r">
        <?php include _template."layout/left.php";?>
    </div>
</div>