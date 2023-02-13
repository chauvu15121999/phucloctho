<?php
	session_start();
	@define('_lib', '../lib/');
	include_once _lib . "config.php";
	include_once _lib . "constant.php";
	include_once _lib . "functions.php";
	include_once _lib . "functions_giohang.php";
	include_once _lib . "library.php";
	include_once _lib . "class.database.php";
	$d = new database($config['database']);

	include_once _lib."class_viettelpost.php";

	$result = array();

	if(!empty($_POST['madonhang'])){

		$d->reset();
		$sql_company = "select * from #_donhang where madonhang='".$_POST['madonhang']."' limit 0,1";
		$d->query($sql_company);
		$info_donhang= $d->fetch_array();

		if(empty($info_donhang)){
			die();
		}

		$vtp = new ViettelPost();

		// Array ( [httt] => 1 [madonhang] => 10122020NN101 [hoten] => Vũ Mạnh Cường [dienthoai] => 0909123456 [email] => vmcuongnina@gmail.com [id_tinhthanh] => 2 [id_quan] => 46 [id_phuong] => 819 [noidung] => test đơn hàng 2 [phi_thuho] => 0 [phi_vanchuyen] => 37950 [phithem] => 0 [ghichu] => [id_tinhtrang] => 1 [id] => 73 )

		$id_tinhthanh = (int)$_POST['id_tinhthanh'];
		$id_quan = (int)$_POST['id_quan'];
		$id_phuong = (int)$_POST['id_phuong'];


		$d->reset();
		$sql_company = "select * from #_company limit 0,1";
		$d->query($sql_company);
		$company= $d->fetch_array();

		$d->reset();
		$sql_chitietdonhang = "select * from #_chitietdonhang where hienthi=1 and madonhang='".$info_donhang['madonhang']."' order by stt,id desc";
		$d->query($sql_chitietdonhang);
		$chitietdonhang = $d->result_array();

		$arrayVT=array();
		$weightVT=0;
		$soluongVT=0;
		foreach($chitietdonhang as $k1=>$v1){
			$trongluong_pro=get_trongluong($v1['id_sanpham']);
			$weightVT += ($trongluong_pro*$v1['soluong']);
			$soluongVT += $v1['soluong'];
			$arrayVT[]=array("PRODUCT_NAME"=>$v1['ten'],"PRODUCT_WEIGHT"=>(int)$trongluong_pro,"PRODUCT_QUANTITY"=>(int)$v1['soluong'],"PRODUCT_PRICE"=>(int)$v1['gia']);
		}

		

		$res = $vtp->ListKhoHang();
		foreach($res['data'] as $v){
			if($v['groupaddressId']==$_POST['groupaddressId']){
				$khohang = $v;
				break;
			}
		}
		// $info_khohang = array('groupaddressId'=>$khohang['groupaddressId'],'cusId'=>$khohang['cusId'],'name'=>$khohang['name'],'phone'=>$khohang['phone'],'address'=>$khohang['address'],'provinceId'=>$khohang['provinceId'],'districtId'=>$khohang['districtId'],'wardsId'=>$khohang['wardsId']);
	

		$ngaytao_vandon = time();

		// Tạo vận đơn
		$data = array(
			"ORDER_NUMBER" => $info_donhang['madonhang'],
			"GROUPADDRESS_ID" => $khohang['groupaddressId'],
			"CUS_ID" => $khohang['cusId'],
			"DELIVERY_DATE" => date("d/m/Y H:i:s",$ngaytao_vandon),
			"SENDER_FULLNAME" => $company['ten'],
			"SENDER_ADDRESS" => $khohang['address'],
			"SENDER_PHONE" => $khohang['phone'],
			"SENDER_EMAIL" => $company['email'],
			"SENDER_WARD" => $khohang['wardsId'],
			"SENDER_DISTRICT" => $khohang['districtId'],
			"SENDER_PROVINCE" => $khohang['provinceId'],
			"SENDER_LATITUDE" => 0,
			"SENDER_LONGITUDE" => 0,
			"RECEIVER_FULLNAME" => $info_donhang['hoten'],
			"RECEIVER_ADDRESS" => $info_donhang['diachi'],
			"RECEIVER_PHONE" => $info_donhang['dienthoai'],
			"RECEIVER_EMAIL" => $info_donhang['email'],
			"RECEIVER_WARD" => 0,
			"RECEIVER_DISTRICT" => $id_quan,
			"RECEIVER_PROVINCE" => $id_tinhthanh,
			"RECEIVER_LATITUDE" => 0,
			"RECEIVER_LONGITUDE" => 0,
			"PRODUCT_NAME" => $chitietdonhang[0]['ten'],
			"PRODUCT_DESCRIPTION" => "",
			"PRODUCT_QUANTITY" => (int)$soluongVT,
			"PRODUCT_PRICE" => (int)$info_donhang['tonggia'],
			"PRODUCT_WEIGHT" => $weightVT,
			"PRODUCT_LENGTH" => "",
			"PRODUCT_WIDTH" => "",
			"PRODUCT_HEIGHT" => "",
			"PRODUCT_TYPE" => "HH",
			"ORDER_PAYMENT" => 3,
			"ORDER_SERVICE" => "VTK",
			"ORDER_SERVICE_ADD" => "",
			"ORDER_VOUCHER" => "",
			"ORDER_NOTE" => $info_donhang['ghichu'],
			"MONEY_COLLECTION" => 0,
			"MONEY_TOTALFEE" => 0,
			"MONEY_FEECOD" => 0,
			"MONEY_FEEVAS" => 0,
			"MONEY_FEEINSURRANCE" => 0,
			"MONEY_FEE" => 0,
			"MONEY_FEEOTHER" => 0,
			"MONEY_TOTALVAT" => 0,
			"MONEY_TOTAL" => 0,
			"LIST_ITEM"=>$arrayVT,
		);
		
		$res_vandon = $vtp->createOrder($data);
		if($res_vandon['status']==200){ // Thành công
			$mavandon = $res_vandon['data']['ORDER_NUMBER'];

			// cập nhật mã vận đơn
			$d->reset();
			$sql="update #_donhang set postVT=1,CodeVT='$mavandon',ngaytao_vandon='$ngaytao_vandon' where madonhang='".$info_donhang['madonhang']."'";
			$d->query($sql);

			$result['error'] = 0;
			$result['mess'] = 'Đã tạo vận đơn bên Viettel Post.';
		}else{
			$result['error'] = 1;
			$result['mess'] = 'Không thể tạo vận đơn. Error '.$res_vandon['status'].': '.$res_vandon['message'];
		}
	}
	echo json_encode($result);
	die();
?>
