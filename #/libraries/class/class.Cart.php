<?php
	class Cart
	{
		private $d;

		function __construct($d)
		{
			$this->d = $d;
		}

		public function get_product_info($pid=0, $mau=0)
		{
			$row = null;
			$row_mau = null;
			if($pid)
			{
				$row = $this->d->rawQueryOne("select * from #_product where id = ? limit 0,1",array($pid));

				if(!empty($row) && $mau)
				{
					
			
			
					$row_mau = $this->d->rawQueryOne("select photo from #_gallery where id_photo = ? and id_mau = ? limit 0,1",array($pid, $mau));

					if(!empty($row_mau))
					{
						$row['photo'] = $row_mau['photo'];
					}
				}
			}
			return $row;
		}

		public function get_product_price($pid=0, $size=0)
		{
			$row = null;
			$result = array('gia' => 0, 'giamoi' => 0, 'giakm' => 0);
			if($pid && $size)
			{
				$row = $this->d->rawQueryOne("select gia, giamoi, giakm from #_product_price where id_size = ? and id_product = ? limit 0,1",array($size, $pid));

				if(!empty($row))
				{
					$result = $row;
				}
			}
			return $result;
		}
		
		public function get_product_mau($mau=0)
		{
			$str = '';
			if($mau)
			{
				$row = $this->d->rawQueryOne("select tenvi from #_product_mau where id = ? limit 0,1",array($mau));
				$str = $row['tenvi'];
			}
			return $str;
		}
		
		public function get_product_size($size=0)
		{
			$str = '';
			if($size)
			{
				$row = $this->d->rawQueryOne("select tenvi from #_product_size where id = ? limit 0,1",array($size));
				$str = $row['tenvi'];
			}
			return $str;
		}
		
		public function remove_product($code='')
		{
			if(!empty($_SESSION['cart']) && $code != '')
			{
				$max = count($_SESSION['cart']);

				for($i=0;$i<$max;$i++)
				{
					if($code == $_SESSION['cart'][$i]['code'])
					{
						unset($_SESSION['cart'][$i]);
						break;
					}
				}

				$_SESSION['cart'] = array_values($_SESSION['cart']);
			}
		}
		
		public function get_order_total()
		{
			$sum = 0;

			if(!empty($_SESSION['cart']))
			{
				$max = count($_SESSION['cart']);

				for($i=0;$i<$max;$i++)
				{
					$pid = $_SESSION['cart'][$i]['productid'];
					$q = $_SESSION['cart'][$i]['qty'];
					$size = ($_SESSION['cart'][$i]['size'])?$_SESSION['cart'][$i]['size']:0;
					$size_price = $this->get_product_price($pid, $size);

					if($size_price['giamoi']) $price = $size_price['giamoi'];
					else $price = $size_price['gia'];
					$sum += ($price * $q);
				}
			}

			return $sum;
		}
		
		public function addtocart($q=1, $pid=0, $mau=0, $size=0)
		{
			if($pid<1 or $q<1) return;
			
			$code = md5($pid.$mau.$size);

			if(!empty($_SESSION['cart']))
			{
				if(!$this->product_exists($code,$q))
				{
					$max = count($_SESSION['cart']);
					$_SESSION['cart'][$max]['productid'] = $pid;
					$_SESSION['cart'][$max]['qty'] = $q;
					$_SESSION['cart'][$max]['mau'] = $mau;
					$_SESSION['cart'][$max]['size'] = $size;
					$_SESSION['cart'][$max]['code'] = $code;
				}
			}
			else
			{
				$_SESSION['cart'] = array();
				$_SESSION['cart'][0]['productid'] = $pid;
				$_SESSION['cart'][0]['qty'] = $q;
				$_SESSION['cart'][0]['mau'] = $mau;
				$_SESSION['cart'][0]['size'] = $size;
				$_SESSION['cart'][0]['code'] = $code;
			}
		}
		
		private function product_exists($code='', $q=1)
		{
			$flag = 0;
			
			if(!empty($_SESSION['cart']) && $code != '')
			{
				$q = ($q>1)?$q:1;
				$max = count($_SESSION['cart']);

				for($i=0;$i<$max;$i++)
				{
					if($code == $_SESSION['cart'][$i]['code'])
					{
						$_SESSION['cart'][$i]['qty'] += $q;
						$flag = 1;
					}
				}
			}

			return $flag;
		}
	}
?>