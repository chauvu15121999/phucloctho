<?php
	include "ajax_config.php";

	$flag = 1;
	$slug = (!empty($_POST['slug'])) ? htmlspecialchars($_POST['slug']) : '';
	$id = (!empty($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
	$copy = (!empty($_POST['copy'])) ? htmlspecialchars($_POST['copy']) : 0;
	$where = ($id && !$copy) ? "id <> $id AND " : "";

	$table = array(
		"#_product_list",
		"#_product_cat",
		"#_product_item",
		"#_product_sub",
		"#_product_brand",
		"#_product",
		"#_news_list",
		"#_news_cat",
		"#_news_item",
		"#_news_sub",
		"#_news",
		"#_tags"
	);

	if(!empty($table))
	{
		foreach($table as $v)
		{
			$check = $d->rawQueryOne("select id from $v where $where (tenkhongdauvi = ? or tenkhongdauen = ?) limit 0,1",array($slug,$slug));
			if(!empty($check['id']))
			{
				$flag = 0;
				break;
			}
		}
	}

	echo $flag;
?>