<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";
	
	$d = new database($config['database']);
	send_face($_POST['link2']);

?>
<div class="load_face"></div>
<style>.load_face{display:none;background:rgba(0,0,0,0.8) url(../images/loadingPath.gif) center no-repeat;position:fixed;height:100%;width:100%;left:0;top:0;right:0;bottom:0;z-index:999;}</style>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('.post_face').click(function(){
			var link2 = $(this).attr('href');
			$('.load_face').fadeIn(300);
			$.ajax({
				url:'facebook.php',
				type:'post',
				data:{link2:link2},
				success:function(kq){
					$('.load_face').fadeOut(300);
					if(kq=1) alert('Sản phẩm đã được chia sẽ lên fanpage của bạn.');
					else alert('Hệ thống lỗi.');
				}
			});
			return false;
		});
    });
</script>