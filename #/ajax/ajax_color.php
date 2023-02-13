<?php
    include "ajax_config.php";
    
    $id_mau = (!empty($_POST['id_mau'])) ? htmlspecialchars($_POST['id_mau']) : 0;
    $idpro = (!empty($_POST['idpro'])) ? htmlspecialchars($_POST['idpro']) : 0;
    $hinhanhsp = $d->rawQuery("select photo, id_photo, id from #_gallery where id_mau = ? and id_photo = ? and com = ? and type = ? and kind = ? and val = ?",array($id_mau,$idpro,'product','san-pham','man','san-pham'));
    $row_detail = $d->rawQueryOne("select ten$lang, photo from #_product where id = ? and type = ? limit 0,1",array($idpro,'san-pham'));
?>
<?php if(!empty($hinhanhsp)) { ?>
    <a id="Zoom-<?=$idpro?>" class="MagicZoom" data-options="zoomMode: off; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?=WATERMARK?>/product/560x690x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[0]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img class="lazy" onerror="this.src='<?=THUMBS?>/560x690x1/assets/images/noimage.png';" data-src="<?=WATERMARK?>/product/560x690x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[0]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
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
            <?php foreach($hinhanhsp as $v) { ?>
                <a class="thumb-pro-detail" data-zoom-id="Zoom-<?=$idpro?>" href="<?=WATERMARK?>/product/560x690x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" title="<?=$row_detail['ten'.$lang]?>">
                    <img class="lazy" onerror="this.src='<?=THUMBS?>/560x690x1/assets/images/noimage.png';" data-src="<?=WATERMARK?>/product/560x690x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                </a>
            <?php } ?>
        </div>
        <div class="control-pro-detail control-owl transition"></div>
    </div>
<?php } ?>