<?php
	include "ajax_config.php";

	if(!empty($_POST['id']))
	{
		$table = (!empty($_POST['table'])) ? htmlspecialchars($_POST['table']) : '';
		$id = (!empty($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
		$loai = (!empty($_POST['loai'])) ? htmlspecialchars($_POST['loai']) : '';

		$tmp = $d->rawQueryOne("select $loai from #_$table where id = ? limit 0,1",array($id));

		if($tmp[$loai]>0) $data[$loai] = 0;
		else $data[$loai] = 1;

		$d->where('id',$id);
		$d->update($table,$data);
		$cache->DeleteCache();
	}
?>