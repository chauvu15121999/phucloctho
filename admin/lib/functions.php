<?php if(!defined('_lib')) die("Error");

ini_set ('memory_limit', '256M');
function check($s){
	echo '<pre>';print_r($s);
	echo '</pre>';
}
function nl2br2 ($string){
    return nl2br(str_replace('\r\n', '<br/>', $string));
}
function last_word($str){
	$pieces = explode(' ', $str);
	$last_word = array_pop($pieces);
	return $last_word;
}
function get_score($id){
	global $d,$lang;
	$d->reset();
	$sql="select id,score from #_comment where comment_type='nhanxet' and product_id=".$id." and parent_id=0 and hienthi=1 ";
	$d->query($sql);
	$items = $d->result_array();
	
	$rates=count($items);
	$score=0;
	for($i=0;$i<count($items);$i++){
		$score=$score+$items[$i]['score'];
	}
	if($score>0){
		$sao=$score/$rates;
	}else{
		$sao=0;
	}
	return $sao;
}
function get_rates($id){
	global $d,$lang;
	$d->reset();
	$sql="select count(id) as num from #_comment where comment_type='nhanxet' and product_id=".$id." and parent_id=0 and hienthi=1 ";
	$d->query($sql);
	$item = $d->fetch_array();
	return $item['num'];
}
function get_num_of_rates($id,$score){
	global $d,$lang;
	$d->reset();
	$sql="select count(id) as num from #_comment where comment_type='nhanxet' and product_id=".$id." and score=".$score." and parent_id=0 and hienthi=1 ";
	$d->query($sql);
	$item = $d->fetch_array();
	return $item['num'];
}
function get_per_rates($id,$score){
	global $d,$lang;
	 
	$total_rate=get_rates($id);
	$star_rate=get_num_of_rates($id,$score);
	
	$per=$total_rate/100;
	if($per>0){
		$per1=$star_rate/$per;
	}else{
		$per1=1;
	}
	return $per1;
}

function get_product_by($field,$id){
	global $d,$lang;
	$d->reset();
	$sql="select $field from #_product where id='$id'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row[$field];
}
function get_product_cap($dieukien,$typesp,$loaitable,$gioihan){
	global $d,$lang;
	$d->reset();
	$sql="select id,ten$lang as ten,tenkhongdau,thumb,mota$lang as mota,ngaytao,type,photo from #_product_".$loaitable." where type='".$typesp."' and hienthi=1 and ".$dieukien."=1 order by stt asc limit 0,".$gioihan;
	$d->query($sql);
	return $d->result_array();
}
function get_product($dieukien,$typesp,$gioihan){
	global $d,$lang;
	$d->reset();
	$sql="select id,ten$lang as ten,tenkhongdau,thumb,mota$lang as mota,ngaytao,type,photo,gia,giakm,masp,spmoi,sale,tieubieu,baohanh from #_product where type='".$typesp."' and hienthi=1 and ".$dieukien."=1 order by stt asc limit 0,".$gioihan;
	$d->query($sql);
	return $d->result_array();
}
function get_product_id($dieukien,$typesp,$loaiid,$iddanhmuc,$gioihan){
	global $d,$lang;
	$d->reset();
	$sql="select id,ten$lang as ten,tenkhongdau,thumb,mota$lang as mota,ngaytao,type,photo,gia,giakm,masp,congsuat,baohanh,tiente from #_product where type='".$typesp."' and ".$loaiid."=".$iddanhmuc." and hienthi=1 and ".$dieukien."=1 order by stt asc limit 0,".$gioihan;
	$d->query($sql);
	return $d->result_array();
}
function get_news($loai,$gioihan){
	global $d,$lang;
	$d->reset();
	$sql="select id,ten$lang as ten,tenkhongdau,thumb,mota$lang as mota,ngaytao,type,photo,luotxem from #_news where type='".$loai."' and hienthi=1 and noibat=1 order by stt asc limit 0,".$gioihan;
	$d->query($sql);
	return $d->result_array();
}
function get_about($loai){
	global $d,$lang;
	$d->reset();
	$sql="select ten$lang as ten,thumb,mota$lang as mota,photo from #_about where type='".$loai."' limit 0,1";
	$d->query($sql);
	return $d->fetch_array();
}
function layhinh($cot,$loai){
	global $d;	
	$d->reset();
	$sql="select ".$cot." from #_background where type='".$loai."'";
	$d->query($sql);
	$photo=$d->fetch_array();
	if($cot=='photo'||$cot=='photoen') return 'upload/hinhanh/'.$photo[$cot]; else return $photo[$cot];
}
function get_about_admin($loai){
	global $d,$lang;
	$d->reset();
	$sql="select ten$lang as ten,thumb,mota$lang as mota,noidung$lang as noidung,photo,photo2,link from #_about where type='".$loai."' limit 0,1";
	$d->query($sql);
	return $d->fetch_array();
}

function layhinh_adim($cot,$loai){
	global $d;	
	$d->reset();
	$sql="select ".$cot." from #_background where type='".$loai."'";
	$d->query($sql);
	$photo=$d->fetch_array();
	if($cot=='photo'||$cot=='photoen') return '../upload/hinhanh/'.$photo[$cot]; else return $photo[$cot];
}

function check_login(){
	global $d,$config,$login_name_admin;
	if((!isset($_SESSION[$login_name_admin]) or ($_SESSION[$login_name_admin] != true)) && $act=="login"){
		echo 'B???n kh??ng c?? quy???n truy c???p';
		die;
	}
}
function check_login_ajax(){
	global $d,$config,$login_name_admin;
	if((!isset($_SESSION[$login_name_admin]) or ($_SESSION[$login_name_admin] != true))){
		echo 'B???n kh??ng c?? quy???n truy c???p';
		die;
	}
}

function image_fix_orientation($path){
	$image = imagecreatefromjpeg($path);
	$exif = exif_read_data($path);
	if (!empty($exif['Orientation'])) {
		switch ($exif['Orientation']) {
			case 3:
				$image = imagerotate($image, 180, 0);
				break;
			case 6:
				$image = imagerotate($image, -90, 0);
				break;
			case 8:
				$image = imagerotate($image, 90, 0);
				break;
		}
		print_r($image);
		imagejpeg($image, $path);
	}
}
function encrypt_password($salt_sta,$str,$salt_end){return md5($salt_sta.$str.$salt_end);}

function format_size ($rawSize)
  {
    if ($rawSize / 1048576 > 1) return round($rawSize / 1048576, 1) . ' MB';
    else
      if ($rawSize / 1024 > 1) return round($rawSize / 1024, 1) . ' KB';
      else
        return round($rawSize, 1) . ' Bytes';
  }
function humanTiming ($time){
    $time1 = time() - $time; // to get the time since that moment
	if($time1<2592000){
	 
		$tokens = array (
			31536000 => 'n??m',
			2592000 => 'th??ng',
			604800 => 'tu???n',
			86400 => 'ng??y',
			3600 => 'gi???',
			60 => 'ph??t',
			1 => 'gi??y'
		);

		foreach ($tokens as $unit => $text) {
			if ($time1 < $unit) continue;
			$numberOfUnits = floor($time1 / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?' tr?????c ':'');
		}
	}else{
		return date('d/m/Y',$time);
	}
}
function phanquyen_menu1($com,$act,$type){
	global $d;
	$l_com = $_SESSION['login_admin']['com'];
	$nhom = $_SESSION['login_admin']['nhom'];

	$d->reset();
	$sql = "select id from #_com_quyen where id_quyen='".$nhom."' and com='".$com."' and type ='".$type."' and find_in_set('".$act."',act)>0  limit 0,1";
	$d->query($sql);
	$com_manager = $d->result_array();

	if(!empty($com_manager) or $l_com=='admin'){
		return true;
	}else{
		return false;
	}
}
function phanquyen_menu($ten,$com,$act,$type){
	global $d;
	$l_com = $_SESSION['login_admin']['com'];
	$nhom = $_SESSION['login_admin']['nhom'];

	$d->reset();
	$sql = "select id from #_com_quyen where id_quyen='".$nhom."' and com='".$com."' and type ='".$type."' and find_in_set('".$act."',act)>0  limit 0,1";
	$d->query($sql);
	$com_manager = $d->result_array();

	if(!empty($com_manager) or $l_com=='admin'){
		if($com==$_GET['com'] && $act==$_GET['act'] && $type==$_GET['type']){$add_class = 'class="this"';}
		echo  "<li ".$add_class."><a href='index.php?com=".$com."&act=".$act."&type=".$type."'>".$ten."</a></li>";
	}
}
function phanquyen($l_com,$nhom,$com,$act,$type){
	//dump($nhom);
	global $d;

	if($com=='' or $act=='login' or $act=='logout' or $l_com=='admin'){return false;}

	$d->reset();
	$sql = "select id from #_com_quyen where id_quyen='".$nhom."' and com='".$com."' and type ='".$type."' and find_in_set('".$act."',act)>0 limit 0,1";
	$d->query($sql);
	$com_manager = $d->result_array();
	
	if(empty($com_manager)){
		return true;
	}else{
		return false;
	}
}

function pagesListLimitadmin($url , $totalRows , $pageSize = 5, $offset = 5){
	if ($totalRows<=0) return "";
	$totalPages = ceil($totalRows/$pageSize);
	if ($totalPages<=1) return "";
	if( isset($_GET["p"]) == true)  $currentPage = $_GET["p"];
	else $currentPage = 1;
	settype($currentPage,"int");
	if ($currentPage <=0) $currentPage = 1;
	$firstLink = "<li><a href=\"{$url}\" class=\"left\">First</a><li>";
	$lastLink="<li><a href=\"{$url}&p={$totalPages}\" class=\"right\">End</a></li>";
	$from = $currentPage - $offset;
	$to = $currentPage + $offset;
	if ($from <=0) { $from = 1;   $to = $offset*2; }
if ($to > $totalPages) { $to = $totalPages; }
	for($j = $from; $j <= $to; $j++) {
	   if ($j == $currentPage) $links = $links . "<li><a href='#' class='active'>{$j}</a></li>";
	   else{
		$qt = $url. "&p={$j}";
		$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";
	   }
	} //for
	return '<ul class="pages">'.$firstLink.$links.$lastLink.'</ul>';
}
function pagesListLimitadmin2z($url , $totalRows , $pageSize = 5, $offset = 5){
	if ($totalRows<=0) return "";
	$totalPages = ceil($totalRows/$pageSize);
	if ($totalPages<=1) return "";
	if( isset($_GET["p2"]) == true)  $currentPage = $_GET["p2"];
	else $currentPage = 1;
	settype($currentPage,"int");
	if ($currentPage <=0) $currentPage = 1;
	$firstLink = "<li><a href=\"{$url}\" class=\"left\">First</a><li>";
	$lastLink="<li><a href=\"{$url}&p2={$totalPages}\" class=\"right\">End</a></li>";
	$from = $currentPage - $offset;
	$to = $currentPage + $offset;
	if ($from <=0) { $from = 1;   $to = $offset*2; }
if ($to > $totalPages) { $to = $totalPages; }
	for($j = $from; $j <= $to; $j++) {
	   if ($j == $currentPage) $links = $links . "<li><a href='#' class='active'>{$j}</a></li>";
	   else{
		$qt = $url. "&p2={$j}";
		$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";
	   }
	} //for
	return '<ul class="pages">'.$firstLink.$links.$lastLink.'</ul>';
}

function magic_quote($str, $id_connect=false)
{
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		return $str;
	}
	if (is_numeric($str)) {
		return $str;
	}
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}
	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return mysql_real_escape_string($str, $id_connect);
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return mysql_escape_string($str);
	}
	else
	{
		return addslashes($str);
	}
}
function ytb($url){
	preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
	check($matches);

}
//Get code youtube
function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if($qs['vi']){
            return $qs['vi'];
        }
    }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return false;
}
function getRealIPAddress(){
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		//check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		//to check ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
function images_name($tenhinh)
	{
		$rand=rand(10,9999);
		$ten_anh=explode(".",$tenhinh);
		$result = changeTitle($ten_anh[0])."-".$rand;
		return $result;
	}
function escape_str($str, $id_connect=false)
{
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}

		return $str;
	}

	if (is_numeric($str)) {
		return $str;
	}

	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return "'".mysql_real_escape_string($str, $id_connect)."'";
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return "'".mysql_escape_string($str)."'";
	}
	else
	{
		return "'".addslashes($str)."'";
	}
}

// dem so nguoi online
function count_online(){

	global $d;
	$time = 600; // 10 phut
	$ssid = session_id();

	// xoa het han
	$sql = "delete from #_online where time<".(time()-$time);
	$d->query($sql);
	//
	$sql = "select id,session_id from #_online order by id desc";
	$d->query($sql);
	$result['dangxem'] = $d->num_rows();
	$rows = $d->result_array();
	$i = 0;
	while(($rows[$i]['session_id'] != $ssid) && $i++<$result['dangxem']);

	if($i<$result['dangxem']){
		$sql = "update #_online set time='".time()."' where session_id='".$ssid."'";
		$d->query($sql);
		$result['daxem'] = $rows[0]['id'];
	}
	else{
		$sql = "insert into #_online (session_id, time) values ('".$ssid."', '".time()."')";
		$d->query($sql);
		$result['daxem'] = mysql_insert_id();
		$result['dangxem']++;
	}

	return $result; // array('dangxem'=>'', 'daxem'=>'')
}

//L???y ng??y
function make_date($time,$dot='.',$lang='vi',$f=false){

	$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
	if($f){
		$thu['vi'] = array('Ch??? nh???t','Th??? hai','Th??? ba','Th??? t??','Th??? n??m','Th??? s??u','Th??? b???y');
		$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$str = $thu[$lang][date('w',$time)].', '.$str;
	}
	return $str;
}

//Alert
function alert($s){
	echo '<script language="javascript"> alert("'.$s.'") </script>';
}

function delete_file($file){
		return @unlink($file);
}

//Upload file
function upload_image($file, $extension, $folder, $newname=''){
	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){

		$ext = end(explode('.',$_FILES[$file]['name']));
		$name = basename($_FILES[$file]['name'], '.'.$ext);

		if($name!='sitemap')
		{
			$name=changeTitleImage($name).'-'.rand(999,999999);
		}
		$newname = $name.'.'.$ext;

		if(strpos($extension, $ext)===false){
			alert('Ch??? h??? tr??? upload file d???ng '.$extension);
			return false; // kh??ng h??? tr???
		}


		if($newname=='' or file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else
		{
			$_FILES[$file]['name'] = $newname;
		}

		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))				        {
				return false;
			}
		}
		return $_FILES[$file]['name'];
	}
	return false;
}
function upload_photos($file, $extension, $folder, $newname=''){
	if(isset($file) && !$file['error']){

		$ext = end(explode('.',$file['name']));
		$name = basename($file['name'], '.'.$ext);
		//alert('Ch??? h??? tr??? upload file d???ng '.$ext);
		if(strpos($extension, $ext)===false){
			alert('Ch??? h??? tr??? upload file d???ng '.$ext.'-////-'.$extension);
			return false; // kh??ng h??? tr???
		}

		if($newname=='' && file_exists($folder.$file['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$file['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else{
			$file['name'] = $newname.'.'.$ext;
		}

		if (!copy($file["tmp_name"], $folder.$file['name']))	{
			if ( !move_uploaded_file($file["tmp_name"], $folder.$file['name']))	{
				return false;
			}
		}
		return $file['name'];
	}
	return false;
}
//T???o h??nh kh??c
function thumb_image($file, $width, $height, $folder){

	if(!file_exists($folder.$file))	return false; // kh??ng t??m th???y file

	if ($cursize = getimagesize ($folder.$file)) {
		$newsize = setWidthHeight($cursize[0], $cursize[1], $width, $height);
		$info = pathinfo($file);

		$dst = imagecreatetruecolor ($newsize[0],$newsize[1]);

		$types = array('jpg' => array('imagecreatefromjpeg', 'imagejpeg'),
					'gif' => array('imagecreatefromgif', 'imagegif'),
					'png' => array('imagecreatefrompng', 'imagepng'));
		$func = $types[$info['extension']][0];
		$src = $func($folder.$file);
		imagecopyresampled($dst, $src, 0, 0, 0, 0,$newsize[0], $newsize[1],$cursize[0], $cursize[1]);
		$func = $types[$info['extension']][1];
		$new_file = str_replace('.'.$info['extension'],'_thumb.'.$info['extension'],$file);

		return $func($dst, $folder.$new_file) ? $new_file : false;
	}
}


function setWidthHeight($width, $height, $maxWidth, $maxHeight){
	$ret = array($width, $height);
	$ratio = $width / $height;
	if ($width > $maxWidth || $height > $maxHeight) {
		$ret[0] = $maxWidth;
		$ret[1] = $ret[0] / $ratio;
		if ($ret[1] > $maxHeight) {
			$ret[1] = $maxHeight;
			$ret[0] = $ret[1] * $ratio;
		}
	}
	return $ret;
}

//Chuy???n trang c?? th??ng b??o
function transfer($msg,$page="index.php")
{
	 $showtext = $msg;
	 $page_transfer = $page;
	 include("./templates/transfer_tpl.php");
	 exit();
}
//Chuy???n trang kh??ng th??ng b??o
function redirect($url=''){
	echo '<script language="javascript">window.location = "'.$url.'" </script>';
	exit();
}
//Quay l???i trang tr?????c
function back($n=1){
	echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
	exit();
}
//Thay th??? k?? t??? ?????c bi???t
function chuanhoa($s){
	$s = str_replace("'", '&#039;', $s);
	$s = str_replace('"', '&quot;', $s);
	$s = str_replace('<', '&lt;', $s);
	$s = str_replace('>', '&gt;', $s);
	return $s;
}


function themdau($s){
	$s = addslashes($s);
	return $s;
}

function bodau($s){
	$s = stripslashes($s);
	return $s;
}
//Show m???ng
function dump($arr, $exit=1){
	echo "<pre>";
		var_dump($arr);
	echo "<pre>";
	if($exit)	exit();
}
//Ph??n trang
	function paging($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;

		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";

		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;

		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];

		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";
			for($i=1;$i<=$totalPages;$i++)
			{
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.=" <span>".$i."</span> ";//dang xem
					}
					else
					{
						$paging1 .= " <a href='".$url."&curPage=".$i."'  class=\"{$class_paging}\">".$i."</a> ";
					}
					$end=$i;
				}
			}//tinh paging
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau

				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .=" <a href='".$url."&curPage=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
			#}
			$paging.=$paging1;
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <a href='".$url."&curPage=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke

				$paging .=" <a href='".$url."&curPage=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi
			#}
		}
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;

		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";

		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;

		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];

		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";
			for($i=1;$i<=$totalPages;$i++)
			{
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.=" <span>".$i."</span> ";//dang xem
					}
					else
					{
						$paging1 .= " <a href='".$url."&p=".$i."'  class=\"{$class_paging}\">".$i."</a> ";
					}
					$end=$i;
				}
			}//tinh paging
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau

				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
			#}
			$paging.=$paging1;
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke

				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi
			#}
		}
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;
		$r3['total']=$totalRows;
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}


//Ph??n trang n???m gi???a
function paging_giua($r, $url='', $curPg=1, $mxR=5, $maxP=5, $class_paging='')
    {
        if($curPg<1) $curPg=1;
        if($mxR<1) $mxR=5;
        if($maxP<1) $maxP=5;
        $totalRows=count($r);
        if($totalRows==0)
            return array('source'=>NULL, 'paging'=>NULL);
        $totalPages=ceil($totalRows/$mxR);

        if($curPg > $totalPages) $curPg=$totalPages;

        $_SESSION['maxRow']=$mxR;
        $_SESSION['curPage']=$curPg;

        $r2=array();
        $paging="";

        //-------------tao array------------------
        $start=($curPg-1)*$mxR;
        $end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
        #echo $start;
        #echo $end;

        $j=0;
        for($i=$start;$i<$end;$i++)
            $r2[$j++]=$r[$i];

        if($totalRows>$mxR){
        //-------------tao chuoi------------------
        $from = $curPg - 2;
        $to = $curPg + 2;
        if($curPg <= $totalPages && $curPg >= $totalPages-1){$from = $totalPages - 4;}
        if ($from <=0) { $from = 1;   $to = 5; }
        if ($to > $totalPages) { $to = $totalPages; }
        for($j = $from; $j <= $to; $j++) {
           if ($j == $curPg){
               $paging1.=" <span>".$j."</span> ";
           }
           else{
            $paging1 .= " <a class='paging transitionAll' href='".$url."&p=".$j."'>".$j."</a> ";
           }
        } //for
        $paging .=" <a href='".$url."' >&laquo;</a> "; //ve dau

                #$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
                $paging .=" <a href='".$url."&p=".($curPg-1)."' >&#8249;</a> "; //ve truoc
            #}
            $paging.=$paging1;
            #if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)
            #{
                #$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
                $paging .=" <a href='".$url."&p=".($curPg+1)."' >&#8250;</a> "; //ke

                $paging .=" <a href='".$url."&p=".($totalPages)."' >&raquo;</a> "; //ve cuoi
        }
        $r3['curPage']=$curPg;
        $r3['source']=$r2;
        $r3['paging']=$paging;
        $r3['total']=$totalRows;
        #echo '<pre>';var_dump($r3);echo '</pre>';
        return $r3;
    }


//C???t chu???i
function catchuoi($chuoi,$gioihan){
// n???u ????? d??i chu???i nh??? h??n hay b???ng v??? tr?? c???t
// th?? kh??ng thay ?????i chu???i ban ?????u
if(strlen($chuoi)<=$gioihan)
{
return $chuoi;
}
else{
/*
so s??nh v??? tr?? c???t
v???i k?? t??? kho???ng tr???ng ?????u ti??n trong chu???i ban ?????u t??nh t??? v??? tr?? c???t
n???u v??? tr?? kho???ng tr???ng l???n h??n
th?? c???t chu???i t???i v??? tr?? kho???ng tr???ng ????
*/
if(strpos($chuoi," ",$gioihan) > $gioihan){
$new_gioihan=strpos($chuoi," ",$gioihan);
$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
return $new_chuoi;
}
// tr?????ng h???p c??n l???i kh??ng ???nh h?????ng t???i k???t qu???
$new_chuoi = substr($chuoi,0,$gioihan)."...";
return $new_chuoi;
}
}

function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
     'A'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
     'd'=>'??',
     'D'=>'??',
     'e'=>'??|??|???|???|???|??|???|???|???|???|???',
   	  'E'=>'??|??|???|???|???|??|???|???|???|???|???',
   	  'i'=>'??|??|???|??|???',
   	  'I'=>'??|??|???|??|???',
     'o'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
   	  'O'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
     'u'=>'??|??|???|??|???|??|???|???|???|???|???',
   	  'U'=>'??|??|???|??|???|??|???|???|???|???|???',
     'y'=>'??|???|???|???|???',
     'Y'=>'??|???|???|???|???'
   );
   foreach($unicode as $khongdau=>$codau) {
     	$arr=explode("|",$codau);
   	  $str = str_replace($arr,$khongdau,$str);
   }
return $str;
}// Doi tu co dau => khong dau

function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str);
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}
function changeTitleImage($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}
function getCurrentPageURL_CANO(){
	$pageURL = 'http';
	if($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}else{
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = str_replace("amp/", "", $pageURL);
	$pageURL = explode("&p=", $pageURL);
	$pageURL = explode("&result=", $pageURL[0]);
	$pageURL = explode("&gia=", $pageURL[0]);
	$pageURL = explode("?", $pageURL[0]);
	$pageURL = explode("#", $pageURL[0]);
	$pageURL = explode("index", $pageURL[0]);
	return $pageURL[0];
}

//L???y d?????ng d???n hi???n t???i
function getCurrentPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
	$pageURL = explode("&p=", $pageURL);
    return $pageURL[0];
}

function getCurrentPageURL2() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
	$pageURL = explode("&p2=", $pageURL);
    return $pageURL[0];
}

//T???o h??nh ???nh kahcs
function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){


		$ext = end(explode('.',$file_name));
		$name = basename($file_name, '.'.$ext);
		$name=changeTitleImage($name);
		$file_name = $name.'.'.$ext;

// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?

$new_width   = $width;
$new_height   = $height;

 if ($new_width && !$new_height) {
        $new_height = floor ($height * ($new_width / $width));
    } else if ($new_height && !$new_width) {
        $new_width = floor ($width * ($new_height / $height));
    }

$image_url = $folder.$file;
$origin_x = 0;
$origin_y = 0;
// GET ORIGINAL IMAGE DIMENSIONS
$array = getimagesize($image_url);
if ($array)
{
    list($image_w, $image_h) = $array;
}
else
{
     die("NO IMAGE $image_url");
}
$width=$image_w;
$height=$image_h;

// ACQUIRE THE ORIGINAL IMAGE
$image_ext = trim(strtolower(end(explode('.', $image_url))));
switch(strtoupper($image_ext))
{
     case 'JPG' :
     case 'JPEG' :
         $image = imagecreatefromjpeg($image_url);
		 $func='imagejpeg';
         break;
     case 'PNG' :
         $image = imagecreatefrompng($image_url);
		 $func='imagepng';
         break;
	 case 'GIF' :
	 	 $image = imagecreatefromgif($image_url);
		 $func='imagegif';
		 break;

     default : die("UNKNOWN IMAGE TYPE: $image_url");
}

// scale down and add borders
	if ($zoom_crop == 3) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {
			$new_width = $width * ($new_height / $height);
		} else {
			$new_height = $final_height;
		}

	}

	// create a new true color image
	$canvas = imagecreatetruecolor ($new_width, $new_height);
	imagealphablending ($canvas, false);

	// Create a new transparent color for image
	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);

	// Completely fill the background of the new image with allocated color.
	imagefill ($canvas, 0, 0, $color);

	// scale down and add borders
	if ($zoom_crop == 2) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {

			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round ($origin_x - ($new_width / 2));

		} else {

			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round ($origin_y - ($new_height / 2));

		}

	}

	// Restore transparency blending
	imagesavealpha ($canvas, true);

	if ($zoom_crop > 0) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source
		if ($cmp_x > $cmp_y) {

			$src_w = round ($width / $cmp_x * $cmp_y);
			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

		} else if ($cmp_y > $cmp_x) {

			$src_h = round ($height / $cmp_y * $cmp_x);
			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

		}

		// positional cropping!
		if ($align) {
			if (strpos ($align, 't') !== false) {
				$src_y = 0;
			}
			if (strpos ($align, 'b') !== false) {
				$src_y = $height - $src_h;
			}
			if (strpos ($align, 'l') !== false) {
				$src_x = 0;
			}
			if (strpos ($align, 'r') !== false) {
				$src_x = $width - $src_w;
			}
		}

		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

    } else {

        // copy and resize part of an image with resampling
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    }

$ext = end(explode('.',$file_name));
$file_name = basename($file_name, '.'.$ext);
$new_file=$file_name.rand(999,999999).'_'.round($new_width).'x'.round($new_height).'.'.$image_ext;
// SHOW THE NEW THUMB IMAGE
if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);
else $func($canvas, $folder.$new_file,floor ($quality * 0.09));

return $new_file;
}

//L???y chu???i ng???u nhi??n
function ChuoiNgauNhien($sokytu){
$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
for ($i=0; $i < $sokytu; $i++){
	$vitri = mt_rand( 0 ,strlen($chuoi) );
	$giatri= $giatri . substr($chuoi,$vitri,1 );
}
return $giatri;
}

function pagination_ajax($query,$per_page=10,$page=1,$url='?'){
	global $d;
	$sql = "select count(*) as `num` from {$query}";
	$d->query($sql);
	$row = $d->fetch_array();
	$total = $row['num'];
	$adjacents = "2";
	$firstlabel = "&lsaquo;&lsaquo;";
	$prevlabel = "&lsaquo;";
	$nextlabel = "&rsaquo;";
	$lastlabel = "&rsaquo;&rsaquo;";
	$page = ($page == 0 ? 1 : $page);
	$start = ($page - 1) * $per_page;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total/$per_page);
	$lpm1 = $lastpage - 1;
	$pagination = "";
	if($lastpage > 1){
		$pagination .= "<div class='pagination clearfix'>";
		$pagination .= "<ul class='pages clearfix'>";
		//$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
		if ($page > 1) $pagination.= "<li><a data-page='{$prev}' href='{$url}&page={$prev}'>{$prevlabel}</a></li> <li><a data-page='{$prev}' href='{$url}&page={$prev}'>{$prevlabel}</a></li>";
		if ($lastpage < 7 + ($adjacents * 2)){
			for ($counter = 1; $counter <= $lastpage; $counter++){
				if ($counter == $page)
					$pagination.= "<li><a class='active'>{$counter}</a></li>";
				else
					$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
			}
		} elseif($lastpage > 5 + ($adjacents * 2)){
			if($page < 1 + ($adjacents * 2)) {
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
					if ($counter == $page)
						$pagination.= "<li><a class='active'>{$counter}</a></li>";
					else
						$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
				$pagination.= "<li class='dot'>...</li>";
				$pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
				$pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";
			} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
				$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
				$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
				$pagination.= "<li class='dot'>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
					if ($counter == $page)
						$pagination.= "<li><a class='active'>{$counter}</a></li>";
					else
						$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
				$pagination.= "<li class='dot'>..</li>";
				$pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
				$pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";
			} else {
				$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
				$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
				$pagination.= "<li class='dot'>..</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination.= "<li><a class='active'>{$counter}</a></li>";
					else
						$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
			}
		}
		if ($page < $counter - 1) {
			$pagination.= "<li><a data-page='{$next}' href='{$url}&page={$next}'>{$nextlabel}</a></li>";
			$pagination.= "<li><a data-page='{$lastpage}' href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";
		}
		$pagination.= "</ul>";
		$pagination.= "</div>";
	}
	return $pagination;
}
function pagination_ajax1($query,$per_page=10,$page=1,$url='?'){
	global $d;
	$sql = "select count(*) as `num` from {$query}";
	$d->query($sql);
	$row = $d->fetch_array();
	$total = $row['num'];
	$adjacents = "2";
	$prevlabel = "&lsaquo;";
	$nextlabel = "&rsaquo;";
	$lastlabel = "&rsaquo;&rsaquo;";
	$page = ($page == 0 ? 1 : $page);
	$start = ($page - 1) * $per_page;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total/$per_page);
	$lpm1 = $lastpage - 1;
	$pagination = "";
	if($lastpage > 1){
		$pagination .= "<div class='pagination clearfix'>";
		$pagination .= "<ul class='pages clearfix'>";
		$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
		if ($page > 1) $pagination.= "<li><a data-page='{$prev}' href='{$url}&page={$prev}'>{$prevlabel}</a></li>";
		if ($lastpage < 7 + ($adjacents * 2)){
			for ($counter = 1; $counter <= $lastpage; $counter++){
				if ($counter == $page)
					$pagination.= "<li><a class='current'>{$counter}</a></li>";
				else
					$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
			}
		} elseif($lastpage > 5 + ($adjacents * 2)){
			if($page < 1 + ($adjacents * 2)) {
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
					if ($counter == $page)
						$pagination.= "<li><a class='current'>{$counter}</a></li>";
					else
						$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
				$pagination.= "<li class='dot'>...</li>";
				$pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
				$pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";
			} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
				$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
				$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
				$pagination.= "<li class='dot'>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
					if ($counter == $page)
						$pagination.= "<li><a class='current'>{$counter}</a></li>";
					else
						$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
				$pagination.= "<li class='dot'>..</li>";
				$pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
				$pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";
			} else {
				$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
				$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
				$pagination.= "<li class='dot'>..</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination.= "<li><a class='current'>{$counter}</a></li>";
					else
						$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
			}
		}
		if ($page < $counter - 1) {
			$pagination.= "<li><a data-page='{$next}' href='{$url}&page={$next}'>{$nextlabel}</a></li>";
			$pagination.= "<li><a data-page='{$lastpage}' href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";
		}
		$pagination.= "</ul>";
		$pagination.= "</div>";
	}
	return $pagination;
}
/*
function yahoo($nick_yahoo='nina',$icon='1'){

	$link = '<a href="ymsgr:sendIM?"'.$nick_yahoo.'"><img src="http://opi.yahoo.com/online?u="'.$nick_yahoo.'"&amp;m=g&amp;t="'.$icon.'""></a>';
	return $link;
}

function check_yahoo($nick_yahoo='nina'){
	$file = @fopen("http://opi.yahoo.com/online?u=".$nick_yahoo."&m=t&t=1","r");
	$read = @fread($file,200);

	if($read==false || strstr($read,"00"))
		$img = '<img src="../images/yahoo_offline.png" />';
	else
		$img = '<img src="../images/yahoo_online.png" />';
	return '<a href="ymsgr:sendIM?'.$nick_yahoo.'">'.$img.'</a>';
}

function skype($nick_skype='nina',$icon='1'){

	$link = '<a href="skype:"'.$nick_skype.'"?call><img src="http://mystatus.skype.com/bigclassic/"'.$nick_skype.'""></a>';
	return $link;
}

function check_skype($nick_skype='nina'){
	if(strlen(@file_get_contents("http://mystatus.skype.com/bigclassic/".$nick_skype))>2000)
	$img = '<img src="../images/skype_online.png" />';
	else
		$img = '<img src="../images/skype_offline.png" />';
	return '<a href="skype:'.$nick_skype.'?call">'.$img.'</a>';
}


function doc3so($so)
{
    $achu = array ( " kh??ng "," m???t "," hai "," ba "," b???n "," n??m "," s??u "," b???y "," t??m "," ch??n " );
    $aso = array ( "0","1","2","3","4","5","6","7","8","9" );
    $kq = "";
    $tram = floor($so/100); // H??ng tr??m
    $chuc = floor(($so/10)%10); // H??ng ch???c
    $donvi = floor(($so%10)); // H??ng ????n v???
    if($tram==0 && $chuc==0 && $donvi==0) $kq = "";
    if($tram!=0)
    {
        $kq .= $achu[$tram] . " tr??m ";
        if (($chuc == 0) && ($donvi != 0)) $kq .= " l??? ";
    }
    if (($chuc != 0) && ($chuc != 1))
    {
            $kq .= $achu[$chuc] . " m????i";
            if (($chuc == 0) && ($donvi != 0)) $kq .= " linh ";
    }
    if ($chuc == 1) $kq .= " m?????i ";
    switch ($donvi)
    {
        case 1:
            if (($chuc != 0) && ($chuc != 1))
            {
                $kq .= " m???t ";
            }
            else
            {
                $kq .= $achu[$donvi];
            }
            break;
        case 5:
            if ($chuc == 0)
            {
                $kq .= $achu[$donvi];
            }
            else
            {
                $kq .= " n??m ";
            }
            break;
        default:
            if ($donvi != 0)
            {
                   $kq .= $achu[$donvi];
            }
            break;
    }
    if($kq=="")
    $kq=0;
    return $kq;
}
function doctien($number)
{
$donvi=" ?????ng ";
$tiente=array("nganty" => " ngh??n t??? ","ty" => " t??? ","trieu" => " tri???u ","ngan" =>" ngh??n ","tram" => " tr??m ");
$num_f=$nombre_format_francais = number_format($number, 2, ',', ' ');
$vitri=strpos($num_f,',');
$num_cut=substr($num_f,0,$vitri);
$mang=explode(" ",$num_cut);
$sophantu=count($mang);
switch($sophantu)
{
    case '5':
            $nganty=doc3so($mang[0]);
            $text=$nganty;
            $ty=doc3so($mang[1]);
            $trieu=doc3so($mang[2]);
            $ngan=doc3so($mang[3]);
            $tram=doc3so($mang[4]);
            if((int)$mang[1]!=0)
            {
                $text.=$tiente['ngan'];
                $text.=$ty.$tiente['ty'];
            }
            else
            {
                $text.=$tiente['nganty'];
            }
            if((int)$mang[2]!=0)
                $text.=$trieu.$tiente['trieu'];
            if((int)$mang[3]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[4]!=0)
                $text.=$tram;
            $text.=$donvi;
            return  $text;


    break;
    case '4':
            $ty=doc3so($mang[0]);
            $text=$ty.$tiente['ty'];
            $trieu=doc3so($mang[1]);
            $ngan=doc3so($mang[2]);
            $tram=doc3so($mang[3]);
            if((int)$mang[1]!=0)
                $text.=$trieu.$tiente['trieu'];
            if((int)$mang[2]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[3]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;


    break;
    case '3':
            $trieu=doc3so($mang[0]);
            $text=$trieu.$tiente['trieu'];
            $ngan=doc3so($mang[1]);
            $tram=doc3so($mang[2]);
            if((int)$mang[1]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[2]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;
    break;
    case '2':
            $ngan=doc3so($mang[0]);
            $text=$ngan.$tiente['ngan'];
            $tram=doc3so($mang[1]);
            if((int)$mang[1]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;

    break;
    case '1':
            $tram=doc3so($mang[0]);
            $text=$tram.$donvi;
            return $text;

    break;
    default:
        echo "Xin l???i s??? qu?? l???n kh??ng th??? ?????i ???????c";
    break;
}
}

function doc_so($so)
{
    $so = preg_replace("([a-zA-Z{!@#$%^&*()_+<>?,.}]*)","",$so);
    if (strlen($so) <= 21)
    {
        $kq = "";
        $c = 0;
        $d = 0;
        $tien = array ( "", " ngh??n", " tri???u", " t???", " ngh??n t???", " tri???u t???", " t??? t???" );
        for ($i = 0; $i < strlen($so); $i++)
        {
            if ($so[$i] == "0")
                $d++;
            else break;
        }
        $so = substr($so,$d);
        for ($i = strlen($so); $i > 0; $i-=3)
        {
            $a[$c] = substr($so, $i, 3);
            $so = substr($so, 0, $i);
            $c++;
        }
        $a[$c] = $so;
        for ($i = count($a); $i > 0; $i--)
        {
            if (strlen(trim($a[$i])) != 0)
            {
                if (doc3so($a[$i]) != "")
                {
                    if (($tien[$i-1]==""))
                    {
                        if (count($a) > 2)
                            $kq .= " kh??ng tr??m l??? ".doc3so($a[$i]).$tien[$i-1];
                        else $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                    else if ((trim(doc3so($a[$i])) == "m?????i") && ($tien[$i-1]==""))
                    {
                        if (count($a) > 2)
                            $kq .= " kh??ng tr??m ".doc3so($a[$i]).$tien[$i-1];
                        else $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                    else
                    {
                    $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                }
            }
        }
        return $kq;
    }
    else
    {
        return "S??? qu?? l???n!";
    }
}

function send_face($link){
	global $d,$messger,$company;
	require_once _lib.'facebook_php_sdk/facebook.php';
		$facebook = new Facebook(array(
		   'appId' => "209039099832913",
		   'secret' => "49bb953ad9a69e4c02fd2b102b8b378b",
		));
		//============================================
			$id_page="150370142303464";
			$token="EAACZBHrVKKlEBAHZCuAWY08jQ6ZCNvvrzXgVca2ZBEHmRWDqLqMPuaHcOhZB9kfeZBG37z7ADdsiZBh5UnKcDHeqRBOjEJn5kQH5YwG33mjloOvMiaatIwEmE9qjTOQjb6X4fFJ6ZC9o5seQML90EesrgKyP5J11qXUa6hzDe43xgiuq2Yk5r0CcHqpZBReZA8khgZD";
		//============================================
			try{
				$api = $facebook->api($id_page .'/feed', 'POST', array(
					access_token => $token,
					link => $link,
					message => '',//tieu de status
				 ));
				$messger=1;
			}catch(Exception $e){
				$messger=0;
				echo $e->getMessage();
			}
		echo ($messger);
		die;
}
*/
?>
