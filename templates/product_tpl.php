<?php
	if($id_dm>0){
		$d->reset();
		$sql="select id,thuonghieu from table_product_danhmuc where id='".$id_dm."' order by stt,id desc";
		$d->query($sql); 	 
		$danhmuc=$d->fetch_array();	
		
		if($danhmuc['thuonghieu']!=''){ 
			$w=" and id IN (".$danhmuc['thuonghieu'].")";
		}else{
			$w='';
		}
	}else{
		$w='';
	}
	

	$d->reset();
	$sql="select ten$lang as ten,tenkhongdau,id,type,photo from #_product_thuonghieu where hienthi=1 and type='san-pham' $w order by stt,id desc";
	$d->query($sql);
	$product_br=$d->result_array();
 
	$d->reset();
	$sql="select  ten,link from #_lkweb where type='lkweb' order by stt,id asc";
	$d->query($sql);
	$lkweb=$d->result_array();
	
	if($_GET['result']!=''){
		$d->reset();
	$sql="select ten$lang as ten from #_product_thuonghieu where hienthi=1 and type='san-pham' and id=".(int)$_GET['result']." order by stt,id desc";
	$d->query($sql);
	$detail_br=$d->fetch_array();
	}
?>
<?php /*<div class="box_topsp">
	<div class="title_slick clearfix">
		<span class="lf-title_slick">Top sản phẩm</span>
		<div class="change_slick">
			<span data-id="spmoi" class="check_acti">Sản phẩm mới</span>
			<span data-id="sale">Sản phẩm khuyến mãi</span>
			<span data-id="spbanchay">Sản phẩm bán chạy</span>
		</div>
	</div>
	<div class="load_slick_sp"></div>
</div>*/?>
<div class="tieude_giua"><div><?=$title_cat?> <?php if($_GET['result']!=''){ echo ' | '.$detail_br['ten'];}?></div></div>

<?php /*
<div class="box-thuonghieu">
	<div class="box-thuonghieu-cnt">
		<div class="slider-thuonghieu-d">
			<div class="bx_ww_content_ls load_page_ls_<?=(int)$id_dm?>" data-rel="<?=(int)$id_dm?>"></div>
			<div id="get_list"></div>
			<?php /*<div class="slider-thuonghieu">
				<?php for($i=0;$i<count($product_br);$i++){?>
				<div>
					<div class="br_item">
						<a href="<?=getCurrentPageURL_CANO()?>&result=<?=$product_br[$i]['id']?><?php if($_GET['gia']!=''){echo '&gia='.$_GET['gia'];}?><?php if($_GET['p']!=''){echo '&p='.$_GET['p'];}?>"><?=$product_br[$i]['ten']?></a>
					</div>
				</div>
				<?php }?>
			</div>*//*?>
		</div>
		<div class="mobile-thuonghieu">
			<div class="over-thuonghieu">
				<?php for($i=0;$i<count($product_br);$i++){?>
				<div class="over_mobile">
					<div class="br_item">
						<a href="<?=getCurrentPageURL_CANO()?>&result=<?=$product_br[$i]['id']?><?php if($_GET['gia']!=''){echo '&gia='.$_GET['gia'];}?><?php if($_GET['p']!=''){echo '&p='.$_GET['p'];}?>"><?=$product_br[$i]['ten']?></a>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>*/?>
<?php /*<div class="box-gia">
	<div class="over-thuonghieu">
		<b class="tieude_gia over_mobile">Chọn mức giá:</b>
		<?php for($i=0;$i<count($product_gia);$i++){?>
		<a class="over_mobile" href="<?=getCurrentPageURL_CANO()?><?php if($_GET['result']!=''){echo '&result='.$_GET['result'];}?>&gia=<?=$product_gia[$i]['id']?><?php if($_GET['p']!=''){echo '&p='.$_GET['p'];}?>" class="<?php if($_GET['gia']==$product_gia[$i]['id']){ echo 'checked_gia';}?>"><?=$product_gia[$i]['ten']?></a>
		<?php }?> 
		

		
		<?php for($i=0;$i<count($lkweb);$i++){?>
		<a class="over_mobile" href="<?=$lkweb[$i]['link']?>"><input <?php if(getCurrentPageURL()==$lkweb[$i]['link']){ echo 'checked';}?> type="checkbox" name="mucgia" id="mucgia"> <?=$lkweb[$i]['ten']?></a>
		<?php }?> 
	</div>
</div>*/?>
<?php include _template."layout/bread.php";?>
<div class="wap_item clearfix">
	<?php //dump('abc'); 
	foreach ($product as $k => $v) { ?>
    <?php include _template."layout/sanpham.php";?>
  <?php } ?>

</div>
<div class="clearfix"></div>
	<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
