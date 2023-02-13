<?php
	ini_set('max_execution_time', 300000000);	
	class Kiot extends Functions
	{
		private $db;
		private $session;
		private $kiotapi_link = "https://public.kiotapi.com";
		private $client       = "4b501d67-b540-4bc2-9d30-866af537a270";
		private $secret       = "19A0C7AB4C9A81D0CDCFEF4B37D375A7CB99C526";
		private $name         = "phuclocthobt";
			    function __construct($d)
	    {
	        $this->db = $d;
	        $this->check_login();
	    }
		private function getProductWithPage($url, $offset)
		{
			$url.="&currentitem=".$offset;
			$ar = $this->init($url,null, "GET");
			return $ar->data;
		}

		public function getKiotAPI($data)
		{
			$result         = array();
			$result         = $this->init($data['link'], null, "GET");
			$this->tbl      = $data['table'];
			$this->backLink = @$data['backLink'];
			$this->quantity = @$data['quantity'];
			$KIOT_pageSize  = strstr($data['link'], 'pageSize');
			$KIOT_pageSize  = explode('=', $KIOT_pageSize);
			$KIOT_pageSize  = $KIOT_pageSize[1];

			$total = $result->total;
			$page = ceil($total / $KIOT_pageSize);
			if($page>1)
			{
				for($i=1; $i<$page; $i++)
				{
					foreach($this->getProductWithPage($data['link'], ($KIOT_pageSize*$i+1)) as $k2 => $v2)
					{
						$result->data{count($result->data)} = $v2;
					}
				}
			}
			return ($result);
		}

	    public function pushCategoryFromKiot($API)
	    {
	    	$str = array();
	    	foreach ($API as $i => $itemAPI_lv1)
	    	{
				
				$categoryExixst             = $this->db->rawQuery("select id FROM table_$this->tbl WHERE id_kiot=?", array($itemAPI_lv1->categoryId));
				
				$data['id']                 = (int)$itemAPI_lv1->categoryId;
				$dataLevel1['id_kiot']         = $itemAPI_lv1->categoryId;
				$dataLevel1['ten']         = $itemAPI_lv1->categoryName;
				$dataLevel1['tenkhongdau']  = $this->changeTitle($itemAPI_lv1->categoryName);
				$dataLevel1['ngaytao'] = !empty($itemAPI_lv1->createdDate) ? strtotime($itemAPI_lv1->createdDate) : '';
				$dataLevel1['hienthi']       = '1';
				$dataLevel1['type']         = 'san-pham';
			
				$dataLevel1['stt']       = 1;
				$success                    = 1;
				$child = array();
	    		if(!empty($itemAPI_lv1->hasChild))
	    		{	    			
	    			foreach ($itemAPI_lv1->children as $j => $itemAPI_lv2)
	    			{
						$dataLevel2['id']           = (int)$itemAPI_lv2->categoryId;
						$dataLevel2['id_danhmuc']       = (int)$itemAPI_lv1->categoryId;
						$dataLevel2['ten']         = $itemAPI_lv2->categoryName;
						$dataLevel2['tenkhongdau']  = $this->changeTitle($itemAPI_lv2->categoryName);
						$dataLevel2['ngaytao'] = !empty($itemAPI_lv2->createdDate) ? strtotime($itemAPI_lv2->createdDate) : '';
						$dataLevel2['hienthi']       = '1';
						$dataLevel2['type']         = 'san-pham';
						$dataLevel2['idx']         = $dataLevel2['id'];
						
						$dataLevel2['stt']       = 1;
						$success                    = 1;
						$child[] = $dataLevel2;
	    			}
	    		}

	    		if(!empty($categoryExixst))
	    		{
	    			$this->db->where('id_kiot', $itemAPI_lv1->categoryId);
	    			$str[] = array("update","Cập nhật: ".$dataLevel1['ten']);
	    			unset($dataLevel1['stt']);
	    			if($this->db->update($this->tbl, $dataLevel1))
	    			{
	    				//$this->db->where('id_lv1', $itemAPI_lv1->categoryId);
	    				//$this->db->update($this->tbl, $dataLevel2);
	    				unset($dataLevel2['stt']);
	    				if(count($child)){
	    					foreach($child as $kx=>$vx){
	    						$row = $this->db->rawQueryOne("select id from #_product_danhmuc where id_kiot = ".$vx['id_danhmuc']);
	    						$vx['id_danhmuc'] = $row['id'];
	    						if(!count($this->db->rawQuery("select * from #_product_list where idx = ?",array($vx['id'])))){
	    							unset($vx['id']);
	    							
	    							$this->db->insert("product_list", $vx);
	    							$str[] = array("insert","Thêm: ".$vx['ten']);
	    						}else{
	    							unset($vx['stt']);
	    							$this->db->where('idx', $vx['id']);
	    							unset($vx['id']);
	    							
	    							$this->db->update("product_list", $vx);
	    							$str[] = array("update","Cập nhật: ".$vx['ten']);
	    						}
	    					}
	    					
	    				}
	    				$str[] = array("update","Cập nhật: ".$dataLevel2['ten']);

	    			}
	    		}
	    		else
	    		{
					
					if($dataLevel1['ten']){
					
						$this->db->insert($this->tbl, $dataLevel1);
						
						$str[] = array("insert","Thêm: ".$dataLevel1['ten']);

						foreach($child as $kx=>$vx){
	    						if(!count($this->db->rawQuery("select * from #_product_list where idx = ?",array($vx['id'])))){
	    							unset($vx['id']);
	    							$row = $this->db->rawQueryOne("select id from #_product_danhmuc where id_kiot = ".$vx['id_danhmuc']);
	    							$vx['id_danhmuc'] = $row['id'];
	    							$this->db->insert("product_list", $vx);
	    							$str[] = array("insert","Thêm: ".$vx['ten']);
	    						}else{
	    							unset($vx['stt']);
	    							$this->db->where('idx', $vx['id']);
	    							$this->db->update("product_list", $vx);
	    							unset($vx['id']);
	    							$str[] = array("update","Cập nhật: ".$vx['ten']);
	    						}
	    					}

						/* $this->db->insert($this->tbl, $dataLevel2);*/
					}
	    		}
	    	}
	    	return $str;
	    	$this->transfer("Cập nhật nhóm hàng thành công", $this->backLink, "success");
	    }

	    public function pushProductFromKiot($API)
	    {
	    	global $kiot, $com;
	    	if ($com == 'kiotViet_autoBackup') {
	    		@define ( 'PRODUCT_DIR' , _upload_sanpham_l);
	    	}
	    	else @define ( 'PRODUCT_DIR' , _upload_sanpham);
	    	$category = $this->db->rawQuery("select * FROM table_product_danhmuc");
	    	$attribute = $this->db->rawQuery("select * FROM table_attribute");
	    	$arrAttribute = array();
	    	foreach($attribute as $i => $issetAttribute)
	    	{
	    		$this->db->rawQuery("delete from #_attribute where id_parent=?", array($issetAttribute['id_parent']));
	    		array_push($arrAttribute, $issetAttribute['id_parent']);
	    	}


	    	$cate1 = array();
	    	$cate2 = array();
	    	foreach($this->db->rawQuery("select id,idx,id_danhmuc from #_product_list where idx > 0 ") as $k=>$v){
	    		$cate2[$v['idx']] = array("id"=>$v['id'],"cate"=>$v['id_danhmuc']);
	    	}

	    	foreach($this->db->rawQuery("select id,id_kiot from #_product_danhmuc where id_kiot > 0 ") as $k=>$v){
	    		$cate1[$v['id_kiot']] = $v['id'];
	    	}

	    	if (!empty($API))
	    	{
	    		foreach ($API as $i => $itemAPI)
	    		{
					
	    			$attributeReplace = str_replace($itemAPI->name." - ", "", $itemAPI->fullName);
					$dataProduct = array();
	    			$dataProduct['xid'] = (int)$itemAPI->id;
					
	    			$dataProduct['id_master'] = (int)$itemAPI->masterProductId;
	    		#	$dataProduct['promotion_price'] = 0;
	    		#	$dataProduct['old_price'] = 0;
					$dataProduct['id_danhmuc'] = 0;
					$dataProduct['id_list'] = 0;
					$dataProduct['qty'] = 0;
	    			$flag = false;
					
	    			

    				$dataProduct['id_danhmuc'] = @$cate1[$itemAPI->categoryId];

    				if(!$dataProduct['id_danhmuc'] && $itemAPI->categoryId){
    					$dataProduct['id_list'] = $cate2[$itemAPI->categoryId]['id'];
    					$dataProduct['id_danhmuc'] = $cate2[$itemAPI->categoryId]['cate'];
    				}
    				
    				$dataProduct['masp'] = $itemAPI->code;
    				$dataProduct['ten'] = $itemAPI->name;
    				$dataProduct['tenkhongdau'] = $this->changeTitle($itemAPI->name);
    				
    				foreach($itemAPI->inventories as $pr => $itemInventories)
	    			{
	    				$dataProduct['qty'] = (($itemInventories->onHand - $this->quantity) > 0) ? $itemInventories->onHand - $this->quantity : 0;
		    			// foreach($orders as $od => $itemOrder)
		    			// {
		    			// 	foreach($itemOrder->orderDetails as $odd => $itemOrderDetail)
		    			// 	{
		    			// 		$orderQuantity = 0;
		    			// 		if($itemOrderDetail->productId == (int)$itemAPI->id && $itemOrderDetail->productCode == $itemAPI->code)
		    			// 		{
		    			// 			$orderQuantity = $itemOrderDetail->quantity;
		    			// 		}
		    			// 	}
		    			// }
		    			// $dataProduct['qty'] = $itemInventories->onHand - 2 - $orderQuantity;
	    			}
	    			if (!empty($itemAPI->attributes))
	    			{
	    				foreach($itemAPI->attributes as $attr => $itemAttribute)
	    				{
							$dataAttribute['id_master'] = $dataProduct['id_master'];
							$dataAttribute['id_parent'] = $dataProduct['id'];
							$dataAttribute['attribute'] = $itemAttribute->attributeValue;
							$dataAttribute['name']      = $itemAttribute->attributeName;
							$dataAttribute['fullName']  = $attributeReplace;
							$dataAttribute['price']     = $itemAPI->basePrice;
							$dataAttribute['number']    = 1;
							$dataAttribute['status']    = 'display';
							$dataAttribute['type']      = 'APIAttribute';
	    					if($itemAttribute->productId == (int)$itemAPI->id)
	    					{
	    						$this->db->insert('attribute', $dataAttribute);
	    					}
	    				}
	    			}
	    			$dataProduct['gia'] = $itemAPI->basePrice;
					
	    			foreach($itemAPI->priceBooks as $pb => $itemPriceBooks)
	    			{
	    				if ($itemPriceBooks->productId == $dataProduct['id'] && $itemPriceBooks->priceBookName == 'Giá thị trường') {
	    					$dataProduct['old_price'] = $itemPriceBooks->price;
	    				}
	    				if ($itemPriceBooks->productId == $dataProduct['id'] && $itemPriceBooks->priceBookName == 'Giá khuyến mãi') {
	    					$dataProduct['promotion_price'] = $itemPriceBooks->price;
	    				}
	    			}
					
					$dataProduct['mota']     = $itemAPI->orderTemplate;
					$dataProduct['noidung']      = $itemAPI->description;
					$dataProduct['ngaytao'] = !empty($itemAPI->createdDate) ? strtotime($itemAPI->createdDate) : '';
					$dataProduct['hienthi']       = '1';
					$dataProduct['type']         = 'san-pham';
					$dataProduct['stt']       = 1;

					


					if(is_array($itemAPI->images))
					{
						foreach($itemAPI->images as $img => $itemImage)
						{


							if(filter_var($itemImage, FILTER_VALIDATE_URL) && $img == 0)
							{
								$photo_name = basename($itemImage);
								$photo_name = explode("?",$photo_name)[0];
								//$this->images_name(str_replace('https://cdn-images.kiotviet.vn/'.$this->name.'/', '', $itemImage));
								if(copy($itemImage, PRODUCT_DIR.$photo_name)) $dataProduct['photo'] = $photo_name;
								//echo '<pre>';print_r($itemAPI->images);
								//echo $photo_name."<br>";
								if(trim($dataProduct['photo'])!=''){
									$dataProduct['thumb'] = create_thumb($dataProduct['photo'], 180, 180, _upload_sanpham,$photo_name,2);
								}
							}
						}
					}
					else
					{
						$dataProduct['photo'] = '';
					}
					
				
	    			$productExixst = $this->db->rawQueryOne("select id, photo FROM table_$this->tbl WHERE xid=?", array($itemAPI->id));
	    		
	    			#check($productExixst);die;
	    			if(!empty($productExixst))
	    			{
	    				$this->delete_file('../'.PRODUCT_DIR.$productExixst['photo']);
	    				$this->db->where('id', $productExixst['id']);
	    				
	    				unset($dataProduct['stt']);
	    				$this->db->update($this->tbl, $dataProduct);
	    				$str[] = array("update","Cập nhật: ".$dataProduct['ten']);
	    			}
	    			else
	    			{
	    				$str[] = array("insert","Thêm: ".$dataProduct['ten']);
	    				$this->db->insert($this->tbl, $dataProduct);
	    			}
	    			$success = 1;
	    		}
	    	}
	    	else
	    	{
	    		$success = 0;
	    	}

	    	return $str;

	    	$success > 0 ? $this->transfer("Cập nhật sản phẩm thành công", $this->backLink, "success") : $this->transfer("Cập nhật sản phẩm thất bại", $this->backLink, "failed");
	    }

	    public function pushInvoicesFromKiot($API)
	    {
	    	dump($API);
	    }

	    function setToken($token,$type)
	    {
	    	@$_SESSION['kiot']['token']['code'] = $token;
	    	@$_SESSION['kiot']['token']['type'] = $type;
	    	@$_SESSION['kiot']['token']['time'] = time()+86400;
	    }

	    function getToken()
	    {
	    	if(!empty($_SESSION['kiot']))
	    	{
	    		if((@$_SESSION['kiot']['token']['time']) < time())
	    		{
	    			unset($_SESSION['kiot']);
	    			return false;
	    		}
	    		return $_SESSION['kiot']['token'];
	    	}
	    	return false;
	    }

	    function check_login()
	    {
	    	if(!empty($_SESSION['kiot']))
	    	{
	    		if(!$this->getToken())
	    		{
	    			$this->login();
	    		}
	    	}
	    }



	    function login()
	    {
	    	$curl = curl_init();
	    	curl_setopt_array($curl, array(
	    		CURLOPT_URL => "https://id.kiotviet.vn/connect/token",
	    		CURLOPT_RETURNTRANSFER => true,
	    		CURLOPT_ENCODING => "",
	    		CURLOPT_MAXREDIRS => 10,
	    		CURLOPT_TIMEOUT => 30,
	    		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    		CURLOPT_CUSTOMREQUEST => "POST",
	    		CURLOPT_POSTFIELDS => "client_id=".$this->client."&client_secret=".$this->secret."&grant_type=client_credentials&scopes=PublicApi.Access",
	    		CURLOPT_HTTPHEADER => array(
	    			"cache-control: no-cache",
	    			"content-type: application/x-www-form-urlencoded",
	    			"postman-token: a4ba83a9-fcc6-4522-b3ef-4035d4725e8e"
	    		),
	    	));
	    	$response = curl_exec($curl);
	    	$err = curl_error($curl);
	    	curl_close($curl);
	    	if($err)
	    	{
	    		echo ("cURL Error #:" . $err);
	    		die("ERROR");
	    		return false;
	    	}
	    	else
	    	{
	    		$rs = json_decode($response, true);
	    		$this->setToken($rs['access_token'],$rs['token_type']);
	    		return true;
	    	}
	    }

	    function init($url, $data = null, $type = "POST")
	    {
	    	$curl = curl_init();
	    	if(in_array(strtolower($type),array("post","put","delete")))
	    	{
	    		$data = json_encode($data);
	    	}
	    	else
	    	{
	    		$data = "";
	    	}
	    	$this->login();
	    	$token = $this->getToken();
	    	$xheader = array(
	    		"cache-control: no-cache",
	    		"retailer:".$this->name,
	    		"authorization:" .$token['type']." ".$token['code'] ,
	    		"content-type: application/json",
	    	);
	    	curl_setopt_array($curl, array(
	    		CURLOPT_URL => $this->kiotapi_link . $url,
	    		CURLOPT_RETURNTRANSFER => true,
	    		CURLOPT_POSTFIELDS => $data,
	    		CURLOPT_ENCODING => "",
	    		CURLOPT_MAXREDIRS => 10,
	    		CURLOPT_TIMEOUT => 30,
	    		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    		CURLOPT_CUSTOMREQUEST => $type,
	    		CURLOPT_HTTPHEADER => $xheader
	    	));
	    	$response = curl_exec($curl);
	    	$err = curl_error($curl);
	    	curl_close($curl);
	    	if($err)
	    	{
	    		echo $err.$this->kiotapi_link . $url;die;
	    		$this->login();
	    		$this->init($url,$data,$type);
	    	}
	    	else
	    	{
	    		$rs = json_decode($response);
	    		return $rs;
	    	}
	    }
	}
?>