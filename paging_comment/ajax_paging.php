<?php
	session_start();
	include ("../ajax/ajax_config.php");
	
	
	$page = (int)(!isset($_POST["page"]) ? 1 : $_POST["page"]);
	$id = (int)$_POST["id"];
	$type = (string)magic_quote(trim(strip_tags($_POST['type'])));;
	if ($page <= 0) $page = 1;
	
	$sql = "select id,ten$lang,mota$lang as mota,parent_id,ngaytao,qtv FROM";
	
	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$startpoint1 =$page * $per_page;
	
	
	$limit = ' limit 0,'.$startpoint1;
	$where = " #_comment where type='".$type."' and product_id='".$id."' and comment_type='hoidap' and parent_id=0 ";
	$sql .= $where." and hienthi=1 order by ngaytao $limit"; 
	$d->query($sql);
	$product = $d->result_array();
	$url = getCurrentPageURL();
	$paging = pagination_ajax($where, $per_page, $page, $url);
 
	 
 
	function show_comment1($arr_dacap, $parent_id = 0, $kytu = ''){
		global $d,$type; 
		echo '<div class="box_commnet mgb0">';
		$k=1;
		foreach ($arr_dacap as $key => $value){
			// Nếu là chuyên mục con thì hiển thị
			if($value['parent_id'] == $parent_id){
				
				if($value['qtv']==1){
					$qtv='<span class="qtv">QTV</span>';
					$qtv_cls='logo_qtv';
 				}else{
					$qtv='';
					$qtv_cls='';
				}
				
				echo '<div class="item_comment1" id="roll'.$k.'">
					<div class="td_comment"><span class="first_cap '.$qtv_cls.'">'.substr($kytu.$value['ten'],0,1).'</span><b>'.$kytu.$value['ten'].'</b> '.$qtv.' <div class="ngaytao_comment"><span>'.humanTiming($kytu.$value['ngaytao']).'</span></div></div>
					<div class="tl_comment">'.nl2br2($kytu.$value['mota']).'</div>
					<div class="ngaytao_comment">';
					
					if($parent_id==0){
					echo '<span class="traloi1" data-id="'.$kytu.$value['id'].'">'._traloi.'</span>';
					}
					
					echo '<span class="bl_con"><span class="rutgon"></span><span class="so_bl_con"></span></span></div>
				</div>';
				// Xóa chuyên mục đã lặp
				unset($arr_dacap[$key]); 
				// Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
				
				$d->reset();
				$sql = "select count(id) as num FROM #_comment where type='".$type."' and parent_id='".$kytu.$value['id']."' and comment_type='hoidap' and hienthi=1 ";
				$d->query($sql);
				$cnt_bl = $d->fetch_array();
				
				if($cnt_bl['num']>0){
				 
				show_comment2($value['id'], '');
				}
			}
			$k++;
		}
		echo '</div>';
	}
	function show_comment2($parent_id = 0, $kytu = ''){
		global $d,$id,$type;
		
		$d->reset();
		$sql = "select id,ten$lang,mota$lang as mota,parent_id,ngaytao,qtv,hailong,khonghailong FROM #_comment where type='".$type."' and parent_id=".$parent_id." and product_id='".$id."' and comment_type='hoidap' and hienthi=1 order by ngaytao";
		$d->query($sql);
		$binhluan1 = $d->result_array();
		
		
		echo '<div class="box_commnet">';
		foreach ($binhluan1 as $key => $value){
			// Nếu là chuyên mục con thì hiển thị
			if($value['parent_id'] == $parent_id){
				
				if($value['qtv']==1){
					$qtv='<span class="qtv">QTV</span>';
					$qtv_cls='logo_qtv';
					$mota=nl2br2($kytu.$value['mota']);
				}else{
					$qtv='';
					$qtv_cls='';
					$mota=nl2br2($kytu.$value['mota']);
				}
				
				echo '<div class="item_comment1">
					<div class="td_comment"><span class="first_cap '.$qtv_cls.'">'.substr($kytu.$value['ten'],0,1).'</span><b>'.$kytu.$value['ten'].'</b> '.$qtv.' <div class="ngaytao_comment"><span>'.humanTiming($kytu.$value['ngaytao']).'</span></div></div>
					<div class="tl_comment">'.$mota.'</div>
					<div class="ngaytao_comment">';
					
					if($parent_id==0){
					echo '<span class="traloi1" data-id="'.$kytu.$value['id'].'">'._traloi.'</span>';
					}
					 
					echo '<span class="hailong1 hailong rate-like" id="hailong_'.$kytu.$value['id'].'" data-field="hailong" data-id="'.$kytu.$value['id'].'">(<font>'.$kytu.$value['hailong'].'</font>) Hài lòng</span> - ';
					
					echo ' <span class="hailong1 khonghailong rate-like" id="khonghailong_'.$kytu.$value['id'].'" data-field="khonghailong" data-id="'.$kytu.$value['id'].'">(<font>'.$kytu.$value['khonghailong'].'</font>) Không hài lòng</span>';
					 
					
					echo '<span class="bl_con"><span class="rutgon"></span><span class="so_bl_con"></span></span></div>
				</div>';
				 
				 
				 
			}
		}
		echo '</div>';
	}
?>
<?php show_comment1($product,0,''); ?>
<?=$paging?>