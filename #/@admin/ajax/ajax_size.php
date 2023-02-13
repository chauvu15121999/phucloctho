<?php 
	include "ajax_config.php";

	$id = (!empty($_POST['id'])) ? $_POST['id'] : null;
	$id_product = (!empty($_POST['id_product'])) ? $_POST['id_product'] : 0;
	$type = (!empty($_POST['type'])) ? $_POST['type'] : '';

	if(!empty($id))
	{
		$id = implode(",", $id);
		$sizes = $d->rawQuery("select tenvi, id from #_product_size where id in ($id) and type = ? order by stt,id desc",array($type));
	}
	
	if(!empty($sizes)) { foreach($sizes as $v) {
		if(!empty($id_product)) $price = $d->rawQueryOne("select gia, giamoi, giakm from #_product_price where id_product = ? and id_size = ? limit 0,1",array($id_product, $v['id'])); ?>
		<div class="form-group col-xl-12 col-lg-4 col-md-4 col-sm-6">
			<label>Giá - <span class="text-danger"><?=$v['tenvi']?></span></label>
			<div class="input-group">
            	<input type="text" class="form-control format-price price-origin-size" name="price_size[gia][]" placeholder="Giá bán" value="<?=@$price['gia']?>">
            	<div class="input-group-append">
            		<div class="input-group-text"><strong>VNĐ</strong></div>
            	</div>
            </div>
            <div class="input-group">
            	<input type="text" class="form-control format-price price-new-size" name="price_size[giamoi][]" placeholder="Giá mới" value="<?=@$price['giamoi']?>">
            	<div class="input-group-append">
            		<div class="input-group-text"><strong>VNĐ</strong></div>
            	</div>
            </div>
            <div class="input-group">
            	<input type="text" class="form-control price-promotion-size" name="price_size[giakm][]" placeholder="Chiết khấu" value="<?=@$price['giakm']?>" maxlength="3" readonly>
            	<div class="input-group-append">
            		<div class="input-group-text"><strong>%</strong></div>
            	</div>
            </div>
			<input type="hidden" name="price_size[id][]" value="<?=$v['id']?>" />
		</div>
<?php } } ?>