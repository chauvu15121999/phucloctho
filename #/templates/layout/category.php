<div id="category-wrapper">
<div class="container">
	<div class="wrap-category">
	<div class="title">
		<i class="icon-menu"></i> Danh mục
	</div>
	<div class="content owl-carousel owl-product-category" data-lg-items="10:0" data-md-item="6:0" data-xs-items="3:0">
		<?php 
			$i=0;
			foreach($model->get("product_list") as $k=>$v){
				if($i==0){
					echo '<div>';
				}
				$i++;
				?>
				
				<div class="item">
					<a href="product/<?=$v[$sluglang]?>-<?=$v['id']?>">
						<div class="bgz">
							<span class="bg" style="background-image: url('thumbs/200x200x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>'); background-size: contain; background-repeat: no-repeat;"></span>
							<span><?=$v['ten'.$lang]?></span>
						</div>
					</a>
				</div>
				<?php 
				if($i==2){
					echo '</div>';
					$i=0;
				}
			}
			if($i==1){
				$v = $model->get("product_list")[0];
				?>
				<div class="item">
					<a href="product/<?=$v[$sluglang]?>-<?=$v['id']?>">
						<div class="bgz" style="background-image: url('thumbs/200x200x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>'); background-size: contain; background-repeat: no-repeat;">
							<span><?=$v['ten'.$lang]?></span>
						</div>
					</a>
				</div>
			</div>
				<?php 
			}
		?>

	</div>
	</div>

</div>
</div>