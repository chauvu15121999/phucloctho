<?php
	if(!defined('_source')) die("Error");
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$urlcu = "";
	$urlcu .= (isset($_REQUEST['id'])) ? "&id=".addslashes($_REQUEST['id']) : "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";
	switch($act){
		case "get":
			getAllPayment();
			if (isset ($_SESSION["payments"]) ) {
				unset($_SESSION["payments"]);
			}
			$template = "payments/index";
			break;
		case "add":
			// DELETE SESSION IN INDEX 
			$template = "payments/add";
			break;
		case "createPayment":
			createPayments();
			break;
		case "update":
			getPaymentById($_REQUEST['id']);
			$template = "payments/add";
			break;
		case "savePaymentbyId":
			savePaymentbyId($_REQUEST['id']);
			break;
		// case "delete":
		// 	delete_item();
		// 	break;
		#===================================================
		default:
			$template = "index";
	}


	function createPayments() {
		if (isset ($_SESSION["payments"]) ) {
			unset($_SESSION["payments"]);
		}
		global $d,$config;
		$v = new Valitron\Validator($_POST);
		$v->rule('required', ['name', 'codename','serial_number'])->message('Vui lòng không bỏ trống');
		$fileName=$_FILES['image']['name'];
		// Validate form
		if($v->validate() && $fileName  ) {
			$data = array();
			// ADD PAYMENT 
			if($photo = upload_image("image", _format_duoihinh, _upload_khac,$fileName)) {
				$data['image'] = $photo;
				if(_width_thumb > 0 and _height_thumb > 0)
				$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_khac,$fileName,_style_thumb);
			}
			$data['name'] = $_POST['name'];
			$data['codename'] = $_POST['codename'];
			$data['serial_number'] = $_POST['serial_number'];
			$data['display'] = isset($_POST['display']) ? 1 : 0;
			$data['description'] =  isset($_POST['description']) ? $_POST['description'] : 0;
			$data['created'] = time();
			$data['updated'] = time();
			$d->setTable('payment_method');
			if($d->insert($data)){				
				if (isset ($_SESSION["payments"]) ) {
					unset($_SESSION["payments"]);
				}
				transfer("Dữ liệu được khởi tạo","index.php?com=payments&act=get");
			}
			else
				transfer("Khởi tạo dữ liệu lỗi","index.php?com=payments&act=get");
			return true;
		} else {
			$formData = array_merge($_POST,$_FILES);
			$errors = $v->errors();
			if (!$fileName) {
				$validFile = array ("image" => array ("Vui lòng không bỏ trống"));
				$errors = array_merge($validFile,$errors);
			}
			// Lưu vào session
			session_start();
			$_SESSION['payments']['formData'] = $formData ;
			$_SESSION['payments']['errors'] = $errors ;
			$_SESSION['payments']['action'] = 'index.php?com=payments&act=createPayment' ;
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=payments&act=add");
			return false;
		}
	}

	function savePaymentbyId($id) {
		if (isset ($_SESSION["payments"]) ) {
			unset($_SESSION["payments"]);
		}
		global $d,$config;
		$v = new Valitron\Validator($_POST);
		$v->rule('required', ['name', 'codename','serial_number'])->message('Vui lòng không bỏ trống');
		$fileName=$_FILES['image']['name']; 
		if($v->validate()) {
			$data = array();
			$d->setTable('payment_method');
			$d->setWhere('id', $id);
			$d->select();
			if($photo = upload_image("image", _format_duoihinh, _upload_khac,$fileName)) {
				$data['image'] = $photo;
				if(_width_thumb > 0 and _height_thumb > 0)
				$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_khac,$fileName,_style_thumb);
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_khac.$row['photo']);
					delete_file(_upload_khac.$row['thumb']);
				}
			}
			$data['name'] = $_POST['name'];
			$data['codename'] = $_POST['codename'];
			$data['serial_number'] = $_POST['serial_number'];
			$data['display'] = isset($_POST['display']) ? 1 : 0;
			$data['description'] =  isset($_POST['description']) ? $_POST['description'] : 0;
			$data['created'] = time();
			$data['updated'] = time();
			if($d->update($data)) {
				if (isset ($_SESSION["payments"]) ) {
					unset($_SESSION["payments"]);
				}
				redirect("index.php?com=payments&act=get");
			}
			else {
				transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=payment&act=get");
			}
			return true;
		}  else {
			$formData = array_merge($_POST);
			$errors = $v->errors();
			$_SESSION['payments']['formData'] = $formData ;
			$_SESSION['payments']['errors'] = $errors ;
			$_SESSION['payments']['action'] = "index.php?com=payments&act=savePaymentbyId&id=$id" ;
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=payments&act=update&id=$id");
			return false;
		}

	}

	function getAllPayment() {
		global $d, $payments;
		$sql = "SELECT * FROM table_payment_method";
		$d->query($sql);
		$payments = $d->result_array();
	}

	function getPaymentById($id) {
		global $d, $payment;
		$sql = "SELECT * FROM table_payment_method WHERE id = $id ";
		$d->query($sql);
		$payment = $d->result_array();
		session_start();
		$_SESSION['payments']['action'] = "index.php?com=payments&act=savePaymentbyId&id=$id";
	}
?>
