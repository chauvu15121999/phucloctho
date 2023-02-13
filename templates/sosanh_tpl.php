<div class="tieude_giua"><div><?=$title_cat?></div><span></span></div>
<div class="box_container">
   <div class="content">
        <div class="control_ss">
            <div class="left_ss"><i class="fas fa-angle-left"></i></div>
            <div class="right_ss"><i class="fas fa-angle-right"></i></div>
        </div>
        <div class="table-resp" id="show_table_ss">
            <table class="table table-bordered table-striped tbl_sosanh" border="0">
                <tbody>
                    
                    <tr>
                        <td class="col-ss-1">Sản phẩm</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { 
                            if($k==3) break;
                        ?>
                            <td class="col-ss-<?=$k+1?>"><a href="san-pham/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" target="_blank"><?=$v['ten']?></a></td>
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1">Ảnh</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { 
                        ?>
                            <td class="col-ss-<?=$k+1?> td_img_sosanh">
                                <div class="doi_sp_ss" data-id="<?=$v['id']?>" data-col="<?=$k+1?>"><i class="fas fa-sync-alt"></i></div>
                                <img src="thumb/199x199/2/<?=_upload_sanpham_l.$v['photo'];?>">
                            </td>
                            
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1">Giá</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) {
                            if($v['tiente']==2){
                                $currency='usd';
                            }else{
                                $currency='vnđ';
                            }   
                        ?>
                            <td class="col-ss-<?=$k+1?> td_img_sosanh">
                                <span class="gia1"><?php if($v['gia']>0) echo number_format($v['gia'],0, ',', '.').' '.$currency;else echo _lienhe;?></span>
                                <span class="gia2">
                                    <i class="<?php if($v['giakm']>0)echo 'giacu'?>"><?php if($v['giakm']>0)echo number_format($v['giakm'],0, ',', '.');?></i> 
                                    <?php if($v['giakm']>0){?>
                                        <i class="giams">(Giảm: -<?=tinh_phantram($v['giakm'],$v['gia']);?>%)</i> 
                                    <?php }?>
                                </span>
                            </td>
                            
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1">Mã sản phẩm</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { ?>
                            <td class="col-ss-<?=$k+1?>"><?=$v['masp']?></td>
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1">Công suất</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { ?>
                            <td class="col-ss-<?=$k+1?>"><?=$v['congsuat']?></td>
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1">Bảo hành</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { ?>
                            <td class="col-ss-<?=$k+1?>"><?=$v['baohanh']?></td>
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1">Mô tả</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { ?>
                            <td class="col-ss-<?=$k+1?>"><?=$v['mota']?></td>
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1">Vận chuyển</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { ?>
                            <td class="col-ss-<?=$k+1?>">GIAO HÀNG TRÊN 63 TỈNH THÀNH</td>
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1">Tình trạng</td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { ?>
                            <td class="col-ss-<?=$k+1?> txt_tinhtrang"><?=$v['tinhtrang']?></td>
                        <?php $k++; } } ?>
                    </tr>

                    <tr>
                        <td class="col-ss-1"></td>
                        <?php 
                        if(!empty($product_ss)) { $k=1;
                        foreach ($product_ss as $v) { ?>
                            <td class="col-ss-<?=$k+1?>">
                                <a class="add_cart" data-id="<?=$v['id']?>">Mua hàng</a>
                            </td>
                        <?php $k++; } } ?>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php 
$arr_ses_sp = implode(',', $_SESSION['sosanh']);
if(count($all_product_ss)>2){ ?>
    <div id="pop_ds_pro">
        <div class="overlay"></div>
        <div class="box_dssp">
            <div class="title">DANH SÁCH SẢN PHẢM SO SÁNH <div class="close_pop"><i class="fas fa-times-circle"></i></div></div>
            <div class="content_dssp">
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
            </div>
        </div>
    </div>
<?php } ?>