<?php
	class BreadCrumbs
	{
		private $d;
		private $data = array();

		function __construct()
		{
			
		}

		public function set($slug='', $name='')
		{
			if($name != '')
			{
				$this->data[] = array('slug' => $slug, 'name' => $name);
			}
		}

		public function get()
		{
			global $config_base;
			
			$json = array();
			$breadcumb = '';

			if($this->data)
			{
				$breadcumb .= '<ol class="breadcrumb">';
				
				$k = 1;
				foreach($this->data as $key => $value)
				{
					if($value['name'] != '')
					{
						$slug = ($value['slug']) ? $config_base.$value['slug'] : '';
						$name = $value['name'];
						$active = ($key == count($this->data) - 1) ? "active" : "";
						$breadcumb .= '<li class="breadcrumb-item '.$active.'"><a class="text-decoration-none" href="'.$slug.'"><span>'.$name.'</span></a></li>';
						$json[] = array("@type"=>"ListItem","position"=>$k,"name"=>$name,"item"=>$slug);
						$k++;
					}
				}
			    $breadcumb .= '</ol>';
			    $breadcumb .= '<script type="application/ld+json">{"@context": "https://schema.org","@type": "BreadcrumbList","itemListElement": '.((json_encode($json))).'}</script>';
			}

		    return $breadcumb;
		}
	}
?>