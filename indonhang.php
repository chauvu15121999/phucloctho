<?php
	session_start();
    $session=session_id();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
    include_once _lib."functions_for.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";	
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$login_name = 'NINACO';


    include_once _lib."Mobile_Detect.php";
    $detect = new Mobile_Detect;
    $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
    $id_l = (isset($_REQUEST['id_list'])) ? addslashes($_REQUEST['id_list']) : "";
	
	$d = new database($config['database']);	
	?>

	<?php
		$sql = "select * from #_company limit 0,1";		
		$d->query($sql);
		$info = $d->fetch_array();

		$sql = "select photo from #_background where type='logo' limit 0,1";		
		$d->query($sql);
		$logo = $d->fetch_array();

        #Lấy httt
        $d->reset();
        $sql = "select id,ten$lang as ten from #_httt where hienthi=1 and id='".$_POST['httt']."' order by stt,id desc";
        $d->query($sql);
        $get_httt = $d->fetch_array();

        #Lấy tỉnh thành phố
        $d->reset();
        $sql = "select id,ten from #_place_city where hienthi=1 and id='".$_POST['thanhpho']."' order by stt,id desc";
        $d->query($sql);
        $tinh = $d->fetch_array();

        #Lấy tỉnh thành phố
        $d->reset();
        $sql = "select id,ten from table_place_dist where hienthi=1 and id='".$_POST['quan']."' order by stt,id desc";
        $d->query($sql);
        $quan = $d->fetch_array();
	?>

<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css">
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
    width:29.7cm;
    margin:auto;
    box-shadow:0 0 1px;
    padding:20px;
    color:#000;
    font-family:Arial, Helvetica, sans-serif;
    font-size:12px;
    line-height:1.2;
    box-sizing: border-box;
    background:#fff;
}
.hotl{
    font-weight: bold;
    font-size: 15px;
    border-bottom: 1px solid #000;
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
    margin-bottom:5px;
}
.info span{
    font-weight:bold;
}
.td_dh{
    font-weight:bold;
    margin-bottom:5px;
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
    border:1px solid #000;
    border-bottom:none;
    border-right:none;
}
.content_dh .stt{
    float: left;
    width: 5%;
}
.content_dh .ten{
    float: left;
    width: 29%;
}
.content_dh .baohanh{
    float: left;
    width: 10%;
}
.content_dh .congsuat{
    float: left;
    width: 10%;
}
.content_dh .hinh{
    float: left;
    width: 15%;
}
.content_dh .hinh img{max-width: 62px !important}
.content_dh .sl{
    float: left;
    width: 8%;
}
.content_dh .dongia{
    float: left;
    width: 18%;
}
.content_dh .thanhtien{
    float: left;
    width: 25%;
}
.th_donhang{
    text-align: center;
    font-weight: bold;
    padding: 5px;
    box-sizing: border-box;
    border-bottom: 1px solid #000;
    border-right: 1px solid #000;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.td_donhang{
    text-align: center;
    padding: 5px;
    box-sizing: border-box;
    border-bottom: 1px solid #000;
    border-right: 1px solid #000;
    min-height: 95px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.tongcong{
    border-bottom: 1px solid #000;
 
    float: left;
    width: 100%;
 
}
.td_tong{
    padding:0 5px;
    float: left;
    text-align: right;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 13px;
    width: 83%;
    align-items: center;
    border-right: 1px solid #000;
    box-sizing: border-box; height:30px; line-height:30px;
}
.td_dh1{ border: 1px solid #000;  border-top:none; padding:5px; padding-top: 20px; }
.thanhtien1{
    float: left;
    width: 17%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding:0 5px; height:30px; line-height:30px;
    box-sizing: border-box; border-right: 1px solid #000;
}
.logo_dh{
    text-align: center;
    margin-bottom: 15px;
    padding: 8px 0px;
    float: left;
    width: 15%;
    padding-top: 0px;
    
}
.logo_dh img{
    max-width:100%;
}
.thongtin-right{
    float: left;
    width: 83%;
    padding-left: 2%;
}
.box-top{ margin-bottom:30px;}
.tieude{ margin-bottom:30px;}
.fon-1{ margin:0; font-weight: bold; font-size: 16px; text-transform: uppercase; margin-bottom:4px;}
.fon-2{ margin:0; margin-bottom:4px; font-size: 14px;}
.fon-3{ margin:0;  font-size: 14px; }
.width100{width: 100% !important; }
.width100 .thanhtien1{font-size: 11px;}
body{margin:0;padding:0}
</style>
</head><body onload="window.print();" cz-shortcut-listen="true" style="background:#f1f1f1;"><div class="wraper_dh <?php if($deviceType!='computer') {?> width100 <?php }?>">
    <div class="box-top clear">
        <div class="logo_dh"><img src="<?=layhinh('photo','logo')?>"></div>
        <div class="thongtin-right">
            <p class="fon-1"><?=$info['ten']?></p>
            <?php if($info['mst']!=''){?>
			<p class="fon-2"><b>MST:</b> <?=$info['mst']?></p>
			<?php }?>
            <p class="fon-2"><b>Địa chỉ:</b> <?=$info['diachi']?></p>
            <?php if($info['stk']!=''){?>
			<p class="fon-2"><b>STK:</b> <?=$info['stk']?></p>
            <?php }?>
          
            <?php if($info['dienthoai']!=''){?><p class="fon-2"><b>Hotline:</b> <?=$info['dienthoai']?></p><?php }?>
            <?php if($info['website']!=''){?>
			<p class="fon-3"><b>Website:</b> <?=$info['website']?> - Email: <?=$info['email']?></p>
			<?php }?>
        </div>
    </div>
	
    <!-- <div class="hotl">Tổng đài: <?=$info['fax']?></div> -->
    <div class="tieude">HÓA ĐƠN BÁN HÀNG</div>   
    
    <div class="content_dh clear">
    	<div class="clear">
			<div class="th_donhang stt" style="border-bottom:1px #fff solid;">STT</div>
			<div class="th_donhang hinh">Hình ảnh</div>
			
			<div class="th_donhang ten">Tên hàng</div>
			
			<div class="th_donhang sl">SL</div>
			<div class="th_donhang dongia">Đơn giá</div>
			<div class="th_donhang thanhtien">Thành tiền</div>
			
			<div class="th_donhang stt"></div>
			<div class="th_donhang hinh">1</div>
		
			<div class="th_donhang ten">2</div>
			
			<div class="th_donhang sl">3</div>
			<div class="th_donhang dongia">4</div>
			<div class="th_donhang thanhtien">5</div>
		</div>
        
        <?php $k1=1; foreach($_SESSION['cart'] as $k => $v){
            $pid = $v['productid'];
            $size = $v['size'];
            $mausac = $v['mausac'];
            $q = $v['qty'];
            $pmasp = get_code($pid);
			$pbaohanh = get_baohanh($pid);
			$pcongsuat = get_congsuat($pid);
            $pname = get_product_name($pid);
            $pphoto = get_product_photo($pid);
			$tiente = get_tiente($pid);
			if($tiente==2){
				$currency='usd';
			}else{
				$currency='vnđ';
			}
         ?>
		<div class="clear">
        <div class="td_donhang stt" style="text-align:left"><?=$k1?></div>
        <div class="td_donhang hinh"><img class="img_gh" src="<?=_upload_sanpham_l.$pphoto?>" alt="<?=$pname?>"/></div>
      
        <div class="td_donhang ten" style="text-align:left"><?=$pname?></div>
       
        <div class="td_donhang sl"><?=$q?></div>
        <div class="td_donhang dongia"><?=number_format(get_price($pid),0, ',', '.')?> <?=$currency?></div>
        <div class="td_donhang thanhtien"><?=number_format(get_price($pid)*$q,0, ',', '.') ?> <?=$currency?></div>
        </div>
        <?php $k1++; } ?>

        <div class="tongcong clear">
        	<div class="td_tong">Tổng cộng(VNĐ)</div>
            <div class="thanhtien1"><?=number_format(get_order_total(),0, ',', '.')?> đ</div>
        </div>
    </div>
    <!-- <div class="kyten clear">
        <span class="cuahang">Xác nhận cửa hàng</span>
        <span class="cuahang">Xác nhận khách hàng</span>
    </div> -->
    <div class="td_dh1 clear">
		<div class="td_dh">THÔNG TIN KHÁCH HÀNG</div>
		 <div class="info"><span>Ngày</span>: <?=date('d/m/Y h:m:s')?></div>
		<div class="info"><span>Hình thưc thanh toán</span>: <?=$get_httt['ten']?></div>
		<div class="info"><span>Người mua</span>: <?=$_POST['hoten']?></div>
		<div class="info"><span>Điện thoại</span>: <?=$_POST['dienthoai']?></div>
		<div class="info"><span>Tỉnh/Thành Phố</span>: <?=$tinh['ten']?> - <span>Quận/Huyện</span>: <?=$quan['ten']?></div>
		<div class="info"><span>Địa chỉ</span>: <?=$_POST['diachi']?></div>
		<div class="info"><span>Ghi chú</span>: <?=$_POST['noidung']?></div>
		
	</div>
   
    <div class="footer_dh">Xin cảm ơn quý khách! Hẹn gặp lại</div>
</div></body></html>
