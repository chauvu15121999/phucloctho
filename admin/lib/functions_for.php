<?php if(!defined('_lib')) die("Error");

	function get_result($sql){
		global $d,$lang,$str;
		$d->reset();
		$d->query($sql);
		return $d->result_array();
	}
	function get_fetch($sql){
		global $d,$lang,$str;
		$d->reset();
		$d->query($sql);
		return $d->fetch_array();
	}
	function for1($table,$com,$type,$duoi='.html'){
		global $d,$lang,$str;

		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau,type from #_$table where hienthi=1 and type='$type' order by stt,id desc";
		$d->query($sql);
		$baiviet = $d->result_array();

		$str='';
		$str.='<ul>';
		for($i=0;$i<count($baiviet);$i++){
			$str.='<li><a href="'.$com.'/'.$baiviet[$i]["tenkhongdau"].'-'.$baiviet[$i]["id"].$duoi.'">'.$baiviet[$i]["ten"].'</a>';
		}
		$str.='</ul>';
		return $str;
	}
	
	function for4cap($table1,$table2,$table3,$table4,$com,$type,$duoi1='',$duoi2='/',$duoi3='',$duoi4=''){
		global $d,$lang,$str,$iddm;
	
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau from #_$table1 where hienthi=1 and type='$type' order by stt,id desc";
		$d->query($sql);
		$danhmuc_cap1 = $d->result_array();
		
		$str='';
		//$str.='<ul>';
		for($i=0;$i<count($danhmuc_cap1);$i++){
				if($danhmuc_cap1[$i]["id"]==$iddm) $act_mn = 'class="active"';else $act_mn = '';
				$str.='<li class="mn-mbi"><a '.$act_mn.' href="'.$com.'/'.$danhmuc_cap1[$i]["tenkhongdau"].'-'.$danhmuc_cap1[$i]["id"].$duoi1.'">'.$danhmuc_cap1[$i]["ten"].'</a>';
				
				$d->reset();
				$sql="select id,ten$lang as ten,tenkhongdau from #_$table2 where hienthi=1 and type='$type' and id_danhmuc='".$danhmuc_cap1[$i]["id"]."' order by stt,id asc";
				$d->query($sql);
				$danhmuc_cap2=$d->result_array();
				if(count($danhmuc_cap2)>0){
					$str.='<ul>';
						for($j=0;$j<count($danhmuc_cap2);$j++){
							$str.='<li><a href="'.$com.'/'.$danhmuc_cap2[$j]["tenkhongdau"].'-'.$danhmuc_cap2[$j]["id"].$duoi2.'">'.$danhmuc_cap2[$j]["ten"].'</a>';
								$d->reset();
								$sql="select id,ten$lang as ten,tenkhongdau from #_$table3 where hienthi=1 and type='$type' and id_list='".$danhmuc_cap2[$j]["id"]."' order by stt,id asc";
								$d->query($sql);
								$danhmuc_cap3=$d->result_array();
								if(count($danhmuc_cap3)>0){
									$str.='<ul>';
										for($k=0;$k<count($danhmuc_cap3);$k++){
											
											$d->reset();
											$sql="select id,ten$lang as ten,tenkhongdau from #_$table4 where hienthi=1 and type='$type' and id_cat='".$danhmuc_cap3[$k]["id"]."' order by stt,id asc";
											$d->query($sql);
											$danhmuc_cap4=$d->result_array();
											
											$str.='<li><a href="'.$com.'/'.$danhmuc_cap3[$k]["tenkhongdau"].'/'.$danhmuc_cap3[$k]["id"].$duoi3.'">'.$danhmuc_cap3[$k]["ten"].'</a>';
											if(count($danhmuc_cap4)>0){
												$str.='<ul>';
													for($h=0;$h<count($danhmuc_cap4);$h++){
														
														$str.='<li><a href="'.$com.'/'.$danhmuc_cap4[$h]["tenkhongdau"].'/'.$danhmuc_cap4[$h]["id"].$duoi4.'">'.$danhmuc_cap4[$h]["ten"].'</a>';
														
													}
												$str.='</ul>';
											}											
										}
									$str.='</ul>';
								}
							$str.='</li>';				
						}
					$str.='</ul>';
				}
				$str.='</li>';
		}
		//$str.='</ul>';		
		return $str;
	}

	function tinh_phantram($gia,$giakm){
		global $d,$str;
		$str = 0;
		if($gia>0 and $giakm>0)
		{
			$str = round(100-($giakm/$gia*100));
		}
		return $str;
	}

	function tinh_giamgia($gia,$phantram){
		global $d,$str;
		$str = 0;
		if($gia>0 and $phantram>0)
		{
			$str = round($gia-($gia*$phantram/100));
		}
		return $str;
	}

	function lay_link($type){
		global $d,$lang,$str;

		$str = "";
		$d->reset();
		$sql = "select link from #_background where type='".$type."' limit 0,1";
		$d->query($sql);
		$row_banner = $d->fetch_array();

		$str .= $row_banner['link'];
		return $str;
	}

	function lay_banner($type){
		global $d,$lang,$str;

		$str = "";
		$d->reset();
		$sql = "select photo$lang as photo from #_background where type='".$type."' limit 0,1";
		$d->query($sql);
		$row_banner = $d->fetch_array();

		$str .= _upload_hinhanh_l.$row_banner['photo'];
		return $str;
	}


	function lay_doitac($type,$class='',$width=0,$height=0,$zc=2){
		global $d,$lang,$str,$str_thumb;
		$str_thumb = "";
		$str = "";
		if($width>0 and $height >0){
			$str_thumb = 'thumb/'.$width.'x'.$height.'/'.$zc.'/';
		}
		$d->reset();
		$sql = "select ten$lang as ten,link,photo from #_slider where hienthi=1 and type='".$type."' order by stt,id desc";
		$d->query($sql);
		$slider=$d->result_array();
		if(!count($slider))
			return '';
		foreach($slider as $k => $v){
		 
			if($v['link']!=''){
				$str .= '<li><a href="'.$v['link'].'"><img class="lazy" src="'.$str_thumb._upload_hinhanh_l.$v['photo'].'" alt="'.$v['ten'].'" /></a></li>';}
			else{
				$str .= '<li><a><img class="lazy" src="'.$str_thumb._upload_hinhanh_l.$v['photo'].'" alt="'.$v['ten'].'" /></a></li>';}
			 
		}
		$str .= '<li><a> </a></li>';
		return $str;
	}
	function lay_slider($type,$class='',$width=0,$height=0,$zc=2){
		global $d,$lang,$str,$str_thumb;
		$str_thumb = "";
		$str = "";
		if($width>0 and $height >0){
			$str_thumb = 'thumb/'.$width.'x'.$height.'/'.$zc.'/';
		}
		$d->reset();
		$sql = "select ten$lang as ten,link,photo from #_slider where hienthi=1 and type='".$type."' order by stt,id desc";
		$d->query($sql);
		$slider=$d->result_array();

		foreach($slider as $k => $v){
			if($class!='') $str .= '<div class="'.$class.'">';
			if($v['link']!=''){
				$str .= '<a href="'.$v['link'].'"><img class="lazy"  data-src="'.$str_thumb._upload_hinhanh_l.$v['photo'].'" alt="'.$v['ten'].'" /></a>';}
			else{
				$str .= '<img class="lazy" data-src="'.$str_thumb._upload_hinhanh_l.$v['photo'].'" alt="'.$v['ten'].'" />';}
			if($class!='') $str .= '</div>';
		}
		return $str;
	}

	function lay_sanpham($product,$class,$width=0,$height=0,$zc=2){
		global $d,$str,$str_thumb,$lang;

		if($width>0 and $height >0){
			$str_thumb = 'thumb/'.$width.'x'.$height.'/'.$zc.'/';
		}
		$str_thumb = "";
		$str = "";

		foreach($product as $k => $v){
			$str .= '<div class="'.$class.'">';
				$giacu = "";$giakm = "";$gia = "";
				if($v['giakm']>0) {
					$giacu = 'giacu';$giakm = number_format($v['giakm'],0, ',', '.') .' vnđ';}
				else {$gia = _gia.': ';}

				$str .= '<p class="sp_img zoom_hinh hover_sang3"><a href="'.$v['type'].'/'.$v['tenkhongdau'].'-'.$v['id'].'.html"><img class="lazy" data-src="'.$str_thumb._upload_sanpham_l.$v['thumb'].'" alt="'.$v['ten'].'" /></a></p>';
				$str .= '<h3 class="sp_name"><a href="'.$v['type'].'/'.$v['tenkhongdau'].'-'.$v['id'].'.html">'.$v['ten'].'</a></h3>';
				$str .= '<p class="sp_gia"><span class="gia '.$giacu.'">'.$gia.number_format($v['gia'],0, ',', '.').' vnđ</span><span class="giakm">'.$giakm.'</span></p>';
			$str .= '</div>';
		}
		return $str;
	}

	function lay_tintuc($type,$class='',$mota=0,$ngaytao=0,$width=0,$height=0,$zc=2){
		global $d,$str,$str_thumb,$lang;
		$str = "";
		$str_thumb = "";
		if($width>0 and $height >0){
			$str_thumb = 'thumb/'.$width.'x'.$height.'/'.$zc.'/';
		}
		
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau,type,photo,thumb,ngaytao,mota$lang as mota from #_news where hienthi=1 and type='".$type."' and noibat=1 order by stt,id desc limit 10";
		$d->query($sql);
		$tintuc=$d->result_array();

		foreach($tintuc as $k => $v){
			$str .= '<div class="'.$class.'">';
				$str .= '<p class="img_news hover_sang1"><a href="'.$v['type'].'/'.$v['tenkhongdau'].'-'.$v['id'].'.html"><img class="lazy"  data-src="'.$str_thumb._upload_tintuc_l.$v['thumb'].'" alt="'.$v['ten'].'" /></a></p>';
				$str .= '<h4 class="name_news"><a href="'.$v['type'].'/'.$v['tenkhongdau'].'-'.$v['id'].'.html">'.catchuoi($v['ten'],60).'</a></h4>';
				if($ngaytao==1){
					$str .= '<p class="ngaytao">'.make_date($v['ngaytao']).'</p>';
				}
				if($mota==1){
					$str .= '<p class="mota">'.catchuoi($v['mota'],70).'</p>';
				}
			$str .= '</div>';
		}
		return $str;
	}

	function lay_text($type){
		global $d,$lang,$str;

		$str = "";
		$d->reset();
		$sql = "select noidung$lang as noidung from #_about where type='".$type."' limit 0,1";
		$d->query($sql);
		$row_text = $d->fetch_array();

		$str = $row_text['noidung'];
		return $str;
	}

	function lay_mxh($type,$width='',$height='',$zc=2){
		global $d,$lang,$str,$str_thumb;

		$str = "";
		$str_thumb = "";

		if($width>0 and $height >0){
			$str_thumb = 'thumb/'.$width.'x'.$height.'/'.$zc.'/';
		}
		
		$d->reset();
		$sql = "select ten$lang as ten,link,photo from #_lkweb where hienthi=1 and type='".$type."' order by stt,id desc";
		$d->query($sql);
		$lkweb=$d->result_array();

		foreach($lkweb as $k => $v){
			$str .= '<a href="'.$v['link'].'" target="_blank"><img class="lazy" data-src="'.$str_thumb._upload_khac_l.$v['photo'].'" alt="'.$v['ten'].'" /></a>';

		}
		return $str;
	}

	function lay_fanpage($link,$width=235,$height=140){
		global $d,$lang,$str;

		$str = '';
		$str = '<div class="fb-page" data-height="'.$height.'" data-width="'.$width.'" data-href="'.$link.'" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"></div></div>';
		return $str;
	}
?>
