<?php
	use EasyCSRF\Exceptions\InvalidCsrfTokenException;
	use Carbon\Carbon as Carbonz;
	
	class Model
	{
		private $db;
		private $data = array();
		private $company = array();
		private $optcompany = '';
		private $config = array();
		private $setting;
		private $options;
		private $lang;
		public $carbon;
		function __construct($d,$config){
			
			$carbon = new Carbonz; 
			$this->db = $d;
			$this->config = $config;
			$setting = $this->db->rawQueryOne("select * from #_setting");
			
			$options = (isset($setting['options']) && $setting['options'] != '') ? json_decode(stripslashes($setting['options']),true) : null;
			if(!$options){
				$options = (isset($setting['options']) && $setting['options'] != '') ? json_decode(($setting['options']),true) : null;
			}

			$this->setting = $setting;
			$this->options = $options;
			$this->carbon = $carbon;
			
		}
		function sendOrder($data,$products){
			$def = array("pick_name"=>"7sport HCM","pick_address"=>"37 Lâm Thị Hố","pick_province"=>"TP. Hồ Chí Minh","pick_district"=>"Quận 12","pick_ward"=>"Phường Tân Chánh Hiệp","pick_tel"=>"0886686839");
			$order = array();
			$order['order'] = array_merge($def,$data);
			$order['products'] = $products;
			
			
		
				$curl = curl_init();
				
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode($order),
					CURLOPT_HTTPHEADER => array(
						"Content-Type: application/json",
						"Token: ".token_ghtk,
						"Content-Length: " . strlen(json_encode($order)),
					),
				));

				$response = curl_exec($curl);
				curl_close($curl);
				return $response;
				
			
		}
		function getShipCost($array){
			
			$data = array(
				"pick_province" => "TP.Hồ Chí Minh",
				"pick_district" => "Quận 12",
				"province" => $array['province'],
				"district" => $array['district'],
				"weight" => 1000,
				"deliver_option" => "xteam",
			);
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
					"Token: ".token_ghtk,
				),
			));

			$response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($response,true);
			
			if($response['success']){
				if(isset($response['fee']['fee']))
					return $response['fee']['fee'];
				return 0;
			}
			return 0;
			
		}
		function setLang($lang){
			$this->lang = $lang;
		}
		function getPayment($id=null){
			if(!isset($this->data['payments'])){
				foreach($this->db->rawQuery("select ten".$this->lang." as name,id from #_news where type='hinh-thuc-thanh-toan'") as $k=>$v){
					$this->data['payments'][$v['id']] = $v['name'];
				}
			}
			if(!$id){
				return $this->data['payments'];
			}
			return $this->data['payments'][$id];
		}	
		function getStatus($id=null,$field=null){
			if(!isset($this->data['status_list'])){
				foreach($this->db->rawQuery("select * from #_status order by id ") as $k=>$v){
					$v['name'] =  ($this->lang=="vi")?$v["trangthai"]:$v["trangthaien"];
					$this->data['status_list'][$v['id']] = $v;
				}
			}
			if(!$id){
				return $this->data['status_list'];
			}
			$row = $this->data['status_list'][$id];
			if($field){
				
				return $row[$field];
			}
			return $row;
			
		}
		function getUser($id,$key=null){
			$row = $this->db->rawQueryOne("select * from #_member where id = '$id'");
			if($key)
				return $row[$key];
			return $row;

		}
		function setFlash($key,$value){
			$_SESSION['flash_'.$key] = $value;
		}
		function getFlash($key){
			$k = isset($_SESSION['flash_'.$key])?$_SESSION['flash_'.$key]:0;
			if(isset($_SESSION['flash_'.$key])){
				unset($_SESSION['flash_'.$key]);
			}
			return $k;
		}
		function chectRowFromUser($id){
			if(!$id){
				redirect(_baseUrl());	
			}
			$row = $this->db->rawQueryOne("select * from #_history_log  where id = '$id' and id_member='".getUserInfo("id")."' and status_quote_amout = 0 and at_time > CURRENT_DATE()");
			if(!isset($row['id'])){
				redirect(_baseUrl());	
			}
			if($row['no_update']){
				global $func;
				$func->transfer("Transaction has been updated",_baseUrl());	 
			}

		}
		function checkUserValidRegister(){
			return true;
			$id = getUserInfo('id');
			return true;
			$r = $this->db->rawQueryOne("select protect_status from #_member where id = '$id'");
			if($r['protect_status']==1){
				return false;
			}
			if(count($this->db->rawQuery("select id from #_history_log where id_member = '$id' and at_time > CURRENT_DATE()"))){
				return false;
			}
			return true;
		}
		function initCSRF(){
			$this->sessionProvider = new EasyCSRF\NativeSessionProvider();
			$this->easyCSRF = new EasyCSRF\EasyCSRF($this->sessionProvider);

		}
		function sendAPI($data=array(),$type=""){
			if(!$type){
				die("Missing type");
			}
			$type_array = array("create-wallet"=>"/api/v1/wallet/create");
			$url = $this->options['APIURL'].$type_array[$type];
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_PORT => "8080",
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode($data),
			  CURLOPT_HTTPHEADER => array(
			    "cache-control: no-cache",
			    "content-type: application/json",
			    "x-api-key: ".$this->options['tronAPI'],
			  ),
			));
			
			$response = curl_exec($curl);
			
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  die("cURL Error #:" . $err);
			} else {
			  return $response;
			}
		}
		function createWallet($row){
			$data = array();
			$data['id_member'] = $row['id'];
			$data['create_at'] = currentDate();
			$rp = json_decode($this->sendAPI(array("walletType"=>"trx"),"create-wallet"));
			$data['tron_address'] = $rp->address;
			$data['type'] = $rp->type;
			return $this->db->insert("wallet",$data);
		}
		function _csrf(){
			return $this->easyCSRF->generate($this->config['hash']);
		}
		function __csrf($name="token"){
			return true;
			try {
			  return $this->easyCSRF->check($this->config['hash'], $_POST[$name]);
			}catch(InvalidCsrfTokenException $e) {
			   return false;
			}
		}
		function checkUserLogin(){
			return !empty($_SESSION["LoginMember".NN_MSHD]);
		}
		function saveAddressBox($data){
			if($this->checkUserLogin()){
				$data['id_member']  = getUserInfo("id");
				foreach($data as $k=>$v){
					$data[$k] = encode($v);
				}			
				if(!isset($data['id'])){
					$this->db->insert("address_box",$data);
				}
			}
		}
		function savingUserLogin($data){
			$_SESSION["LoginMember".NN_MSHD] = array();
			unset($data['password']);
			$data['wallet'] = $this->db->rawQueryOne("select tron_address from #_wallet where id_member = '".$data['id']."'")['tron_address'];
			$_SESSION["LoginMember".NN_MSHD] = $data;
		}
		function setArray($array=array()){
			foreach($array as $k=>$v){
				$this->_set($k,$v);
			}
		}
		function getCA($id,$f=null){
			if(!isset($this->data['ca'])){
				foreach($this->db->rawQuery("select id,motavi as link,tenvi as name from #_news where type='ca'") as $k=>$v){
					$this->data['ca'][$v['id']] = $v;
				}
			}
			if(!$f)
				return $this->data['ca'][$id];
			return $this->data['ca'][$id][$f];
		}
		function getNews($type){
			return $this->db->rawQuery("select * from #_news where type='$type' and hienthi > 0 order by stt asc,id desc");
		}
		function getStatic($type,$field){

			return decode($this->db->rawQueryOne("select * from #_static where type='$type'")[$field]);

		}
		function _set($name,$data){
			$this->data[$name] = $data;
		}
		function _get($name){
			$p = explode(".",$name);
			if(count($p) > 0 ){
				$r = null;
				$data = $this->data;
				foreach($p as $k=>$v){
					$data = @$data[$v];	
				}
				return @$data;
			}
			return (isset($this->data[$name]))?$this->data[$name]:false;
		}
		function set($name,$data){
			$this->_set($name,$data);
		}
		function get($name){
			return $this->_get($name);
		}

	}