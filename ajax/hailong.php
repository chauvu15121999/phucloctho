<?php 
	include ("ajax_config.php");
	if(!empty($_POST)){
		$id = (int)$_POST['id'];
		$type = (int)$_POST['type'];
		$field = (string)magic_quote(trim(strip_tags($_POST['field'])));
		if($field!=''){
			$d->reset();
			$sql_product = "select id,".$field." from #_comment where id=".$id." ";
			$d->query($sql_product);
			$product = $d->fetch_array();
			if($type==1){
				$like=$product[$field] + 10;
			}
			if($type==2 && $product[$field]>0){
				$like=$product[$field] - 1;
			}
			 
			$data[$field] = (int)$like;
			$d->setTable('comment');
			$d->setWhere('id', $id); 
			if($d->update($data)){
				$return['luotthich'] = (int)$like;
			}
		} 
			 
	}
	echo json_encode($return);
?>
