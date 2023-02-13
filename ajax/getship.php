<?php  
include ("ajax_config.php");
include_once _lib."class_viettelpost.php";

$id_city = (int)$_POST['id_city'];
$id_quan = (int)$_POST['id_quan'];
$trongluong = (int)$_POST['trongluong'];

$vtp = new ViettelPost();

$res = $vtp->ListKhoHang();
$arr_khohang = array_reverse($res['data']);
$khohang = $arr_khohang[0];
$info_khohang = array('id'=>$khohang['groupaddressId'],'cusId'=>$khohang['cusId'],'name'=>$khohang['name'],'phone'=>$khohang['phone'],'address'=>$khohang['address'],'provinceId'=>$khohang['provinceId'],'districtId'=>$khohang['districtId'],'wardsId'=>$khohang['wardsId']);

// "ORDER_SERVICE"=>"VCN",
$postData = array(
	"PRODUCT_WEIGHT"=> $trongluong,
	"PRODUCT_PRICE"=> 0,
	"MONEY_COLLECTION"=>0,
	"ORDER_SERVICE_ADD"=>"",
	"ORDER_SERVICE"=>"VTK",
	"SENDER_PROVINCE"=> $info_khohang['provinceId'],
	"SENDER_DISTRICT"=> $info_khohang['districtId'],
	"RECEIVER_PROVINCE"=> $id_city,
	"RECEIVER_DISTRICT"=> $id_quan,
	"PRODUCT_TYPE"=>"HH",
	"NATIONAL_TYPE"=>1
);
$res_cuocphi = $vtp->getPrice($postData);
// print_r($res_cuocphi);
$phi_ship = $res_cuocphi['data']['MONEY_TOTAL'];

$result = array('ship'=>$phi_ship,'ship_txt'=>number_format($phi_ship,0,',','.').' đ');
echo json_encode($result);

die();
?>