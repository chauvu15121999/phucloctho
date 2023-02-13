<?php
	include ("ajax_config.php");
	include_once _lib."class_viettelpost.php";
	
	$act =(string) magic_quote(trim(strip_tags($_POST['act'])));
	
	switch($act){
		case "dist":
			load_dist();
			break;
		case "ward":
			load_ward();
			break;
		default:
			break;
	}

	function load_dist()
	{
		$vtp = new ViettelPost();
		$id_city = (int)($_POST['id_city']);	
		$arr_get2 = $vtp->getDistrict($id_city);
		$row = $arr_get2['data'];

		$str='<option value="">'._quanhuyen.'*</option>';
		foreach($row as $v){
			$str.='<option value='.$v["DISTRICT_ID"].'>'.$v["DISTRICT_NAME"].'</option>';		
		}
		echo $str;
	}
	function load_ward()
	{
		$vtp = new ViettelPost();
		$id_quan = (int)($_POST['id_quan']);	
		$arr_get2 = $vtp->getWard($id_quan);
		$row = $arr_get2['data'];

		$str='<option value="">PHƯỜNG/XÃ*</option>';
		foreach($row as $v){
			$str.='<option value='.$v["WARDS_ID"].'>'.$v["WARDS_NAME"].'</option>';		
		}
		echo $str;
	}
?>   
