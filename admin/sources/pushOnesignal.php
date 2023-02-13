<?php	if(!defined('_source')) die("Error");
	
switch($_GET['act']){
	case "man":
	get_mans();
	$template = "pushOnesignal/items";
	break;
	case "add":		
	$template = "pushOnesignal/item_add";
	break;
	case "edit":		
	get_man();
	$template = "pushOnesignal/item_add";
	break;
	case "save":
	save_man();
	break;
	case "sync":
	sendSync();
	break;
	case "delete":
	delete_man();
	break;	
	#============================================================
	default:
	$template = "index";
}
#====================================
function get_mans(){
	
	global $d, $items, $paging,$page;
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " #_pushonesignal ";
	$where .=" order by id desc";
	$sql = "select * from $where";
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();
}
function get_man(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu","index.php?com=pushOnesignal&act=man");	
	$sql = "select * from #_pushonesignal where id='".$id."'";
	$d->query($sql);
	$item = $d -> fetch_array();
}
function save_man(){
	// dump($_POST);
	global $config_IDoneSignal,$config_KEYgooogleAPI;
	@define ( _width_thumb , 200 );
	@define ( _height_thumb , 200 );
	@define ( _style_thumb , 1 );
	$ratio_ = 1;
	global $d;
	$file_name='sync';
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=pushOnesignal&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sync,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_sync,$file_name,_style_thumb);		
			$d->setTable('pushonesignal');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sync.$row['photo']);	
				delete_file(_upload_sync.$row['thumb']);				
			}
		}	

		// $data['time_star'] = strtotime($_POST['time_star']);
		$time_star_tpl = explode(':',$_POST['time_star']) ;
		$time_star_h =$time_star_tpl[0]; 
		$time_star_p =substr($time_star_tpl[1], 0,2);

		
		$data['gio'] = $time_star_h;
		$data['phut'] = $time_star_p;
		$data['solancon'] = $_POST['solancon'];
		$data['timegannhat'] = strtotime($_POST['time_star'])+120;
		$data['times'] = $_POST['times'];
		$data['name'] = $_POST['name'];			
		$data['description'] = ($_POST['description']);
		$data['link'] = $_POST['link'];	
		$data['number'] = $_POST['number'];
		$data['solancon'] = $_POST['number'];
		$data['date'] = time();
		$d->setTable('pushonesignal');
		$d->setWhere('id', $id);
		if($d->update($data))
			header("Location:index.php?com=pushOnesignal&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=pushOnesignal&act=man");
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sync,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_sync,$file_name,_style_thumb);
		}		

		$time_star_tpl = explode(':',$_POST['time_star']) ;
		$time_star_h =$time_star_tpl[0]; 
		$time_star_p =substr($time_star_tpl[1], 0,2);
		$data['gio'] = $time_star_h;
		$data['phut'] = $time_star_p;
		$data['solancon'] = $_POST['solancon'];
		$data['timegannhat'] = strtotime($_POST['time_star']);

		$data['times'] = $_POST['times'];

		$data['name'] = $_POST['name'];			
		$data['description'] = ($_POST['description']);
		$data['link'] = $_POST['link'];	
		$data['number'] = $_POST['number'];
		$data['solancon'] = $_POST['number'];
		$data['date'] = time();
		$d->setTable('pushonesignal');
		if($d->insert($data))
			header("Location:index.php?com=pushOnesignal&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=pushOnesignal&act=man");
	}
}
function delete_man(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_pushonesignal where id='".$id."'";
		$d->query($sql);
		$row = $d->fetch_array();
		delete_file(_upload_sync.$row['photo']);
		delete_file(_upload_sync.$row['thumb']);
		$sql = "delete from #_pushonesignal where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	
			$d->reset();
			$sql = "select id,photo,thumb from #_pushonesignal where id='".$id."'";
			$d->query($sql);
			$row = $d->fetch_array();
			delete_file(_upload_sync.$row['photo']);
			delete_file(_upload_sync.$row['thumb']);
			$sql = "delete from #_pushonesignal where id='".$id."'";
			$d->query($sql);
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
function sendMessage($heading,$content,$url='http://duandatnen.com.vn/'){
		$contents = array(
		"en" => $content
		);
		$headings = array(
		"en" => $heading
		);
		
		$fields = array(
		'app_id' => "88a36660-aa7f-4a20-ba1a-f1518413ce1e", //thay đổi OneSignal App ID
		'included_segments' => array('All'),
		'contents' => $contents,
		'headings' => $headings,
		'url' => $url
		);
		
		$fields = json_encode($fields);

		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
		'Authorization: Basic YWU1NGZmMWYtOThhMy00OTUzLWIyNGYtYTk2MDdlZmJkZmFk'));// thay đổi REST API Key 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
 

function sendSync(){
	global $config,$d;
		if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb,name,description,link from #_pushonesignal where id='".$id."'";
		$d->query($sql);
		$row = $d->fetch_array();
			sendMessage($row['name'],$row['description'],$row['link']);
		}
		transfer("Gửi thông báo thành công", "index.php?com=pushOnesignal&act=man");	
	}

?>