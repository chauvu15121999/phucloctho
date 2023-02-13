<?php 
	include ("ajax_config.php");
	if(!empty($_POST)){
		$id = (int)$_POST['id'];
		$type = (int)$_POST['type'];
		$d->reset();
		$sql_product = "select id,luotthich from #_comment where id=".$id." ";
		$d->query($sql_product);
		$product = $d->fetch_array();
		if($type==1){
			$like=$product['luotthich'] + 10;
		}
		if($type==2 && $product['luotthich']>0){
			$like=$product['luotthich'] - 1;
		}
		 
		$data['luotthich'] = (int)$like;
		$d->setTable('comment');
		$d->setWhere('id', $id); 
		if($d->update($data)){
			$return['luotthich'] = '<span><i class="icdt irtlike"></i>'.(int)$like.'</span>';
		} 
			 
	}
	echo json_encode($return);
?>
