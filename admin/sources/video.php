<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$id_pro = (!empty($_REQUEST['id_pro'])) ? (int) $_REQUEST['id_pro'] : 0;

	$urlcu = "";
	$urlcu .= (isset($_REQUEST['id_pro'])) ? "&id_pro=".addslashes($_REQUEST['id_pro']) : "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";

//===========================================================
switch($act){
	case "man":
		get_items();
		$template = "video/items";
		break;
	case "add":
		$template = "video/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "video/item_add";
		break;
	case "save":
		save_item();
		break;
	case "savestt":
		savestt_item();
		break;
	case "delete":
		delete_item();
		break;		

	default:
		$template = "index";
}
//===========================================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}
//===========================================================
function get_items(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu, $id_pro;
	
	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}
	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	if($id_pro>0){
		$where.=" and id_pro='".$id_pro."'";
	}else{
		$where.=" and id_pro='0'";
	}
	$where.=" order by stt,id desc";	
	
	
	$sql="SELECT count(id) AS numrows FROM #_video where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_video where id<>0 $where limit $bg,$pageSize";		
	
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=video&act=man".$urlcu;
}
//===========================================================
function get_item(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Kh??ng nh???n ???????c d??? li???u", "index.php?com=video&act=man".$urlcu);
	
	$sql = "select * from #_video where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("D??? li???u kh??ng c?? th???c", "index.php?com=video&act=man".$urlcu);
	$item = $d->fetch_array();
}
//===========================================================
function save_item(){
	global $d,$config,$urlcu,$id_pro;
	$file_name = $_FILES['file']['name'];
	$file_name_vd = $_FILES['file2']['name'];
	if(empty($_POST)) transfer("Kh??ng nh???n ???????c d??? li???u", "index.php?com=video&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);		
		if($photo = upload_image("file", _format_duoihinh ,_upload_khac,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('video');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_khac.$row['photo']);
			}
		}
		if($vd = upload_image("file2", 'mp4|MP4' ,_upload_video,$file_name_vd)){
			$data['file_up'] = $vd;
			$d->setTable('video');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_video.$row['file']);
			}
		}
		$data['type'] = $_POST['type'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['link'] = $_POST['link'];
		$data['stt'] = $_POST['stt'];
		$data['id_pro'] = $id_pro;
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaysua'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			
		}

		$d->setTable('video');
		$d->setWhere('id', $id);
		if($d->update($data))			
				redirect("index.php?com=video&act=man".$urlcu);
		else
			transfer("C???p nh???t d??? li???u b??? l???i", "index.php?com=video&act=man".$urlcu);
	}else{
		
		if($photo = upload_image("file", _format_duoihinh ,_upload_khac,$file_name)){
			$data['photo'] = $photo;	
		}
		if($vd = upload_image("file2", 'mp4|MP4' ,_upload_video,$file_name_vd)){
			$data['file_up'] = $vd;
		}
		$data['type'] = $_POST['type'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['link'] = $_POST['link'];
		$data['stt'] = $_POST['stt'];
		$data['id_pro'] = $id_pro;
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaysua'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			
		}
		
		$d->setTable('video');
		if($d->insert($data))
			redirect("index.php?com=video&act=man".$urlcu);
		else
			transfer("L??u d??? li???u b??? l???i", "index.php?com=video&act=man".$urlcu);
	}
}
//===========================================================
function delete_item(){
	global $d,$urlcu;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_video where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_khac.$row['photo']);
				delete_file(_upload_video.$row['file_up']);
			}
			$sql = "delete from #_video where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=video&act=man".$urlcu);
		else
			transfer("X??a d??? li???u b??? l???i", "index.php?com=video&act=man".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_video where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_khac.$row['photo']);
				delete_file(_upload_video.$row['file_up']);
			}
			$sql = "delete from #_video where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=video&act=man".$urlcu);} else transfer("Kh??ng nh???n ???????c d??? li???u", "index.php?com=video&act=man".$urlcu);
}

?>


