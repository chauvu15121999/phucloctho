<?php
	session_start();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	$login_name_admin = md5($config['salt_sta'].$config['salt_end']);
  	check_login_ajax();
	
	
	$page = (int)(!isset($_POST["page"]) ? 1 : $_POST["page"]);
	$id = (string)$_POST["id"];
	$key = (string)$_POST["key"];
	$huy = (int)$_POST['huy'];
	if ($page <= 0) $page = 1;
	
	$sql = "select * from ";
	$per_page = 20;
	
	$where=' #_lienhe where id<>0';
	if($id!=''){
		$where.=" and type='".$id."'";
	}
	if($key!=''){
		$where.=" and (ten like '%".$key."%' || dienthoai like '%$key%' || email like '%$key%')";
	}
	if($huy==1){
		$where.=" and huy=1";
	}else{
		$where.=" and huy=0";
	}
	
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	 
	$sql .= $where." order by id desc $limit"; 
	$d->query($sql);
	$items = $d->result_array();
	$url = getCurrentPageURL();
	$paging = pagination_ajax1($where, $per_page, $page, $url);
 
?>
<?php for($i=0, $count=count($items); $i<$count; $i++){?>
<tr>
	<td><input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" /></td>
	<td align="center">
		<input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_GET['com']?>" type="text" value="<?=$items[$i]['stt']?>" data-val3="stt" name="stt<?=$i?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText stt" onblur="stt(this)" id="upstt" original-title="Nhập số thứ tự " rel="<?=$items[$i]['id']?>" />
	</td>       
	<td>
		<a href="index.php?com=lienhe&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$id?>" class="tipS SC_bold">
		<?php if($items[$i]['ten']!='')echo $items[$i]['ten'];else echo $items[$i]['tenen'];?>
		</a>
	</td>
	<td>
		<a href="index.php?com=lienhe&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$id?>" class="tipS SC_bold">
			<?=$items[$i]['tencty']?>
		</a>
	</td>
	<td><?=$items[$i]['dienthoai'];?></td>
	<td><?=$items[$i]['email'];?></td>

	<?php if($huy==1){ ?>
		<td><?=nl2br($items[$i]['lydo']);?></td>
	<?php }else{ ?>
		<td align="center">
			<a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
		</td>
	<?php } ?>

	<?php /*<td class="title_name_data">
		<a href="index.php?com=lienhe&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" class="tipS SC_bold"><?php if($items[$i]['chude']!='')echo $items[$i]['chude'];else echo $items[$i]['chudeen'];?></a>
	</td>*/?>
	
	<td class="actBtns">
 
		<a href="index.php?com=lienhe&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$id?>" title="" class="smallButton tipS" original-title="Sửa danh mục"><img src="./images/icons/dark/pencil.png" alt=""></a>
		<a href="index.php?com=lienhe&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$id?>" onClick="if(!confirm('Xác nhận xóa <?=$items[$i]['ten']?>')) return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="./images/icons/dark/close.png" alt=""></a> 
	</td>
</tr>
<?php } ?>
<tr >
<td colspan="8">
	<?=$paging?>
</td>
</tr>