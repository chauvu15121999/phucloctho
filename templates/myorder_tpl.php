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
        <table class="table table-bordered table-striped" id="table_order">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th data-breakpoints="xs">Sản phẩm</th>
                    <th data-breakpoints="xs">Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arr_donhang as $key => $value) { 
                    $d->reset();
                    $sql_chitietdonhang = "select * from #_chitietdonhang where hienthi=1 and madonhang='".$value['madonhang']."' order by stt,id desc";
                    $d->query($sql_chitietdonhang);
                    $chitietdonhang = $d->result_array();
                    ?>
                    <tr>
                        <td width="5%"><?=$key+1?></td>
                        <td><b><?=$value['madonhang']?></b></td>
                        <td><?=date('d-m-Y  H:i A',$value['ngaytao'])?></td>
                        <td>
                            <?php foreach($chitietdonhang as $v){ ?>
                                <p><?=$v['soluong']?> x <?=$v['ten']?></p>
                            <?php } ?>
                        </td>
                        <td><b><?=number_format($value['tonggia'] + $value['phi_vanchuyen'],0,',','.')?> đ + <?=number_format($value['tonggia_usd'],0,',','.')?> usd</b></td>
                        <td><?=get_status_order($value['tinhtrang'])?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
    </div>
</div>