<?php
	include ("ajax_config.php");


	$id = (int)$_POST['id'];
	$size = (string)magic_quote(trim(strip_tags($_POST['size'])));
	$mausac = (string)magic_quote(trim(strip_tags($_POST['mausac'])));
	$soluong = (int)$_POST['soluong'];

	addtocart($id,$size,$mausac,$soluong);

  $d->reset();
  $sql = "select id,ten$lang as ten,type,photo,thumb FROM #_product where hienthi=1 and id='$id' limit 0,1";
  $d->query($sql);
  $row_detail = $d->fetch_array();

?>

<div class="popup_donhang">
    <div class="close-popup" title="Đóng quảng cáo">x</div>
    <p class="img">
      <img src="images/icon_cart.png" alt="<?=$row_detail['ten']?>" />
    </p>
    <p class="ten">
      <?=_sanphamthemvaogiohang?>
    </p>
    <div class="dieukhien">
      <a class="ttmh"><?=_tieptucmuahang?></a>
      <a href="gio-hang.html"><?=_thanhtoan?></a>
    </div>
</div>
