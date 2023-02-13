<div class="tieude_giua"><div><?=$title_cat?></div><span></span></div>
<div class="box_container">
   <div class="content">
        <link rel="stylesheet" type="text/css" href="footable/css/footable.standalone.css">
        <script type="text/javascript" src="footable/js/footable.min.js"></script>
        <script type="text/javascript">
            $().ready(function(){
                $('#table_order').footable();
            })
        </script>
        <table class="table table-bordered table-striped tbl_quantam" id="table_order">
            <thead>
                <tr>
                    <th width="199" align="center" class="td_img">Hình Ảnh</th>
                    <th data-breakpoints="xs" width="40%" align="center">Sản phẩm</th>
                    <th width="30%" align="center">Giá bán</th>
                    <th width="70" align="center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($product)){
                foreach ($product as $v) { 
                    if($v['tiente']==2){
                        $currency='usd';
                    }else{
                        $currency='vnđ';
                    }   
                    ?>
                    <tr>
                        <td align="center"><img src="thumb/199x199/2/<?=_upload_sanpham_l.$v['photo'];?>"></td>
                        <td class="col-info-pro">
                            <p class="name_pro"><a href="san-pham/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" target="_blank"><?=$v['ten']?></a></p>
                            <p><i class="fa fa-circle" aria-hidden="true"></i> <b>Mã SP:</b> <?=$v['masp']?></p>
                            <p><i class="fa fa-circle" aria-hidden="true"></i> <b>Công suất:</b> <?=$v['congsuat']?></p>
                            <p><i class="fa fa-circle" aria-hidden="true"></i> <b>Bảo hành:</b> <?=$v['baohanh']?></p>
                            <p><i class="fa fa-circle" aria-hidden="true"></i> <b>Tình trạng:</b> <span><?=$v['tinhtrang']?></span></p>
                            <p><i class="fa fa-circle" aria-hidden="true"></i> <b>Giao hàng trên 63 tỉnh thành</b></p>
                            <p><?=$v['mota']?></p>
                        </td>
                        <td class="td_gia_qt" align="center">
                            <span class="gia1"><?php if($v['gia']>0) echo number_format($v['gia'],0, ',', '.').' '.$currency;else echo _lienhe;?></span>
                            <span class="gia2">
                                <i class="<?php if($v['giakm']>0)echo 'giacu'?>"><?php if($v['giakm']>0)echo number_format($v['giakm'],0, ',', '.');?></i> 
                                <?php if($v['giakm']>0){?>
                                    <i class="giams">(Giảm: -<?=tinh_phantram($v['giakm'],$v['gia']);?>%)</i> 
                                <?php }?>
                            </span>
                        </td>
                        <td class="act_quantam" align="center">
                            <a class="add_cart" data-id="<?=$v['id']?>"><i class="fas fa-shopping-cart"></i></a>
                            <a class="del_quantam" data-id="<?=$v['id']?>" title="Xóa khỏi danh sách"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
    </div>
</div>