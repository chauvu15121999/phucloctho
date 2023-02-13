<?php  if(!defined('_source')) die("Error");
	
	if(!empty($_COOKIE['ds_sosanh'])){

		$str_id = str_replace('-', ',', $_COOKIE['ds_sosanh']);

		$where = "hienthi=1 and id IN ($str_id)";

		$all_product_ss = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,congsuat,baohanh,tiente FROM table_product where $where");

		$_SESSION['sosanh']=array_unique($_SESSION['sosanh']);
		if(empty($_SESSION['sosanh']) || count($_SESSION['sosanh'])<2){
			unset($_SESSION['sosanh']);
			$k=1;
			foreach($all_product_ss as $v){
				if($k==3) break;
				$_SESSION['sosanh'][] = $v['id'];
				$k++;
			}
		}
		$str_id_dang_ss = implode(',', $_SESSION['sosanh']);

		$product_ss = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,congsuat,baohanh,tiente,tinhtrang,mota FROM table_product where hienthi=1 and id IN ($str_id_dang_ss)");

	}

?>
