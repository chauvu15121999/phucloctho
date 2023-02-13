<?php
	$pupop=get_fetch("select photo,ten,hienthi from #_background where hienthi=1 and type='pupop' limit 0,1");

	if($pupop['hienthi']==1 and empty($_SERVER['HTTP_REFERER'])){
?>

	<div id="popup_box">
			<a href="<?=$pupop['link']?>" title="Xem ngay" ><img src="<?=_upload_hinhanh_l.$pupop['photo']?>" alt="Popup" /></a>
	</div>

	<script>
		$(document).ready(function () {
				$.fancybox.open($('#popup_box'));
		});
	</script>
<?php } ?>
