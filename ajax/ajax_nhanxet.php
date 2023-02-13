<?php
	session_start();
	include ("ajax_config.php");
 	
	$page = (int)(!isset($_POST["page"]) ? 1 : $_POST["page"]);
	$id = (int)$_POST["id"];
	$limit1 = (int)$_POST["limit"];
	$type = (string)magic_quote(trim(strip_tags($_POST['type'])));;
	$sort = (string)magic_quote(trim(strip_tags($_POST['sort'])));;
	 
	if($sort=='ngaytao'){
		$order_by=' order by ngaytao desc';
	}else if($sort=='luotthich'){
		$order_by=' order by luotthich desc';
	}else{
		$order_by=' order by ngaytao desc';
	}
	 
	$d->reset();
	$sql = "select count(id) as numb FROM #_comment where type='".$type."' and product_id='".$id."' and comment_type='nhanxet' and hienthi=1 order by ngaytao";
	$d->query($sql);
	$bl = $d->fetch_array();
	 
	$sql = "select id,ten$lang,mota$lang as mota,parent_id,ngaytao,score,luotthich,qtv FROM";
	
	 
	 
	$startpoint1 = $limit1;
	
	
	$limit = ' limit 0,'.$startpoint1;
	$where = " #_comment where type='".$type."' and product_id='".$id."' and comment_type='nhanxet' and parent_id=0 ";
	$sql .= $where." and hienthi=1 $order_by $limit"; 
	$d->query($sql);
	$product = $d->result_array();
	  
	 
	function show_comment($arr_dacap, $parent_id = 0, $kytu = ''){
		
		
		echo '<div class="box_commnet">';
		
		foreach ($arr_dacap as $key => $value){
			// Nếu là chuyên mục con thì hiển thị
			$star='';
			if($value['parent_id'] == $parent_id){
				if($value['qtv']==1){
					$qtv='<span class="qtv">QTV</span>';
					$qtv_cls='logo_qtv';
				}else{
					$qtv='';
					$qtv_cls='';
				}
				
				echo '<div class="item_comment mgb0">';
				$star.='<i class="star_cm">';
				for($i=0;$i<5;$i++){
					if($i<$value['score']){
						$st='on';
					}else{
						$st='off';
					}
				$star.='<img src="img/star-'.$st.'.png"/>';	
				}
				$star.='</i>';
				if($parent_id==0){
				echo '<div>'.$star.'</div>';
				}
				echo '<div class="td_comment">Bởi: <b>'.$kytu.$value['ten'].'</b> ';
				
				 
				
				echo $qtv.'<div class="ngaytao_comment">
					<span>'.humanTiming($kytu.$value['ngaytao']).'</span>
				</div>';
				
				echo '</div>';
					
				echo '<div class="tl_comment">'.nl2br($kytu.$value['mota']).'</div>';
				echo '<p class="fs-dttrlike rate-like" id="like_'.$kytu.$value['id'].'" data-id="'.$kytu.$value['id'].'"><span><i class="icdt irtlike"></i>'.$kytu.$value['luotthich'].'</span></p>';
				
				echo '</div>';
				 
				show_comment_con($value['id'], '');
			}
		}
		echo '</div>';
	}
	
	function show_comment_con($parent_id = 0, $kytu = ''){
		global $d,$id,$type;
		
		
		$d->reset();
		$sql = "select id,ten$lang,mota$lang as mota, parent_id, ngaytao, score, luotthich, qtv FROM #_comment where type='".$type."' and parent_id=".$parent_id." and product_id='".$id."' and comment_type='nhanxet' and hienthi=1 order by ngaytao";
		$d->query($sql);
		$binhluan1 = $d->result_array();
		
		echo '<div class="box_commnet">';
		
		foreach ($binhluan1 as $key => $value){
			// Nếu là chuyên mục con thì hiển thị
			$star='';
			if($value['parent_id'] == $parent_id){
				if($value['qtv']==1){
					$qtv='<span class="qtv">QTV</span>';
					$qtv_cls='logo_qtv';
				}else{
					$qtv='';
					$qtv_cls='';
				}
				
				echo '<div class="item_comment">';
			 
				echo '<div class="td_comment">Bởi: <b>'.$kytu.$value['ten'].'</b> '; 
				echo $qtv.'<div class="ngaytao_comment"><span>'.humanTiming($kytu.$value['ngaytao']).'</span></div>';
				echo '</div>';
				echo '<div class="tl_comment">'.nl2br($kytu.$value['mota']).'</div>';
				echo '<p class="fs-dttrlike rate-like" id="like_'.$kytu.$value['id'].'" data-id="'.$kytu.$value['id'].'"><span><i class="icdt irtlike"></i>'.$kytu.$value['luotthich'].'</span></p>';
				
				echo '</div>';
 				 
			}
		}
		echo '</div>';
	}
?>
<?php show_comment($product,0,''); ?>
<?php if($bl['numb']>3 && $bl['numb']> $limit1){?>
<div class="load_nhanxet">
	<div class="">
		Xem tất cả <b><?php echo ($bl['numb'] - $limit1);?></b> nhận xét
	</div>
</div>

<?php }?>
 