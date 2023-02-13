<?php
	include "ajax_config.php";
	
	$id_wards = (!empty($_POST['id_wards'])) ? htmlspecialchars($_POST['id_wards']) : 0;
	$street = null;
	if($id_wards) $street = $d->rawQuery("select ten, id from #_street where id_wards = ? order by id asc",array($id_wards));

	if($street)
	{ ?>
		<option value=""><?=duong?></option>
		<?php foreach($street as $k => $v) { ?>
			<option value="<?=$v['id']?>"><?=$v['ten']?></option>
		<?php }
	}
	else
	{ ?>
		<option value=""><?=duong?></option>
	<?php }
?>