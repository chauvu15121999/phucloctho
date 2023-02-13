<?php
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './admin/lib/');
$lang_default = array("","en");
if(!isset($_SESSION['lang']) or !in_array($_SESSION['lang'], $lang_default))
{
	$_SESSION['lang'] = '';
}
$lang = '';
require_once _source."lang$lang.php";
include_once _lib."config.php";
$config['arrayDomainSSL']=array("hungvuongcoltd.com");
include_once _lib."checkSSL.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";

$d = new database($config['database']);
$d->reset();
$sql_company = "select *,ten$lang as ten,diachi$lang as diachi,slogan$lang as slogan from #_company limit 0,1";
$d->query($sql_company);
$company= $d->fetch_array();

function get_http(){

	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	return $pageURL;

}  
$http = 'https://';
function replace_str($str){
	//$str = htmlentities($str, ENT_QUOTES, "UTF-8");
	$str = str_replace("'", '&#039;', $str);
	$str = str_replace('"', '&quot;', $str);
	$str = str_replace('&', '&amp;', $str);
	$str = str_replace('<', '', $str);
	$str = str_replace('>', '', $str);
	//$str = addslashes($str);
	return $str;
}		
header("Content-Type: application/xml; charset=utf-8"); 	
echo '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">'; 
echo '<channel>'; 

echo '<title>'.replace_str($company['title']).'</title>'; 
echo '<link>'.$http.$config_url.'/</link>';
echo '<description>'.replace_str($company['description']).'</description>'; 

function urlElement($title, $url, $description, $url_img, $price,$currency, $id) {
	echo '<item>'; 
	echo '<title>'.str_replace("&" , "và", replace_str($title)).'</title>'; 
	echo '<link>'.$url.'</link>'; 
	echo '<description>'.str_replace("&" , "và", replace_str($description)).'</description>'; 
	echo '<g:image_link>'.$url_img.'</g:image_link>';
	echo '<g:price>'.$price.' '.$currency.'</g:price>'; 
	echo '<g:condition>new</g:condition>'; 
	echo '<g:availability>in stock</g:availability>'; 
	echo '<g:id>'.str_replace("&" , "và", replace_str($id)).'</g:id>'; 
	echo '</item>';
} 
function XMLproduct($type=''){
	global $d,$config_url,$http;
	$d->reset();
	$sql = "SELECT id,tenkhongdau,photo,ten$lang as ten,description,gia,masp,type,tiente FROM table_product where google_shop>0 and type='".$type."' and hienthi=1 order by id desc";
	$d->query($sql);
	$link_xml = $d->result_array();
	foreach ($link_xml as $key => $v) { 
		if($v['tiente']==2){
			$currency='USD';
		}else{
			$currency='VND';
		}	
	
		urlElement($v['ten'] , $http.$config_url.'/'.$v['type'].'/'.$v['tenkhongdau'].'-'.$v['id'].'.html' , $v['description'] , $http.$config_url.'/'._upload_sanpham_l.$v['photo'] , $v['gia'],$currency, $v['masp'] );
	}
	return;	
}

XMLproduct("san-pham");

echo '</channel></rss>'; 

?>
