<?php
	include "ajax_config.php";
	
	$id_city = (!empty($_POST['id_city'])) ? htmlspecialchars($_POST['id_city']) : 0;
	$district = null;
	if($id_city) $district = $d->rawQuery("select ten, id from #_district where id_city = ? order by id asc",array($id_city));

	if($district)
	{ ?>  
		<option value=""><?=quanhuyen?></option>
		<?php foreach($district as $k => $v) { ?>
			<option value="<?=$v['id']?>"><?=$v['ten']?></option>
		<?php }
	}
	else
	{ ?>
		<option value=""><?=quanhuyen?></option>
	<?php }
?>