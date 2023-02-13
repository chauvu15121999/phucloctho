<?php
	session_start();
	error_reporting(0);
	$session=session_id();
	session_start();
	$session=session_id();

	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../admin/lib/');
	include_once _lib."config.php";

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
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_for.php";
	include_once _lib."class.database.php";
	include_once _lib."functions_user.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	 
	include_once "class_paging_ajax.php";
	
	if(isset($_POST["page"])){
		 
		$paging = new paging_ajax();
		$paging->class_pagination = "pagination";
		$paging->class_active = "active";
		$paging->class_inactive = "inactive";
		$paging->class_go_button = "go_button";
		$paging->class_text_total = "total";
		$paging->class_txt_goto = "txt_go_button";
		$paging->page = (int)$_POST["page"];
		$paging->per_page = 7;
		
		 
		if((int)$_POST["id_danhmuc"]>0){
			$d->reset();
			$sql="select id,thuonghieu,tenkhongdau from table_product_danhmuc where id='".(int)$_POST["id_danhmuc"]."' order by stt,id desc";
			$d->query($sql); 	 
			$danhmuc=$d->fetch_array();	
			
			$link='san-pham/'.$danhmuc['tenkhongdau'].'-'.$danhmuc['id'];
			if($danhmuc['thuonghieu']!=''){ 
				$w=" and id IN (".$danhmuc['thuonghieu'].")";
			}else{
				$w='';
			}
		}else{
			$w='';
			$link='san-pham.html';
		}
		
		$paging->text_sql = "select ten$lang as ten,tenkhongdau,id,type,photo from table_product_thuonghieu where hienthi=1 and type='san-pham' ".$w." order by stt asc";
		
		$product = $paging->GetResult();
		$message = '';
		$paging->data = "".$message."";
    } 
	
 
?>
<div class="jx_brand_pr">
<?php for($i=0;$i<count($product);$i++){	?>
    <div class="br_item">
		<a href="<?=$link?>&result=<?=$product[$i]['id']?><?php if($_POST['gia']>0){echo '&gia='.$_POST['gia'];}?><?php if($_POST['p']>0){echo '&p='.$_POST['p'];}?>"><?=$product[$i]['ten']?></a>
	</div>
<?php } ?>
</div>
<?=$paging->Load(); ?>