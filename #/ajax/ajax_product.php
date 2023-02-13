<?php 
	include "ajax_config.php";

	/* Paginations */
	include LIBRARIES."class/class.PaginationsAjax.php";
	$pagingAjax = new PaginationsAjax();
	$pagingAjax->perpage = (!empty($_GET['perpage'])) ? htmlspecialchars($_GET['perpage']) : 1;
	$eShow = htmlspecialchars($_GET['eShow']);
	$idList = (!empty($_GET['idList'])) ? htmlspecialchars($_GET['idList']) : 0;
	$p = (!empty($_GET['p'])) ? htmlspecialchars($_GET['p']) : 1;
	$start = ($p-1) * $pagingAjax->perpage;
	$pageLink = "ajax/ajax_product.php?perpage=".$pagingAjax->perpage;
	$tempLink = "";
	$where = "";

	/* Math url */
	if($idList)
	{
		$tempLink .= "&idList=".$idList;
		$where .= " and id_list = ".$idList;
	}
	$tempLink .= "&p=";
	$pageLink .= $tempLink;

	/* Get data */
	$sql = "select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo, gia, giamoi, giakm, type from #_product where type='san-pham' $where and noibat > 0 and hienthi > 0 order by stt,id desc";
	$sqlCache = $sql." limit $start, $pagingAjax->perpage";
    $items = $cache->getCache($sqlCache,'result',7200);

	/* Count all data */
	$countItems = count($cache->getCache($sql,'result',7200));

	/* Get page result */
	$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);
?>
<?php if($countItems) { ?>
	<div class="grid-page w-clear">
		<?php foreach($items as $k => $v) { ?>
			<div class="product">
				<a class="box-product text-decoration-none" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
					<p class="pic-product scale-img"><img class="lazy" onerror="this.src='<?=THUMBS?>/270x270x2/assets/images/noimage.png';" data-src="<?=WATERMARK?>/product/270x270x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>"/></p>
					<h3 class="name-product text-split"><?=$v['ten'.$lang]?></h3>
					<p class="price-product">
						<?php if($v['giakm']) { ?>
							<span class="price-new"><?=$func->format_money($v['giamoi'])?></span>
							<span class="price-old"><?=$func->format_money($v['gia'])?></span>
							<span class="price-per"><?='-'.$v['giakm'].'%'?></span>
						<?php } else { ?>
							<span class="price-new"><?=($v['gia']) ? $func->format_money($v['gia']) : lienhe?></span>
						<?php } ?>
					</p>
				</a>
				<p class="cart-product w-clear">
					<span class="cart-add addcart transition" data-id="<?=$v['id']?>" data-action="addnow">Thêm vào giỏ hàng</span>
					<span class="cart-buy addcart transition" data-id="<?=$v['id']?>" data-action="buynow">Mua ngay</span>
				</p>
			</div>
		<?php } ?>
	</div>
	<div class="pagination-ajax"><?=$pagingItems?></div>
<?php } ?>