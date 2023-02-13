<?php
session_start();
$session=session_id();
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './admin/lib/');
include_once _lib."Mobile_Detect.php";
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$lang_default = array("","en");
if(!isset($_SESSION['lang']) or !in_array($_SESSION['lang'], $lang_default))
{
	$_SESSION['lang'] = '';
}
$lang = $_SESSION['lang'];
require_once _source."lang$lang.php";
include_once _lib."config.php";
$config['arrayDomainSSL']=array("www.hungvuongcoltd.com");
include_once _lib."checkSSL.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."functions_for.php";
include_once _lib."class.database.php";
include_once _lib."functions_user.php";
include_once _lib."functions_giohang.php";
include_once _lib."class_viettelpost.php";
include_once _lib."file_requick.php";
include_once _source."counter.php";
include_once "vendor/autoload.php";
include_once _lib."breadcrumb.php";
$bread = new breadcrumb();

function get_http(){

	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	return $pageURL;

}  
$http = get_http();
$result = array();
$type = htmlspecialchars($_GET['type']);
$email = htmlspecialchars($_GET['email']);
if(empty($type) && empty($email)){
	redirect($http.$config_url);
}
if(!in_array($type, array('thongtin','dknt','tuvan'))){
	redirect($http.$config_url);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   redirect($http.$config_url);
}
$d->reset();
$d->query("select id,huy from table_lienhe where type='$type' and email='$email'");
$row = $d->fetch_array();
if(empty($row)){
	redirect($http.$config_url);
}
if($row['huy']==1){
	$result['status'] = 1;
	$result['mess'] = 'Bạn đã bỏ đăng ký nhận email thành công';
}
if(!empty($_POST['lydo'])){
	$lydo = htmlspecialchars($_POST['lydo']);
	if($lydo=='khac'){
		$lydo = htmlspecialchars($_POST['lydokhac']);
	}
	$d->reset();
	$d->query("UPDATE table_lienhe SET huy=1, lydo='$lydo' WHERE type='$type' and email='$email'");
	$result['status'] = 1;
	$result['mess'] = 'Bạn đã bỏ đăng ký nhận email thành công';
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Unsubscribe - Hủy đăng ký</title>
	<style type="text/css">
		*{margin: 0px; padding: 0px;}
		ul, li{list-style: none;}
		body{background: #f1f1f1; padding-top: 40px; font-size: 15px; font-family: 'Arial';}
		#main_body{background: #fff; padding: 30px 20px; border-top: 5px solid #7d1315; max-width: 700px; margin: auto;
			-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=8, Direction=0, Color=#000000)";/*IE 8*/
			-moz-box-shadow: 0 0 8px 1px rgba(0,0,0,0.3);/*FF 3.5+*/
			-webkit-box-shadow: 0 0 8px 1px rgba(0,0,0,0.3);/*Saf3-4, Chrome, iOS 4.0.2-4.2, Android 2.3+*/
			box-shadow: 0 0 8px 1px rgba(0,0,0,0.3);/* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
			filter: progid:DXImageTransform.Microsoft.Shadow(Strength=8, Direction=135, Color=#000000); /*IE 5.5-7*/
		}
		.title{color: #7d1315; font-size: 20px; margin-bottom: 10px; text-transform: uppercase; font-weight: bold;}
		.list_ans{padding: 10px 0xp; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;}
		.list_ans ul li{margin: 15px 0px;}
		.list_ans label{cursor: pointer; display: inline;}
		.btn_act{text-align: center; margin-top: 20px;}
		.btn_act button, .btn_act a{padding: 10px 30px; color: #fff; text-transform: uppercase; font-size: 16px; background: #7d1315; border-radius: 7px; border:  none; text-decoration: none; display: inline-block;}
		.txt_mes{font-size: 16px; color: #000; text-align: center; margin-bottom: 20px;}
		.txt_lydokhac{margin-top: 10px; display: none;}
		.txt_lydokhac textarea{width: 100%; border: 1px solid #ccc; padding: 10px;}
	</style>
</head>
<body>
	<div id="main_body">
		<?php if(!empty($result) || $row['huy']==1){ ?>
			<div class="txt_mes"><?=$result['mess']?></div>
			<div class="btn_act"><a href="<?=$http.$config_url?>">VỀ WEBSITE CỦA CHÚNG TÔI</a></div>
		<?php }else{ ?>
			<form method="post" id="frm_lydo">
				<div class="title">Tại sao bạn hủy đăng ký?</div>
				<div class="list_ans">
					<?php 
					$arr_lydo = get_result("select id,ten$lang as ten FROM #_news where hienthi=1 and type='why-huy' order by stt, id desc"); 
					if(!empty($arr_lydo)){ ?>
						<ul>
							<?php foreach($arr_lydo as $lydo){ ?>
								<li><input type="radio" name="lydo" id="why<?=$lydo['id']?>" value="<?=$lydo['ten']?>"> <label for="why<?=$lydo['id']?>"><?=$lydo['ten']?></label></li>
							<?php } ?>
							<li><input type="radio" name="lydo" id="why0" value="khac"> <label for="why0">Khác (điền vào lý do dưới đây)</label>
								<div class="txt_lydokhac">
									<textarea rows="7" name="lydokhac" id="txt_khac" placeholder="Nhập lý do của bạn vào đây..."></textarea>
								</div>

							</li>
						</ul>
					<?php } ?>
				</div>
				<div class="btn_act"><button type="button" id="btn_sub" name="sub_huy" value="ok">GỬI</button></div>
			</form>
		<?php } ?>
	</div>


	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript">
		$().ready(function(){
			$("#btn_sub").click(function() {
				if (typeof $("input[name='lydo']:checked").val() === "undefined") {
				    alert('Vui lòng chọn lý do.');
				}else{
				    $("#frm_lydo").submit();
				}
			});

			$("input[name='lydo']").click(function(){
				if($(this).val()=='khac'){
					$(".txt_lydokhac").show();
				}else{
					$(".txt_lydokhac").hide();
					// $("#txt_khac").val('');
				}
			})

		})
	</script>
</body>
</html>