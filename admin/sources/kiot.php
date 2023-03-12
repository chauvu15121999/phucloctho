<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$urlcu = "";
	$urlcu .= (isset($_REQUEST['id_danhmuc'])) ? "&id_danhmuc=".addslashes($_REQUEST['id_danhmuc']) : "";
	$urlcu .= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
	$urlcu .= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
	$urlcu .= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

	/*
	$d->reset();
	$sql="select id,masp,id_thuonghieu from #_product where type='san-pham' order by stt,id desc";
	$d->query($sql);
	$product_br=$d->result_array();
	for($i=0;$i<count($product_br);$i++){
		if($product_br[$i]['masp']!=''){
			$th=explode(' | ',$product_br[$i]['masp']);
			$thh=$th[0];
			
			$d->reset();
			$sql="select ten,id from #_product_thuonghieu where ten='".$thh."' order by stt,id desc";
			$d->query($sql);
			$brand=$d->result_array();
			if(count($brand)>0){
			
				$d->reset();
				$sql1 = "UPDATE #_product SET id_thuonghieu=".$brand[0]['id']." WHERE id =".$product_br[$i]['id']." ";
				$d->query($sql1);
			}
		}
	}*/

	include _lib."class.Functions.php";
	include _lib."class.Kiot.php";
	include _lib."class.PDODb.php";
	 $d2 = new PDODb($config['pdo']);
$kiot = new Kiot($d2);
switch($act){

	case "man":
	
		$template = "kiot/item";
		break;
	case "importKiotCategory":
		kiot('importKiotCategory');
		die;
		break;
	case "importKiotProduct":
		
		kiot('importKiotProduct');
		die;
		$template = "product/item_add";
		break;
	
	default:
		$template = "index";
}
function kiot($kind)
{
		global $func, $d, $kiot, $link, $setting;
		$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;
		if($kind == 'importKiotCategory')
		{
			
			$API = $kiot->getKiotAPI(array('link' => '/categories?hierachicalData=true&orderBy=Name&pageSize=100', 'table' => 'product_danhmuc', 'backLink' => $link))->data;
			$data = array("Lỗi");
			if(!empty($API))
			{
				$data = $kiot->pushCategoryFromKiot($API);
			}
			echo '<table class="mtable">';
			foreach($data as $k=>$v){

				echo '<tr><td class="'.$v[0].'">'.$v[1].'</td></tr>';
			}
			echo '</table>';
		}
		if($kind == 'importKiotProduct')
		{
			$API = $kiot->getKiotAPI(array('link' => '/products?includeInventory=true&includeMaterial=true&includePricebook=true&orderBy=Id&orderDirection=Desc&pageSize=100', 'table' => 'product', 'backLink' => $link, 'quantity' => $optsetting['productCount']))->data;
			$data = array("Lỗi");
			if(!empty($API))
			{
				$data = $kiot->pushProductFromKiot($API);
			}
			echo '<table class="mtable">';
			foreach($data as $k=>$v){
				echo '<tr><td class="'.$v[0].'">'.$v[1].'</td></tr>';
			}
			echo '</table>';
		}
		if($kind == 'checkInvoices')
		{
			$API = $kiot->getKiotAPI(array('link' => '/invoices?pageSize=100', 'table' => 'product', 'backLink' => $link))->data;
			if(!empty($API))
			{
				$kiot->pushInvoicesFromKiot($API);
			}
		}
}

function kiot_upload()
{
	global $func, $d, $config, $kiot, $type, $link;
	foreach($kiot->getAllProduct()->data as $k => $v)
	{
		$data_code[] = $v->code;
	}
	
	$item = $d->rawQuery("select * from #_product where type=?", array($type));
	foreach($item as $k => $v)
	{
		if(!in_array($v['code'], $data_code) && !empty($v['code']))
		{
			$kiot->addProductByApi($v);
			$result['push']++;
		}
	}
	$func->transfer("Upload thành công", $link, "success");
}