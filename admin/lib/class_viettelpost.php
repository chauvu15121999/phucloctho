<?php
class ViettelPost{
	public $_USERNAME = 'hr@hungvuongcoltd.com';
	public $_PASSWORD = 'Hungvuong-2018';


	function getLogin(){
		$postData = array(
		    "USERNAME" => $this->_USERNAME,
			"PASSWORD" => $this->_PASSWORD
		);
		$json_data = json_encode($postData);

		$ch = curl_init('https://partner.viettelpost.vn/v2/user/Login');
		curl_setopt_array($ch, array(
		    CURLOPT_POST => TRUE,
		    CURLOPT_RETURNTRANSFER => TRUE,
		    CURLOPT_HTTPHEADER => array(
		        'Content-Type: application/json'
		    ),
		    CURLOPT_POSTFIELDS => $json_data
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}

	function listBuuCucVTP(){
		$row_login = $this->getLogin();

		$ch = curl_init('https://partner.viettelpost.vn/v2/categories/listBuuCucVTP');
		curl_setopt_array($ch, array(
		    CURLOPT_POST => FALSE,
		    CURLOPT_RETURNTRANSFER => TRUE,
		    CURLOPT_HTTPHEADER => array(
		        'Content-Type: application/json',
		        'token: '.$row_login['data']['token']
		    )
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}

	function listService(){
		$postData = array(
		    "TYPE" => 2
		);
		$json_data = json_encode($postData);

		$ch = curl_init('https://partner.viettelpost.vn/v2/categories/listService');
		curl_setopt_array($ch, array(
		    CURLOPT_POST => FALSE,
		    CURLOPT_RETURNTRANSFER => TRUE,
		    CURLOPT_HTTPHEADER => array(
		        'Content-Type: application/json'
		    ),
		    CURLOPT_POSTFIELDS => $json_data
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}

	function getProvince($provinceId=-1){ // -1: get All
		$ch = curl_init('https://partner.viettelpost.vn/v2/categories/listProvinceById?provinceId='.$provinceId);
		curl_setopt_array($ch, array(
		    CURLOPT_POST => FALSE,
		    CURLOPT_RETURNTRANSFER => TRUE
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}

	function getDistrict($provinceId=-1){ // -1: get All
		$ch = curl_init('https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId='.$provinceId);
		curl_setopt_array($ch, array(
		    CURLOPT_POST => FALSE,
		    CURLOPT_RETURNTRANSFER => TRUE
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}

	function getWard($districtId=-1){ // -1: get All
		$ch = curl_init('https://partner.viettelpost.vn/v2/categories/listWards?districtId='.$districtId);
		curl_setopt_array($ch, array(
		    CURLOPT_POST => FALSE,
		    CURLOPT_RETURNTRANSFER => TRUE
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}

	function ListKhoHang(){
		$row_login = $this->getLogin();

		$ch = curl_init('https://partner.viettelpost.vn/v2/user/listInventory');
		curl_setopt_array($ch, array(
		    CURLOPT_POST => FALSE,
		    CURLOPT_RETURNTRANSFER => TRUE,
		    CURLOPT_HTTPHEADER => array(
		        'Content-Type: application/json',
		        'token: '.$row_login['data']['token']
		    )
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}

	function getPrice($data){
		$row_login = $this->getLogin();

		$ch = curl_init('https://partner.viettelpost.vn/v2/order/getPrice');
		curl_setopt_array($ch, array(
		    CURLOPT_POST => FALSE,
		    CURLOPT_RETURNTRANSFER => TRUE,
		    CURLOPT_HTTPHEADER => array(
		        'Content-Type: application/json',
		        'token: '.$row_login['data']['token']
		    ),
		    CURLOPT_POSTFIELDS => json_encode($data)
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}

	function createOrder($data){
		$row_login = $this->getLogin();

		$ch = curl_init('https://partner.viettelpost.vn/v2/order/createOrder');
		curl_setopt_array($ch, array(
		    CURLOPT_POST => FALSE,
		    CURLOPT_RETURNTRANSFER => TRUE,
		    CURLOPT_HTTPHEADER => array(
		        'Content-Type: application/json',
		        'token: '.$row_login['data']['token']
		    ),
		    CURLOPT_POSTFIELDS => json_encode($data)
		));
		$response = curl_exec($ch);
		$responseData = json_decode($response, TRUE);
		curl_close($ch);
		return $responseData;
	}
}