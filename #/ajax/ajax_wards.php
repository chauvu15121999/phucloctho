<?php
	include "ajax_config.php";
	
	$id_district = (!empty($_POST['id_district'])) ? htmlspecialchars($_POST['id_district']) : 0;
	$wards = null;
	if($id_district) $wards = $d->rawQuery("select ten, id from #_wards where id_district = ? order by id asc",array($id_district));

	if($wards)
	{ ?>  
		<option value=""><?=phuongxa?></option>
		<?php foreach($wards as $k => $v) { ?>
			<option value="<?=$v['id']?>"><?=$v['ten']?></option>
		<?php }
	}
	else
	{ ?>
		<option value=""><?=phuongxa?></option>
	<?php }
?>