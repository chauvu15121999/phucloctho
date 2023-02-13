<?php
session_start();
$session=session_id();
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './admin/lib/');
include_once _lib."Mobile_Detect.php";
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
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
include_once _source."counter.php";

function get_http(){

    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
    $pageURL .= "s";
    }
    $pageURL .= "://";
    return $pageURL;

}
$http = get_http();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php 
	$id=$_GET['id'];
	
	$sql = "select mota$lang as mota from #_product where  hienthi=1 and id=$id  order by stt asc";
	$d->query($sql);
	$product1 = $d->result_array();
	

?>
<div id="AjaxPopup">
    <div id="AjaxPopupText">
	 	<span class="tool_tip" style=""><?=$product1[0]['mota']?></span>
	</div>
</div>
</body>
</html>