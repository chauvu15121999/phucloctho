<?php
    include "ajax_config.php";
    if(isAjaxRequest()){
    	$type = addslashes($_POST['type']);
    	switch($type){
    		case 'preview-cart':
    			_preview_cart();
    			break;

    	}







    		
    }
    function _preview_cart(){
    	global $d,$func;
    	$id = (int)$_POST['id'];
    	$row = $d->rawQueryOne("select * from #_order where id = ? and id_user = ? ",array($id,getUserInfo("id")));
    	if(!isset($row['id']))
    		exit;
    	$detail = $d->rawQuery("select * from #_order_detail where id_order = ?",array($row['id']));
    	$content = "";
    	foreach($detail as $k=>$v){
    		$s = ($v['size'])?'<br/>Size: '.$v['size']:'';
    		$content.='<tr>
			  <td class="w-20">
			    <img src="thumbs/130x0x2/'.UPLOAD_PRODUCT_L.$v['photo'].'" class="img-fluid img-thumbnail" alt="'.$v['ten'].'">
			  </td>
			  <td class="w-50">'.$v['ten'].$s.'</td>
			  <td class="text-nowrap">'.$func->format_money($v['gia']).'</td>
			  <td class="qty">
			   '.$v['soluong'].'
			  </td>
			  <td class="text-nowrap">'.$func->format_money($v['gia']*$v['soluong']).'</td>
			</tr>';
    	}
    	echo json_encode(array("title"=>"#".$row['madonhang'],"data"=>$content,"total"=>$func->format_money($row['tonggia'])));
    }