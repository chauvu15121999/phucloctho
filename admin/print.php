<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');	
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";	
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$login_name = 'NINACO';
	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
    $id_l = (isset($_REQUEST['id_list'])) ? addslashes($_REQUEST['id_list']) : "";
	
	$d = new database($config['database']);
	
	?>

	<?php

		$sql = "select * from #_company limit 0,1";		
		$d->query($sql);
		$info = $d->fetch_array();

		$sql = "select photo from #_background where type='banner' limit 0,1";		
		$d->query($sql);
		$logo = $d->fetch_array();

		$sql = "select * from #_donhang where id=".$_REQUEST['id']." limit 0,1";		
		$d->query($sql);
		$khachhang = $d->fetch_array();

		$sql = "select ten from #_news where type='thongbao' order by stt,id desc limit 0,4";		
		$d->query($sql);
		$thongbao = $d->result_array();

		$sql = "select * from #_chitietdonhang where hienthi=1 and madonhang='".$khachhang['madonhang']."' order by stt,id desc";
		$d->query($sql);
		$chitietdonhang = $d->result_array();

	?>

<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><style type="text/css">
.clear:after {
	visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
}
* html .clear             { zoom: 1; } /* IE6 */
*:first-child+html .clear { zoom: 1; } /* IE7 */
.wraper_dh{
	width:100%;
	margin:auto;
	box-shadow:0 0 1px;
	padding:20px;
	color:#000;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	line-height:1.2;
    box-sizing: border-box;
}
.hotl{
    font-weight: bold;
    font-size: 15px;
    border-bottom: 1px dashed #000;
    padding-bottom: 10px;
    margin-bottom: 10px;
    text-align: center;
}
.hotl.style0 {
    padding-bottom: 0px;
    margin-bottom: 5px;
    border-bottom: none;
}
.thongbao_style0 {
    padding: 3px 0;
    font-style: italic;
}
.tieude{
	font-weight: bold;
    text-align: center;
    font-size: 20px;
}
.masp{
}
.info{
	margin-bottom:3px;
}
.info span{
	font-weight:bold;
}
.td_dh{
	font-weight:bold;
	margin-bottom:5px;
    margin-top: 20px;
}
.kyten{
    margin-top: 10px;
    height: 100px;
}
.kyten .cuahang{
	float:left;
	width:50%;
	text-align:center;
}
.footer_dh{
    text-align: center;
    border-bottom: 1px dashed #000;
    padding: 7px 0;
    margin-top: 7px;
}
.content_dh{
	border:1px dashed #000;
	border-bottom:none;
	border-right:none;
}
.content_dh .ten{
    float: left;
    width: 46%;
}
.content_dh .sl{
    float: left;
    width: 10%;
}
.content_dh .dongia{
    float: left;
    width: 22%;
}
.content_dh .thanhtien{
    float: left;
    width: 22%;
}
.th_donhang{
    text-align: center;
    font-weight: bold;
    padding: 5px;
    box-sizing: border-box;
    border-bottom: 1px dashed #000;
    border-right: 1px dashed #000;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.td_donhang{
    text-align: center;
    padding: 5px;
    box-sizing: border-box;
    border-bottom: 1px dashed #000;
    border-right: 1px dashed #000;
    min-height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.tongcong{
	border: 1px dashed #000;
    border-top: 0;
    float: left;
    width: 100%;
    border-left: 0;
    border-right: 0;
}
.td_tong{
    padding: 5px;
    float: left;
    text-align: right;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 13px;
    width: 78%;
    border-right: 1px dashed #000;
    box-sizing: border-box;
}
.thanhtien1{
    float: left;
    width: 22%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px;
    box-sizing: border-box;
    border-right: 1px dashed #000;
}
.logo_dh{
	width:30%;
	text-align:center;
	margin-bottom:10px;
    padding: 8px 0px;
    float: left;
}
.thongtin-right{width: 68%;float: right;}
.box-top{}
.fon-1{font-weight: bold;font-size: 20px;text-transform: uppercase;line-height: 1.5;margin:2px 0}
.fon-2{font-weight: bold;font-size: 16px;line-height: 1.5;margin:2px 0}
.fon-3{font-weight: bold;font-size: 16px;color: #f00;line-height: 1.5;margin:2px 0}
</style>
</head><body onload="window.print();" cz-shortcut-listen="true"><div class="wraper_dh">
    <div class="box-top clear">
        <div class="logo_dh"><img src="<?=_upload_hinhanh.$logo['photo']?>"></div>
        <div class="thongtin-right">
            <p class="fon-1"><?=$info['ten']?></p>
            <p class="fon-2">ĐC: <?=$info['diachi']?></p>
            <p class="fon-2">Kho: <?=$info['kho']?></p>
            <p class="fon-1">phòng kinh doanh</p>
            <p class="fon-2">Phone: <?=$info['dienthoai']?> - Email: <?=$info['email']?></p>
            <p class="fon-3">website: <?=$info['website']?></p>
        </div>
    </div>
	
    <!-- <div class="hotl">Tổng đài: <?=$info['fax']?></div> -->
    <div class="tieude">HÓA ĐƠN BÁN HÀNG</div>   
    <div class="td_dh">Ghi chú đơn hàng</div>
    <div class="content_dh clear">
    	<div class="th_donhang ten">Tên hàng</div>
        <div class="th_donhang sl">SL</div>
        <div class="th_donhang dongia">Đơn giá</div>
        <div class="th_donhang thanhtien">Thành tiền</div>
        
        <?php $tongtien = 0; 
			  $tongtien_usd = 0; 
		foreach ($chitietdonhang as $key => $value) { 
			if($value['tiente']==2){
				$currency='usd';
			}else{
				$currency='vnđ';
			}
		
			if($value['tiente']==2){
				$tongtien_usd+=($value['gia']*$value['soluong']); 
			}else{
				$tongtien+=($value['gia']*$value['soluong']); 
			}
		?>

        <div class="td_donhang ten" style="text-align:left"><?=catchuoi($value['ten'],30)?></div>
        <div class="td_donhang sl"><?=$value['soluong']?></div>
        <div class="td_donhang dongia"><?=number_format($value['gia'],0,'.',',')?> <?=$currency?></div>
        <div class="td_donhang thanhtien"><?=number_format($value['gia']*$value['soluong'],0,'.',',')?> <?=$currency?></div>
        
        <?php } 
		
		
		?>
		<div class="tongcong clear">
        	<div class="td_tong">Tạm tính</div> 
            <div class="thanhtien1"><?=number_format($tongtien,0,'.',',')?> vnđ + <?=number_format($tongtien_usd,0,'.',',')?> usd</div>
        </div>
        <div class="tongcong clear">
        	<div class="td_tong">Phí vận chuyển</div> 
            <div class="thanhtien1"><?=number_format($khachhang['phi_vanchuyen'],0,'.',',')?> vnđ</div>
        </div>
		<div class="tongcong clear">
        	<div class="td_tong">Tổng cộng</div> 
            <div class="thanhtien1"><?=number_format($tongtien+$khachhang['phi_vanchuyen'],0,'.',',')?> vnđ + <?=number_format($tongtien_usd,0,'.',',')?> usd</div>
        </div>
    </div>
    <!-- <div class="kyten clear">
        <span class="cuahang">Xác nhận cửa hàng</span>
        <span class="cuahang">Xác nhận khách hàng</span>
    </div> -->
    <div class="td_dh">Thông tin khách hàng</div>
     <div class="info"><span>Ngày</span>: <?=date('d/m/Y h:m:s')?></div>
    <div class="info"><span>Người mua</span>: <?=$khachhang['hoten']?></div>
    <div class="info"><span>Điện thoại</span>: <?=$khachhang['dienthoai']?></div>
    <div class="info"><span>Địa chỉ</span>: <?php if(!empty($khachhang['diachi_txt'])) echo $khachhang['diachi_txt'];else echo $khachhang['diachi'];?></div>
    <div class="hotl style0">THÔNG BÁO</div>
    <?php foreach ($thongbao as $key => $value) { ?>
    <div class="thongbao_style0"><?=$value['ten']?></div>
    <?php } ?>
    <div class="footer_dh">Xin cảm ơn quý khách! Hẹn gặp lại</div>
</div></body></html>
