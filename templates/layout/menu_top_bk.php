<?php
$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,type,photo from #_product_danhmuc where hienthi=1 and type='san-pham' order by stt,id desc";
$d->query($sql);
$product_danhmuc=$d->result_array();

	
$d->reset();
$sql="select ten$lang as ten,id from #_product_gia where type='san-pham' order by stt,id asc";
$d->query($sql);
$product_gia=$d->result_array();
 
?>
<?php $chinhsach = get_news('chinh-sach-mua-hang',5); ?>
<div class="wap_menu clearfix">
	<div class="menu_mobi"><p class="icon_menu_mobi"><i class="fas fa-bars"></i> Menu</p><p class="menu_baophu"></p><a href="" class="home_mobi"><i class="fa fa-home" aria-hidden="true"></i></a></div>
	<div class="menu">
		<ul>
			<li><a class="home <?php if($_source=='index') echo 'active'; ?>" href=""><i class="fa fa-home" aria-hidden="true"></i></a></li>
			<?php /*<li><a href="gioi-thieu.html" title="Giới thiệu">Giới thiệu</a></li>*/?>
			<?php foreach ($baiviet as $k => $v) { ?>
				<li class="mn-mbi"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" class="item-head"><?=$v['ten']?></a></li>
			<?php }?>
			<?=for4cap('product_danhmuc','product_list','product_cat','product_item','san-pham','san-pham','','/','','/')?>
			<?php for($i=0;$i<count($product_danhmuc);$i++){
				$d->reset();
				$sql="select ten$lang as ten,tenkhongdau,id,type from #_product_list where hienthi=1 and type='san-pham' and id_danhmuc=".$product_danhmuc[$i]['id']." order by stt,id desc";
				$d->query($sql);
				$product_list=$d->result_array();
				?>
					<li class="mn-mbi-off <?php if(($i+1)==count($product_danhmuc)) echo 'last_lim'; ?>" style="position:initial;"><a href="san-pham/<?=$product_danhmuc[$i]['tenkhongdau']?>-<?=$product_danhmuc[$i]['id']?>"><?=$product_danhmuc[$i]['ten']?></a>
						 
						<div class="box_list_menu">
							<div class="grid_m">
								<b class="ttmu">Danh mục - <a href="san-pham/<?=$product_danhmuc[$i]['tenkhongdau']?>-<?=$product_danhmuc[$i]['id']?>"><?=$product_danhmuc[$i]['ten']?></a></b>
								
								<div class="box_grid_menu">
									
									<?php for($j=0;$j<count($product_list);$j++){
										$d->reset();
										$sql="select ten$lang as ten,tenkhongdau,id,type from #_product_cat where hienthi=1 and type='san-pham' and id_list=".$product_list[$j]['id']." order by stt,id desc";
										$d->query($sql);
										$product_cat=$d->result_array();
									?>
									<div class="posi">
										<a href="san-pham/<?=$product_list[$j]['tenkhongdau']?>-<?=$product_list[$j]['id']?>/"><?=$product_list[$j]['ten']?></a>
										<?php if(count($product_cat)>0){?>
											<div class="box_grid_menu_c3">
												<div class="grida">
													<?php foreach($product_cat as $k=>$v){?>
														<a class="<?=(($k+1)%2==0)?'padd':''?>" href="san-pham/<?=$v['tenkhongdau']?>/<?=$v['id']?>"><?=$v['ten']?></a>
													<?php }?>
												</div>
											</div>
										<?php }?>
									</div>
									<?php }?>
								</div>
							</div>
							
							<div class="grid_m">
								<img class="dm1 lazy" data-src="thumb/450x0/2/<?php if($product_danhmuc[$i]['photo']!=NULL) echo _upload_sanpham_l.$product_danhmuc[$i]['photo']; else echo 'images/noimage.png';?>" alt="<?=$product_danhmuc[$i]['ten']?>" />
							</div>
						</div>
						 
					</li>
			<?php }?>
			
			<?php foreach($chinhsach as $val){ ?>
				<li class="mn-mbi"><a href="<?=$val['type']?>/<?=$val['tenkhongdau']?>-<?=$val['id']?>.html" title="<?=$val['ten']?>"><?=$val['ten']?></a></li>
			<?php }?>
			
		</ul>
	</div>
	<div class="menu_mb">
		<ul>
			<li><a class="home <?php if($_source=='index') echo 'active'; ?>" href=""><i class="fa fa-home" aria-hidden="true"></i></a></li>
			<li><a href="gioi-thieu.html" title="Giới thiệu">Giới thiệu</a></li>
			<li><a href="doi-tra.html" class="item-head">Đổi trả</a></li>
			<li><a href="giao-hang-nhanh.html" class="item-head">Giao hàng nhanh</a></li>
			<li><a href="bao-hanh-bao-tri.html" class="item-head">Bảo hành - bảo trì</a></li>
			<?=for4cap('product_danhmuc','product_list','product_cat','product_item','san-pham','san-pham','','/','','/')?>
			<li>
				<?php foreach($chinhsach as $val){ ?>
					<li><a href="<?=$val['type']?>/<?=$val['tenkhongdau']?>-<?=$val['id']?>.html" title="<?=$val['ten']?>"><?=$val['ten']?></a></li>
				<?php }?>
			</ul>
		</div>
	</div>