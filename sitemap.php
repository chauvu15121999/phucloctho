<?php
session_start();
$session=session_id();
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './admin/lib/');


$lang_default = array("","en");
if(!isset($_SESSION['lang']) or !in_array($_SESSION['lang'], $lang_default))
{
	$_SESSION['lang'] = '';
}
$lang = $_SESSION['lang'];
require_once _source."lang$lang.php";
include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."functions_for.php";
include_once _lib."class.database.php";
include_once _lib."functions_user.php";
include_once _lib."functions_giohang.php";
include_once _lib."file_requick.php";

header("Content-Type: application/xml; charset=utf-8"); 
echo '<?xml version="1.0" encoding="UTF-8"?>'; 
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'; 


	
	function CreateXML1($link,$uutien=1){
		global $d,$config_url,$file_creatsite;
		echo "<url><loc>https://".$config_url."/".$link."</loc><changefreq>daily</changefreq><priority>".$uutien."</priority></url>";
		return;
	}
	function CreateXML2($tbl='',$com='',$type='',$duoi='',$uutien=1){
		global $d,$config_url,$file_creatsite;
		if($tbl=='') return false;

		$d->reset();
		$sql = "SELECT id,tenkhongdau,ngaytao FROM table_$tbl where hienthi=1 and type='".$type."' order by stt,ngaytao desc";
		$d->query($sql);
		$link_seo = $d->result_array();
		for($i=0; $i<count($link_seo); $i++){
			echo $file_creatsite, "<url><loc>https://".$config_url."/".$com."/".$link_seo[$i]["tenkhongdau"]."-".$link_seo[$i]["id"].$duoi."</loc><priority>".$uutien."</priority><lastmod>".date('Y-m-d',$link_seo[$i]['ngaytao'])."</lastmod><changefreq>daily</changefreq></url>";
		}
		return;
	}
?>

<?php
	CreateXML1("lien-he.html",'0.5');
	CreateXML1("gioi-thieu.html",'0.5');
	CreateXML1("tin-tuc.html",'0.5');
	CreateXML1("hung-vuong.html",'0.5');

	/*CreateXML1("dich-vu.html",'0.5');
	CreateXML1("tuyen-dung.html",'0.5');
	CreateXML1("khuyen-mai.html",'0.5');
	CreateXML1("du-an.html",'0.5');
	CreateXML1("cong-trinh.html",'0.5');*/

	CreateXML2("product","san-pham","san-pham",".html",'1');
	CreateXML2("product_danhmuc","san-pham","san-pham","",'0.8');
	CreateXML2("product_list","san-pham","san-pham","/",'0.8');
	CreateXML2("news","tin-tuc","tin-tuc",".html",'1');
	CreateXML2("news","bai-viet","bai-viet",".html",'1');
	CreateXML2("news","chinh-sach-mua-hang","chinh-sach-mua-hang",".html",'1');
	/*CreateXML2("news","dich-vu","dich-vu",".html",'1');*/
echo '</urlset>'; 

?>
