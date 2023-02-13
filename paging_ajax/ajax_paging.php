<?php
	include ("../ajax/ajax_config.php");
	include_once "class_paging_ajax.php";

	if(isset((int)$_POST["page"]))
    {
		$paging = new paging_ajax();

		$paging->class_pagination = "pagination";
		$paging->class_active = "active";
		$paging->class_inactive = "inactive";
		$paging->class_go_button = "go_button";
		$paging->class_text_total = "total";
		$paging->class_txt_goto = "txt_go_button";
		$paging->per_page = 4;
		$paging->page = $_POST["page"];
		$paging->text_sql = "select id,ten$lang as ten,tenkhongdau,photo,type,thumb,giakm,gia,masp,mota from table_product where hienthi=1 and id_danhmuc=".(int)$_POST["id_danhmuc"]." and noibat=1 and type='san-pham' order by stt asc";
		$product = $paging->GetResult();
		$message = '';
		$paging->data = "".$message."";
    }
?>

<?php for($i=0,$count_product=count($product);$i<$count_product;$i++){	?>
    <div class="item">
        <p class="sp_img zoom_hinh hover_sang3"><a href="<?=$product[$i]['type']?>/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten']?>">
        <img src="<?php if($product[$i]['thumb']!=NULL) echo _upload_sanpham_l.$product[$i]['thumb']; else echo 'images/noimage.png';?>" alt="<?=$product[$i]['ten']?>" /></a></p>
        <h3 class="sp_name"><a href="<?=$product[$i]['type']?>/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten']?>" ><?=$product[$i]['ten']?></a></h3>
        <p class="sp_gia">
            <span class="gia <?php if($product[$i]['giakm']>0)echo 'giacu'?>"><?php if($product[$i]['giakm']<=0)echo _gia.': '?><?php if($product[$i]['gia']>0)echo number_format($product[$i]['gia'],0, ',', '.').' vnđ';else echo _lienhe;?></span>
            <span class="giakm"><?php if($product[$i]['giakm']>0) echo number_format($product[$i]['giakm'],0, ',', '.').'  vnđ';?></span>
        </p>
    </div><!---END .item-->
<?php } ?>
<?=$paging->Load(); ?>
