<?php
	include $_SERVER['DOCUMENT_ROOT'].'/components/admin/breadcrums.php';
	include $_SERVER['DOCUMENT_ROOT'].'/components/common/forms.php';
?>
<div class="row add-payment">
	<!-- Breackcrums -->
	<div class="col-12 mt-2">
		<? 	
			$breadcrums = new Breadcrums();
			if(isset($_GET['key']) && $_GET['key']!=''){
				$searchBreakcrums = array(
					'title' => 'Kết quả tìm kiếm',
					'link' => "#",
					'current' => 'current'
				);
			} else {
				$searchBreakcrums = array(
					'title' => 'Thêm phương thức thanh toán',
					'link' => "#",
					'current' => 'current'
				);
			}
			$breadcrumsArr = array(
				array(
					'title' => 'Quản lý',
					'link' => "index.php?com=payments&act=get",
				),
				$searchBreakcrums
			);
			echo $breadcrums->renderBreadcrums($breadcrumsArr); 
		?>
    </div>

	<!-- Form -->
	<div class="col-12 mt-5 mb-5">
		<?php
			$nameForm = 'payments';
			$formSchemar = array(
				array(
					"name" => array (
						"bind" => array (
							"class"=> 'text-md-right',
						),
						"label"=> array (
							"text"=> 'Tên thanh toán:',
							"class" => "col-md-12"
						),
						"field" => array (
							"placeholder" => "Vui lòng nhập tên thanh toán",
							"type" => "text"
						)
					),
					"codename" => array (
						"bind" => array (
							"class"=> 'text-md-right',
						),
						"label"=> array (
							"text"=> 'Key words:',
							"class" => "col-md-12"
						),
						"field" => array (
							"placeholder" => "Vui lòng key word",
							"type" => "text"
						)
					),
				),
				array(
					"serial_number" => array (
						"bind" => array (
							"class"=> 'text-md-right col-md-6',
						),
						"label"=> array (
							"text"=> 'Số thự tự:',
							"class" => "col-md-12"
						),
						"field" => array (
							"placeholder" => "Vui lòng nhập số thự tự",
							"type" => "text"
						)
					),
				),
				array(
					"display" => array (
						"bind" => array (
							"class"=> 'text-md-right col-md-6',
						),
						"label"=> array (
							"text"=> 'Hiển thị thanh toán này',
							"class" => ""
						),
						"field" => array (
							"type" => "checkbox",
							"value" => '1'
						)
					),
				),
				array(
					"description" => array (
						"bind" => array (
							"class"=> 'text-md-right',
						),
						"label"=> array (
							"text"=> 'Mô tả:',
							"class" => "col-md-12"
						),
						"field" => array (
							"placeholder" => "Vui lòng nhập mô tả",
							"type" => "textarea"
						)
					),
				),
				array(
					"image" => array (
						"bind" => array (
							"class"=> 'text-md-right col-md-6',
							"root_image" => _upload_khac
						),
						"label"=> array (
							"text"=> 'Upload hình ảnh:',
							"class" => ""
						),
						"field" => array (
							"placeholder" => "Upload hình ảnh",
							"type" => "file"
						)
					),
				),
				array(
					"button" => array (
						"bind" => array (
							"class"=> 'col-12 text-start',
						),
						"label"=> array (
							"text"=> 'Save',
						),
						"field" => array (
							"type" => "button",
							"class" => "btn btn-primary ps-5 pe-5"
						)
					),
				),
			);
			$action = $_SESSION['payments']['action'] ? $_SESSION['payments']['action'] : 'index.php?com=payments&act=createPayment';
			$errors = !empty($_SESSION['payments']['errors']) ? $_SESSION['payments']['errors'] : [];
			$formData = !empty($_SESSION['payments']['formData']) ? $_SESSION['payments']['formData'] : [];
			$formData = !empty($payment) ? $payment[0]: $formData;

			$formAdd = new Form($nameForm , $formSchemar ,$action, $errors , $formData);
			echo $formAdd->renderForm();
		?>
	</div>
</div>
