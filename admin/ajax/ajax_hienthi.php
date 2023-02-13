<?php
	include ("ajax_config.php");

	if(isset($_POST["id"])){
		echo $sql = "update ".(string)$_POST["bang"]." SET ".(string)$_POST["type"]."=".(string)$_POST["value"]." WHERE  id = ".(int)$_POST["id"]."";

		$data = $d->query($sql) or die("Not query sql");
	}
?>
