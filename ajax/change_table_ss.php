<?php  
error_reporting(0);
session_start();
include ("ajax_config.php");

$id_new = (int) $_POST['id_new'];
$id_old = (int) $_POST['id_old'];

if(!empty($_SESSION['sosanh'])){
	foreach($_SESSION['sosanh'] as $k=>$v){
		if($id_old==$v){
			$_SESSION['sosanh'][$k] = $id_new;
		}
	}
}
$str_id_dang_ss = implode(',', $_SESSION['sosanh']);

$product_ss = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,congsuat,baohanh,tiente,tinhtrang,mota FROM table_product where hienthi=1 and id IN ($str_id_dang_ss)");?>


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





<?php die();
?>