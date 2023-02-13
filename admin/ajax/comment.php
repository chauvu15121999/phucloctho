<?php

	include ("ajax_config.php");

	insert_comment();

	function insert_comment(){
			global $d;
			$data['product_id'] = (int)$_POST['product_id'];
			$data['parent_id'] = (int)$_POST['parent_id'];
			$data['qtv'] = (int)$_POST['qtv'];
			$data['lang'] = $lang;
			$data['ten'.$lang] = (string)magic_quote(trim(strip_tags($_POST['ten'])));
			$data['email'] = (string)magic_quote(trim(strip_tags($_POST['email'])));
			$data['mota'] = (string)trim(strip_tags($_POST['mota']));
			$data['type'] = (string)magic_quote(trim(strip_tags($_POST['type'])));
			$data['comment_type'] = (string)magic_quote(trim(strip_tags($_POST['comment_type'])));
			$data['hienthi'] = 1;
			$data['ngaytao'] = time();

			$d->setTable('comment');
			if($d->insert($data)){
				$return['thongbao'] = 'Bình luận thành công';
				$return['nhaplai'] = 'nhaplai';
			}
			else
			{
				$return['thongbao'] = 'Hệ thống lỗi,vui lòng liên hệ nhà cung cấp website';
				$return['nhaplai'] = '0';
			}

		echo json_encode($return);
	}

?>
