<?php  
error_reporting(0);
include ("ajax_config.php");


if(!empty($_COOKIE['ds_sosanh'])){

    $str_id = str_replace('-', ',', $_COOKIE['ds_sosanh']);

    $where = "hienthi=1 and id IN ($str_id)";

    $all_product_ss = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,congsuat,baohanh,tiente FROM table_product where $where");


    
    $arr_ses_sp = implode(',', $_SESSION['sosanh']);
?>


<?php for($i=0;$i<count($all_product_ss);$i++){ 
        if(!empty($all_product_ss[$i]) && !in_array($all_product_ss[$i]['id'], explode(',', $arr_ses_sp))) { 
            $v = $all_product_ss[$i]; ?>
        <div class="r_pro_ss r_pro_ss_<?=$v['id']?>">
            <div class="col-l"><img src="thumb/200x200/2/<?=_upload_sanpham_l.$v['photo'];?>"></div>
            <div class="col-r">
                <p class="name_pro"><?=$v['ten']?></p>
                <p class="gia1"><?php if($v['gia']>0) echo number_format($v['gia'],0, ',', '.').' '.$currency;else echo _lienhe;?></p>
                <p class="gia2">
                    <i class="<?php if($v['giakm']>0)echo 'giacu'?>"><?php if($v['giakm']>0)echo number_format($v['giakm'],0, ',', '.');?></i> 
                    <?php if($v['giakm']>0){?>
                        <i class="giams">(Giảm: -<?=tinh_phantram($v['giakm'],$v['gia']);?>%)</i> 
                    <?php }?>
                </p>
                <p>Mã SP: <?=$v['masp']?></p>
                <p>Công suất: <?=$v['congsuat']?></p>
                <p>Bảo hành: <?=$v['baohanh']?></p>
                <div class="sel_sp_ss" data-idnew="<?=$v['id']?>" data-idold="0">Chọn sản phẩm</div>
            </div>
            <div class="clearfix"></div>
        </div>
<?php } } ?>


<?php }
die();
?>