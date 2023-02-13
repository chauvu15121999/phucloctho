<?php
	session_start();
	$session=session_id();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../admin/lib/');
	
	if(!isset($_SESSION['lang']))
	{
		$_SESSION['lang']='';
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
	
	$id = (int) $_GET['id'];
	$d->reset();
	$sql = "select id,ten,mota FROM #_product where id=".$id." limit 0,1";
	$d->query($sql);
	$row_detail = $d->fetch_array();
?>
<!doctype html>
<html lang="vi">

<head itemscope itemtype="http://schema.org/WebSite">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$row_detail['ten']?></title>
</head>
<body>

    <div id="AjaxPopup">
        <div id="AjaxPopupText">
            <p class="ten"><?=$row_detail['ten']?></p>        
            <div style="padding:10px;"><?=$row_detail['mota']?></div>
        <div class="clear"></div>
      </div>
    </div>

</body>
</html>