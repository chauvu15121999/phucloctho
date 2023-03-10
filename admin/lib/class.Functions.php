<?php 
	class Functions
	{
		public function __construct($d){
            $this->db = $d;
        }
        public function isAjax()
        {
        	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'));
        }
        public function encode($str)
        {
        	return htmlspecialchars($str);
        }
        public function decode($str)
        {
        	return htmlspecialchars_decode($str);
        }
        public function isGoogleSpeed()
        {
        	if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false)
        	{
        		return false;
        	}
        	return true;
        }
        public function joinAttr($array, $attr)
        {
        	if($array)
        	{
        		foreach ($array as $array => $array_item)
        		{
        			@$arr_attr[] = $array_item[$attr];
        		}
        		return join(",", $arr_attr);
        	}
        }
        public function findInSet($str, $column)
        {
        	$array = explode(',', $str);
        	if($array)
        	{
        		$sql = '';
        		foreach ($array as $array => $array_item)
        		{
        			$sql .= 'FIND_IN_SET("'.$array_item.'", status) and ';
        		}
        		$sql = rtrim($sql, 'and ');
        		return $sql;
        	}
        }
        public function get_photo($data)
        {
			@$dir      = $data['dir'];
			@$photo    = $data['photo'];
			@$resize   = $data['resize'];
			@$name     = $data['name'];
			@$CACHE    = (strpos($resize, 'watermark') == false) ? CACHE : "";
			@$path     = $CACHE.$resize.'/'.$dir.$photo;
			$arrResize = getimagesize($path);
			@$result   = "<img src=".$path." width=".$arrResize[0]." height=".$arrResize[1]." onerror=src='".ASSETS."images/noimage.png' alt='".$name."' title='".$name."'>";
			// @$result = "<img class='lazy' onerror=src='".ASSETS."images/noimage.png' src=".$path." alt='".$name."' title='".$name."'>";
			return $result;
        }
        public function get_photoSelect($type, $resize, $link=false)
        {
        	$photo = $this->db->rawQueryOne("select photo, status, link FROM table_photo WHERE type=?", array($type));
        	if(strpos($photo['status'], 'display') !== false)
        	{
				@$href   = $photo['link'];
				@$path   = CACHE.$resize.'/'.UPLOAD_PHOTO_L.$photo['photo'];
				@$result = ($link==true) ? "<a class=".$type." href=".$href."><img onerror=src='".ASSETS."images/noimage.png' src='".$path."' alt='".$photo['name']."' title='".$photo['name']."'></a>" : $path;
				return $result;
        	}
        }
        public function checkHTTP($http, $arrayDomainSSL, &$HTTP, $URL)
		{
			if(count($arrayDomainSSL) == 0 && $http == 'https://') $HTTP = 'http://'.$URL;
		}
		public function replace_number($val)
		{
			$result = preg_replace('/[^0-9]/','',$val);
			return $result;
		}
		public function lang($lang)
		{
			$result = ($lang == '') ? "lang/vi/" : "lang/".$lang."/";
			return $result;
		}
		public function money($val, $unit=true)
		{
			$unit = ($unit == true) ? " ??" : "";
			return number_format($val,0, ',', '.').$unit;
		}
		public function price($newPrice="", $oldPrice="", $promotionPrice="")
		{
			$result = "";
			$percentPrice = ($promotionPrice > 0) ? $promotionPrice : $newPrice;

			if($percentPrice > 0) $result .= '<p class="new-price px-2 py-1">'.$this->money($percentPrice).'</p>';
			else $result .= '<p class="new-price px-2 py-1">'._lienhe.'</p>';
			if($oldPrice > 0) $result .= '<p class="old-price px-2 py-1"><span>Gi?? th??? tr?????ng</span> '.$this->money($oldPrice).'</p>';
			return $result;
		}
		public function productPrice($data)
		{
			if ($data['qty'] == 0) {
				$product = $this->db->rawQuery("select * from #_product where id=? or id_master=? order by id, id_master asc", array($data['id'], $data['id']));
				foreach ($product as $i => $productItems) {
					if ($productItems['qty'] > 0) {
						$attributeExist = $this->db->rawQueryOne("select * from #_attribute where id_parent=?", array($productItems['id']));
						break;
					}
				}
				$price = $attributeExist['price'];
			}
			else
			{
				$price = $data['price'];
			}
			$result = $this->price($price, $data['old_price'], $data['promotion_price']);
			return $result;
		}
		public function priceDiscount($newPrice="", $oldPrice="", $promotionPrice="")
		{
			$result = "";
			$percentPrice = ($promotionPrice > 0) ? $promotionPrice : $newPrice;

			$percent = 100 - (($percentPrice * 100) / $oldPrice);
			$saving = $this->money($oldPrice - $percentPrice);
			$result .= '
				<div class="priceDiscount d-flex">
					<p class="percentPrice px-2 py-1">-'.(int)$percent.'% Gi???m</p>
					<p class="savingPrice px-2 py-1">Ti???t ki???m: '.$saving.'</p>
				</div>
			';
			return $result;
		}
		public function get_place($tbl, $id)
		{
			$place = $this->db->rawQueryOne("select id, name from $tbl where id=? and FIND_IN_SET('display', status)", array($id));
			return $place['name'];
		}
		public function down_line($val)
		{
			$result = nl2br($val);
			return $result;
		}
		public function product_seen($id)
		{
			if(!in_array($id, $_SESSION['product-seen'])) $_SESSION['product-seen'][count($_SESSION['product-seen'])]=$id;
		}
		public function random($count)
		{
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$size = strlen( $chars );
			$result = "";
			for($i=0; $i < $count; $i++ ) {
				$result .= $chars[rand( 0, $size - 1 )];
			}
			return $result;
		}
		public function getYoutubeIdFromUrl($url)
		{
			$parts = parse_url($url);
			if(isset($parts['query'])){
				parse_str($parts['query'], $qs);
				if(isset($qs['v'])) return $qs['v'];
				else if($qs['vi']) return $qs['vi'];
			}
			if(isset($parts['path'])){
				$path = explode('/', trim($parts['path'], '/'));
				return $path[count($path)-1];
			}
			return false;
		}
		public function changeTitle($str){
			$str = strtolower($this->utf8convert($str));
			$str = preg_replace("/[^a-z0-9-\s]/", "",$str);
			$str = preg_replace('/([\s]+)/', '-',$str);
			$str = str_replace(array('%20', ' '), '-',$str);
			$str = preg_replace("/\-\-\-\-\-/","-",$str);
			$str = preg_replace("/\-\-\-\-/","-",$str);
			$str = preg_replace("/\-\-\-/","-",$str);
			$str = preg_replace("/\-\-/","-",$str);
			$str = '@'.$str.'@';
			$str = preg_replace('/\@\-|\-\@|\@/', '', $str);
			return $str;
		}
		public function images_name($image)
		{
			@$rand = rand(1000,9999);
			@$arr_image = explode(".", $image);
			@$type_image = @$arr_image[1];
			@$result = @$this->changeTitle($arr_image[0])."-".$rand.".".$type_image;
			return $result; 
		}
		public function delete_file($file)
		{
			return @unlink($file);
		}
		public function upload_image($file, $extension, $folder, $newname='')
		{
			if(isset($_FILES[$file]) && !$_FILES[$file]['error'])
			{
				$ext = explode('.', $_FILES[$file]['name']);
				$ext = $ext[count($ext)-1];
				$name = basename($_FILES[$file]['name']);

				if(strpos($extension, $ext)===false)
				{
					alert('Ch??? h??? tr??? upload file d???ng '.$extension);
					return false;
				}

				if($newname=='' && file_exists($folder.$_FILES[$file]['name'])) for($i=0; $i<100; $i++) {
					if(!file_exists($folder.$name.$i)){
						$_FILES[$file]['name'] = $name.$i;
						break;
					}
				}
				else
				{
					$_FILES[$file]['name'] = $newname;
				}

				if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	
				{
					if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	
					{
						return false;
					}
				}
				return $_FILES[$file]['name'];
			}
			return false;
		}
		public function encrypt_password($salt, $password)
		{
			global $config;
			return md5($salt.$password);
		}
		public function getCurrentPageURL()
		{
			$pageURL = 'http';
			if(array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";
			$pageURL .= "://";
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			$urlpos = strpos($pageURL, "?p");
			$pageURL = ($urlpos) ? explode("?p=", $pageURL) : explode("&p=", $pageURL);
			return $pageURL[0];
		}
		public function paging($totalRows, $pageSize, $offset = 5)
		{
			global $source;
			$ext = (strpos($this->getCurrentPageURL(), "?")) ? "&" : "?";
			$url = $this->getCurrentPageURL().$ext;
			$links = "";

			if($totalRows<=0) return "";
			$totalPages = ceil($totalRows/$pageSize);
			if($totalPages<=1) return "";		
			if(isset($_GET["p"]) == true) $currentPage = $_GET["p"];
			else $currentPage = 1;
			settype($currentPage,"int");	
			if ($currentPage <=0) $currentPage = 1;	
			$firstLink = "<li class='first'><a href=".$url.">First</a></li>";
			$lastLink = "<li class='end'><a href=".$url.'p='.$totalPages.">End</a></li>";
			$from = $currentPage - $offset;
			$to = $currentPage + $offset;
			if($from <= 0)
			{
				$from = 1;
				$to = $offset*2;
			}
			if($to > $totalPages) $to = $totalPages;
			for($i = $from; $i <= $to; $i++)
			{
				if($i == $currentPage) $links = $links."<li><a href='javascript:void(0)' class='active'>{$i}</a></li>";
				else
				{				
					$qt = $url."p={$i}";
					$links = $links."<li><a href = '{$qt}'>{$i}</a></li>";
				} 	   
			}
			$result = '<ul>'.$firstLink.$links.$lastLink.'</ul>';
			return $result;
		}
		public function myEncrypt($val)
		{
			return sha1(md5($val));
		}
		public function transfer($val, $page, $icon)
		{
			global $com;
			echo $val;
			die;
			include_once LIB."transfer.php";
			exit();
		}	
		private function utf8convert($str) {
			if(!$str) return false;
			$utf8 = array(
				'a'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
				'd'=>'??|??',
				'e'=>'??|??|???|???|???|??|???|???|???|???|???|??|??|???|???|???|??|???|???|???|???|???',
				'i'=>'??|??|???|??|???|??|??|???|??|???',
				'o'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
				'u'=>'??|??|???|??|???|??|???|???|???|???|???|??|??|???|??|???|??|???|???|???|???|???',
				'y'=>'??|???|???|???|???|??|???|???|???|???',
				''=>'`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\???|\???|\:|\;|_',
			);
			foreach($utf8 as $ascii=>$uni)
				$str = preg_replace("/($uni)/i",$ascii,$str);
			return $str;
		}
		public function formNewsletter($data)
		{
			global $d, $func, $mailer;
			include_once TEMPLATE."form/form_newsletter.php";
		}
		public function formContact($data)
		{
			global $d, $func, $mailer;
			include_once TEMPLATE."form/form_contact.php";
		}
		public function formOrder($data)
		{
			global $d, $func, $funcCart, $mailer, $lang;
			include_once TEMPLATE."form/form_order.php";
		}
		public function ShowMultiMenu($tbl, $type, $level, $photo=false, $count=false, $menu_mobile=false)
		{
			global $lang, $level_category, $custom_product;
			$where = " and FIND_IN_SET('display', status) and type='$type'";
			$order_by = "order by number, id desc";
			$menu = $this->db->rawQuery("select id, name$lang as name, tenkhongdau from #_$tbl where id<>0 $where $order_by");
			$menu_lv1 = $this->db->rawQuery("select id, name$lang as name, tenkhongdau, photo from #_category where level=1 $where $order_by");
			$menu_lv2 = $this->db->rawQuery("select id, id_lv1, name$lang as name, tenkhongdau, photo from #_category where level=2 and FIND_IN_SET(id_lv1, '".$this->joinAttr($menu_lv1, 'id')."') $where $order_by");
			$menu_lv3 = $this->db->rawQuery("select id, id_lv1, id_lv2, name$lang as name, tenkhongdau, photo from #_category where level=3 and FIND_IN_SET(id_lv2, '".$this->joinAttr($menu_lv2, 'id')."') $where $order_by");

			$result = '';
			if($menu_mobile == false) $result .= '<ul>';
				if($level == 0)
				{
					foreach($menu as $i => $item) {
						$result .= '<li>';
						$result .= '<a href='.$item['tenkhongdau'].'>'.$item['name'].'</a>';
						$result .= '</li>';
					}
				}
				else
				{
					foreach($menu_lv1 as $i => $item) {
						$result .= '<li>';
						if (!empty($photo))
						{
							if (!empty($level_category['product'][2])) {
								$countLevel2=0; foreach ($level_category['product'][2] as $lv2 => $level2Items) {
									if ($level2Items['id_lv1'] == $item['id']) {
										$countLevel2++;
									}
								}
							}
							$hasAwesome = (!empty($countLevel2)) ? 'position-relative hasAwesome' : '';
							$result .= '<a class="'.$hasAwesome.'" href='.$item['tenkhongdau'].'>';
							if (!empty($item['photo']))
							{
								$result .= $this->get_photo(array('dir' => UPLOAD_PRODUCT_L,'photo' => $item['photo'],'name' => $item['name'],'resize' => '22x22x2',));
							}
							$result .= '<span class="ml-2">'.$item['name'].'</span>';
							$result .= '</a>';
						}
						else
						{
							$result .= '<a href='.$item['tenkhongdau'].'>'.$item['name'].'</a>';
						}
						
						if($level >= 2)
						{
							$result .= '<ul>';
							foreach($menu_lv2 as $j => $item2) {
								if ($item2['id_lv1'] == $item['id']) {
									if (!empty($custom_product['product'])) {
										$countProduct=0; foreach ($custom_product['product'] as $pro => $item_product) {
											if ($item_product['id_lv2'] == $item2['id']) {
												$countProduct++;
											}
										}
									}
									if($count == true) $resultCount = ' ('.$countProduct.')';
									else $resultCount = '';
									$result .= '<li>';
									$result .= '<a href='.$item2['tenkhongdau'].'>'.$item2['name'].$resultCount.'</a>';
									if($level >= 3)
									{
										$result .= '<ul>';
										foreach($menu_lv3 as $k => $item3) {
											if ($item3['id_lv2'] == $item2['id']) {
												$result .= '<li>';
												$result .= '<a href='.$item3['tenkhongdau'].'>'.$item3['name'].'</a>';
												$result .= '</li>';
											}
										}
										$result .= '</ul>';
									}
									$result .= '</li>';
								}
							}
							$result .= '</ul>';
						}
						$result .= '</li>';
					}
				}
			if($menu_mobile == false) $result .= '</ul>';
			return $result;
		}
		/* Delete folder */
		public function removeDir($dirname='')
		{
			if(is_dir($dirname)) $dir_handle = opendir($dirname);
			if(!isset($dir_handle) || $dir_handle == false) return false;
			while($file = readdir($dir_handle))
			{
				if($file != "." && $file != "..")
				{
					if(!is_dir($dirname."/".$file)) unlink($dirname."/".$file);
					else $this->removeDir($dirname.'/'.$file);
				}
			}
			closedir($dir_handle);
			rmdir($dirname);
			return true;
		}

		/* Remove Sub folder */
		public function RemoveEmptySubFolders($path='')
		{
			$empty = true;

			foreach(glob($path.DIRECTORY_SEPARATOR."*") as $file)
			{
				if(is_dir($file))
				{
					if(!$this->RemoveEmptySubFolders($file)) $empty = false;
				}
				else
				{
					$empty = false;
				}
			}

			if($empty)
			{
				if(is_dir($path))
				{
					rmdir($path);
				}
			}

			return $empty;
		}
		
		/* Remove files from dir in x seconds */
		public function RemoveFilesFromDirInXSeconds($dir='', $seconds=3600)
		{
			$files = glob(rtrim($dir, '/')."/*");
			$now = time();

			if($files)
			{
				foreach($files as $file)
				{
					if(is_file($file))
					{
						if($now - filemtime($file) >= $seconds)
						{
							unlink($file);
						}
					}
					else
					{
						$this->RemoveFilesFromDirInXSeconds($file,$seconds);
					}
				}
			}
		}
	}

	function CreateXML_Com($com, $priority=1)
	{
		global $config_url_http;
		$result = "";
		$result .= "<url>"; 
		$result .= "<loc>".$config_url_http.$com."</loc>"; 
		$result .= "<changefreq>daily</changefreq>";
		$result .= "<lastmod>".date('c',time())."</lastmod>";
		$result .= "<priority>".$priority."</priority>";
		$result .= "</url>";
		echo $result;
	}

	function CreateXML($tbl, $type, $level, $priority=1)
	{
		global $d, $config_url_http;
		$result = "";
		$sitemap = $d->rawQuery("select tenkhongdau FROM #_".$tbl." where type='".$type."'");
		for($i=0; $i < count($sitemap); $i++)
		{
			$result .= "<url>";
			$result .= "<loc>".$config_url_http.$sitemap[$i]['tenkhongdau']."</loc>";
			$result .= "<changefreq>daily</changefreq>";
			$result .= "<lastmod>".date('c',time())."</lastmod>";
			$result .= "<priority>".$priority."</priority>";
			$result .= "</url>";
		}
		if($level > 0)
		{
			$tbl = 'category';
			for($i=0; $i < $level; $i++)
			{
				$sitemap = $d->rawQuery("select tenkhongdau, date_created FROM #_".$tbl." where type='".$type."' and level='".($i+1)."'");
				for($j=0; $j < count($sitemap); $j++)
				{
					$result .= "<url>";
					$result .= "<loc>".$config_url_http.$sitemap[$j]['tenkhongdau']."</loc>";
					$result .= "<changefreq>daily</changefreq>";
					$result .= "<lastmod>".date('c',$sitemap[$i]["date_created"])."</lastmod>";
					$result .= "<priority>".$priority."</priority>";
					$result .= "</url>";
				}
			}
		}
		echo $result;
	}	
	class myData
    { 
        public function setUsernameDefault($usernameDefault)
        {
            $this->usernameDefault = $usernameDefault;
        }
        public function setPasswordDefault($passwordDefault)
        {
            $this->passwordDefault = $passwordDefault;
        }
        public function setUsername($username)
        {
            $this->Username = $username;
        }
        public function setPassword($password)
        {
            $this->password = $password;
        }        
        public function setPermission($permission)
        {
            $this->permission = $permission;
        }
    }
    class Dashboard extends myData
    {
        public function getUsernameDefault()
        {
            return $this->usernameDefault;
        }
        public function getPasswordDefault()
        {
            return $this->passwordDefault;
        }
        public function getUsername()
        {
            return $this->Username;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function getPermission()
        {
            return $this->permission;
        }
    }
