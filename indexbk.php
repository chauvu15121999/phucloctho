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
//include_once _lib."class.database2.php";
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

?>
<!doctype html>
<html lang="<?php if($lang=='')echo 'vi';else echo $lang;?>">
<head >
	<base href="<?=$http.$config_url?>/" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php include _template."layout/seoweb.php";?>
	<?php include _template."layout/css.php";?>
	<?php include _template."layout/style.php";?>
	<script src="js/jquery.min.js"></script>
	<script src="js/lazyload.min.js"></script>
	<script>
		$(document).ready(function(){
			var myLazyLoad = new LazyLoad({
				elements_selector: ".lazy"
			});
		})
	</script>
	<?=$company['codethem']?>
	
	<?php if($company['hoaroi']>0){?>
		<!-- hieu ung hoa mai roi -->
	<script type='text/javascript'>
	var pictureSrc = "<?=_upload_hinhanh_l.$company['img_hoa']?>"; //the 
	var pictureWidth = 30; //the width of the snowflakes
	var pictureHeight = 30; //the height of the snowflakes
	var numFlakes = 10; //the number of snowflakes
	var downSpeed = 0.01; //the falling speed of snowflakes (portion of screen per 100 ms)
	var lrFlakes = 10; //the speed that the snowflakes should swing from side to side


	if( typeof( numFlakes ) != 'number' || Math.round( numFlakes ) != numFlakes || numFlakes < 1 ) { numFlakes = 10; }

	//draw the snowflakes
	for( var x = 0; x < numFlakes; x++ ) {
	if( document.layers ) { //releave NS4 bug
		document.write('<layer id="snFlkDiv'+x+'"><imgsrc="'+pictureSrc+'" height="'+pictureHeight+'"width="'+pictureWidth+'" alt="*" border="0"></layer>');
	} else {
		document.write('<div style="position:absolute; z-index:9999;"id="snFlkDiv'+x+'"><img src="'+pictureSrc+'"height="'+pictureHeight+'" width="'+pictureWidth+'" alt="*"border="0"></div>');
	}
}

	//calculate initial positions (in portions of browser window size)
	var xcoords = new Array(), ycoords = new Array(), snFlkTemp;
	for( var x = 0; x < numFlakes; x++ ) {
		xcoords[x] = ( x + 1 ) / ( numFlakes + 1 );
		do { snFlkTemp = Math.round( ( numFlakes - 1 ) * Math.random() );
		} while( typeof( ycoords[snFlkTemp] ) == 'number' );
		ycoords[snFlkTemp] = x / numFlakes;
	}

	//now animate
	function flakeFall() {
		if( !getRefToDivNest('snFlkDiv0') ) { return; }
		var scrWidth = 0, scrHeight = 0, scrollHeight = 0, scrollWidth = 0;
	//find screen settings for all variations. doing this every time allows for resizing and scrolling
	if( typeof( window.innerWidth ) == 'number' ) { scrWidth = window.innerWidth; scrHeight = window.innerHeight; } else {
		if( document.documentElement && (document.documentElement.clientWidth ||document.documentElement.clientHeight ) ) {
			scrWidth = document.documentElement.clientWidth; scrHeight = document.documentElement.clientHeight; } else {
				if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
					scrWidth = document.body.clientWidth; scrHeight = document.body.clientHeight; } } }
					if( typeof( window.pageYOffset ) == 'number' ) { scrollHeight = pageYOffset; scrollWidth = pageXOffset; } else {
						if( document.body && ( document.body.scrollLeft ||document.body.scrollTop ) ) { scrollHeight = document.body.scrollTop;scrollWidth = document.body.scrollLeft; } else {
							if(document.documentElement && (document.documentElement.scrollLeft ||document.documentElement.scrollTop ) ) { scrollHeight =document.documentElement.scrollTop; scrollWidth =document.documentElement.scrollLeft; } }
						}
	//move the snowflakes to their new position
	for( var x = 0; x < numFlakes; x++ ) {
		if( ycoords[x] * scrHeight > scrHeight - pictureHeight ) { ycoords[x] = 0; }
		var divRef = getRefToDivNest('snFlkDiv'+x); if( !divRef ) { return; }
		if( divRef.style ) { divRef = divRef.style; } var oPix = document.childNodes ? 'px' : 0;
		divRef.top = ( Math.round( ycoords[x] * scrHeight ) + scrollHeight ) + oPix;
		divRef.left = ( Math.round( ( ( xcoords[x] * scrWidth ) - (pictureWidth / 2 ) ) + ( ( scrWidth / ( ( numFlakes + 1 ) * 4 ) ) * (Math.sin( lrFlakes * ycoords[x] ) - Math.sin( 3 * lrFlakes * ycoords[x]) ) ) ) + scrollWidth ) + oPix;
		ycoords[x] += downSpeed;
	}
}

	//DHTML handlers
	function getRefToDivNest(divName) {
	if( document.layers ) { return document.layers[divName]; } //NS4
	if( document[divName] ) { return document[divName]; } //NS4 also
	if( document.getElementById ) { return document.getElementById(divName); } //DOM (IE5+, NS6+, Mozilla0.9+, Opera)
	if( document.all ) { return document.all[divName]; } //Proprietary DOM - IE4
	return false;
}

window.setInterval('flakeFall();',100);
	//]]>
</script>  
<?php }?>
	<script src="https://apis.google.com/js/api:client.js"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8463288959020970"
     crossorigin="anonymous"></script>
</head>
<?php include _template."layout/background.php";?>
<body onLoad="<?php if(@$_GET['com']=='lien-he') echo 'initialize();'; ?>" >
	<div class="page-loading"></div>
	<div id="fb-root"></div>
	<script type="text/javascript">
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '3139077476198497',
				cookie     : true,
				xfbml      : true,
				version    : 'v7.0'
			});
		};

		// https://developers.facebook.com/docs/javascript/examples#login
		// https://developers.facebook.com/docs/facebook-login/web
		function loginFb(){
			FB.login(function (response) {
		        if (response.authResponse) {
		            FB.api('/me?fields=id,name,email', function (response2) {
						
						if(response2.email==null){
							alert("Email Facebook &#1044;‘ang r&#1073;»—ng. Vui l&#1043;&#1030;ng c&#1073;&#1108;­p nh&#1073;&#1108;­t email t&#1043; i kho&#1073;&#1108;&#1032;n Facebook c&#1073;»§a b&#1073;&#1108;&#1038;n r&#1073;»“i th&#1073;»­ l&#1073;&#1108;&#1038;i sau. C&#1073;&#1108;&#1032;m &#1046;&#1038;n.");
							return false;
						}
						
		                $.ajax({
							data:{mail:response2.email,name:response2.name},
							type:'post',
							error:function(e){
								console.log(e);
								return false;
							},
							url:'ajax/login_social.php',
							success:function(data){	
								window.top.location='index.html';
								return false;
							}
						})
		            });
		        } else {
		            alert('&#1044;&#1106;&#1044;&#1107;ng nh&#1073;&#1108;­p th&#1073;&#1108;&#1168;t b&#1073;&#1108;&#1038;i. Vui l&#1043;&#1030;ng th&#1073;»­ l&#1073;&#1108;&#1038;i sau!');
		        }
		    }, {scope: 'email'});
		    return false;
		}
		(function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "https://connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div class="header-overlay"></div>
	<div id="wapper">
		<div class="wrap">
			<?php include _template."layout/header.php";?>
			<?php include _template."layout/menu_top.php";?>
			<div class="main_content clearfix <?php if($source=='index'){ echo 'margin0 border_home';} ?>">

				<div class="qc">
					<a href="<?=layhinh('link','qc1')?>" class="quangcao-1 wap_1200" target="_blank"><img src="<?=layhinh('photo','qc1')?>" alt="Banner" /></a>
				</div>
				
				<?php include _template."layout/slider_jssor.php";?>
				<?php include _template.$template."_tpl.php"; ?>

			</div>
			<div class="f">
			<?php include _template."layout/doitac.php";?>
			
				<?php include _template."layout/footer.php";?>
				<?php //if($deviceType == 'computer') { include _template."layout/sphot.php"; }?>
			</div>
		</div>
	</div>
	<?php //include _template."layout/facebook.php";?>
	<?php //include _template."layout/phone3.php";?>
	<?php if($deviceType !='computer') include _template."layout/chat_fb_new.php";?>
	
	<?php if(
		$deviceType == 'computer') {include _template."layout/icon_mxh.php";
	}else{
		include _template."layout/phone3.php";
	}?>
	<?php include _template."layout/js.php";?>
	<div class="menu_mobi_add"></div>
	<link rel="stylesheet" type="text/css" href="css/photobox.css"/>
	<script src="js/photobox.js"></script>
	<script>
		$('#popupimage img').each(function(index, element) {
			$(this).addClass('aligncenter');
		}); 
		$(document).ready(function($){
			$("#popupimage img").each(function(){
				$(this).wrap("<a class='popup' href='"+$(this).attr("src")+"'></a>");
			})
			$('#popupimage').photobox('a.popup',{thumbs:true,loop:true,zoomable:true,time:3000});
		});
	</script>
	<?php include _template."layout/json_strucdata.php";?>
	
	<?=$company['codethem2']?>
	<?php if($deviceType == 'computer') { include _template."layout/chat.php";}?>
	 
	<script src="Toolstip/ajax.js" type="text/javascript"></script>
	<script src="Toolstip/ajax-dynamic-content.js" type="text/javascript"></script>
	<script src="Toolstip/home.js" type="text/javascript"></script>
	<script>	
		$().ready(function(){
			var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
			
			
			if($(window).width() < 768){
				$('.item a').each(function(){
					if($(this).attr("onmouseover")!=undefined){
						$e = $(this).attr("onmouseover");
						$(this).removeAttr("onmouseover onmouseout");
					}
				})
				
				$('.item a').click(function(e){
					e.preventDefault();
					id = $(this).data("id");
					if(id!=undefined){
						AJAXShowToolTip('tolltip.php?id='+id);
						VietAd_PositionTooltip(e);
						x = $(this);
						setTimeout(function(){
							window.location.href=x.attr("href");
						},1000);
					}
				})
			}
			var done = false;
			function onPlayerReady(event) {
				event.target.playVideo();
			  }
			  function onPlayerStateChange(event) {
				if (event.data == YT.PlayerState.PLAYING && !done) {
				  //setTimeout(stopVideo, 6000);
				  done = true;
				}
			  }
			  function stopVideo() {
				player.stopVideo();
			  }
		$("body").on("click",".play-video",function(){
			
			
			if(!$(this).hasClass("active")){
				if(!$(this).hasClass("youtube")){
					$(".wrap-video").html('<div class="zvideo"><div class="in-video"><video controls autoplay><source src="'+$(this).attr("href")+'" type="video/mp4"></video></div></div>');	
					
				}else{
					$(".wrap-video").html('<div class="zvideo"><div class="in-video"><div id="player"></div></div></div>');	
				
				var player;
				done = false;
				player = new YT.Player('player', {
					height: '390',
					width: '640',
					videoId: $(this).data("id"),
					 playerVars: { 
						'autoplay': 1,
						//'controls': 0,
						//'mute':1,
						//'autohide': 1,
						'wmode': 'opaque',
						'origin': '<?=$_SERVER['HTTP_HOST']?>' 
					},
					events: {
						'onReady': onPlayerReady,
						'onStateChange': onPlayerStateChange
					}
				})
				}
			}
			$(".play-video").removeClass("active");
			$(this).addClass("active");
			return false;
			
			
		})
		})

	</script>
	<script>
		document.addEventListener("touchstart", function() {},false);
	</script>
	<script src="js/script_google.js"></script>
	<script>startApp();</script>
	<style type="text/css">
		.simply-scroll .simply-scroll-list li:last-child a{ padding-right: 0px !important; }
	</style>

	<?php if($template=='product_detail'){ ?>
		<script src="https://www.youtube.com/iframe_api"></script>
			<div id="fixed_nav_foto">
				<?php if(!empty($videos_pro)){ ?><div class="tab_nav_foto" data-fo="fotorama_video">Video</div><?php } ?>
				<div class="tab_nav_foto" data-fo="fotorama_img">H&#1043;¬nh s&#1073;&#1108;&#1032;n ph&#1073;&#1108;©m</div>
				
			</div>
			
			<?php if(!empty($videos_pro)){ ?>
				<div class="fotorama_video">
					<div class="wrap-video">
						
					</div>
					<div class="bottom-of">
					<div class="owl-carousel-video owl-carousel">
					
					
					
					<?php foreach($videos_pro as $v){ ?>
						<?php if(!empty($v['link'])){ ?>
							<a href="<?=$v['link']?>" class='play-video youtube' data-img="<?=_upload_khac_l.$v['photo']?>"  data-id="<?=getYoutubeIdFromUrl($v['link'])?>">
						    	<img src="<?=_upload_khac_l.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>" onerror="this.src='images/noimage.png';">
					  		</a>
						<?php }else{ ?>
							<a href="<?=_upload_video_l.$v['file_up']?>" class="play-video" data-img="<?=_upload_khac_l.$v['photo']?>">
						    	<img src="<?=_upload_khac_l.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>" onerror="this.src='images/noimage.png';">
					  		</a>
						<?php } ?>
	                <?php } ?>
					</div>
					</div>
				</div>
			<?php } ?>

			<div class="fotorama_img" data-nav="thumbs">
				<img src="<?php if($row_detail['photo'] != NULL)echo _upload_sanpham_l.$row_detail['photo'];else echo 'images/noimage.png';?>" />
				<?php foreach($hinhthem as $v){ ?>
	              <img src="<?=_upload_hinhthem_l.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
	            <?php } ?>
				
			</div>
		

		<div class="overlay_body"></div>
		<div class="close_thongso"><span>&#1074;&#1114;–</span>&#1044;&#1106;&#1043;&#1110;ng</div>
		<div class="wrap_thongso">
			<div class="scroll">
				<h3>Th&#1043;&#1169;ng s&#1073;»‘ k&#1073;»&#8470; thu&#1073;&#1108;­t chi ti&#1073;&#1108;&#1111;t <?=$row_detail['ten']?></h3>
				<div class="content_tskt">
					<?php if(!empty($row_detail['thongso'])){ echo $row_detail['thongso'];}else{ echo '<table border="0" cellpadding="5" cellspacing="0" style="width:100%;">
									<tbody>
										<tr>
											<td style="width: 36%; background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>&#1042; </td>
											<td>&#1042; </td>
										</tr>
										<tr>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>&#1042; </td>
											<td>&#1042; </td>
										</tr>
										<tr>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>&#1042; </td>
											<td>&#1042; </td>
										</tr>
										<tr>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>&#1042; </td>
											<td>&#1042; </td>
										</tr>
										<tr>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>&#1042; </td>
											<td>&#1042; </td>
										</tr>
										<tr>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>&#1042; </td>
											<td>&#1042; </td>
										</tr>
										<tr>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>&#1042; </td>
											<td>&#1042; </td>
										</tr>
										<tr>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>&#1042; </td>
											<td>&#1042; </td>
										</tr>
										<tr>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
											<td style="background-color: rgb(244, 244, 244);">&#1042; </td>
										</tr>
										<tr>
											<td>
											<ul style="margin: 0px 0px 0px 20px; padding: 0px; box-sizing: border-box; outline: none; font-family: body; font-size: 12px; background-color: rgb(255, 255, 255);">
												<li style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none;"><span style="font-family:helvetica;"><u style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none;"><strong style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-family: tieude;"><span style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-size: 14px;">NPP - H&#1043;™NG V&#1046;&#1031;&#1046; NG</span></strong></u></span></li>
											</ul>

											<p style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none;"><span style="font-family:helvetica;"><u style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none;"><strong style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-family: tieude;"><span style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-size: 14px;">__________________</span></strong></u></span></p>
											</td>
											<td>
											<p><span style="font-family:helvetica;"><u style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-family: body; font-size: 14px; background-color: rgb(255, 255, 255);"><strong style="margin: 0px; padding: 0px; box-sizing: border-box; outline: none; font-family: tieude;">&#1044;&#1106;&#1046;°&#1073;»&#1032;c th&#1043; nh l&#1073;&#1108;­p t&#1073;»« n&#1044;&#1107;m 2018</strong></u><span style="font-size: 14px; background-color: rgb(255, 255, 255);">. C&#1043;&#1169;ng ty TNHH Thi&#1073;&#1108;&#1111;t b&#1073;»‹ C&#1046;&#1038; &#1044;‘i&#1073;»‡n H&#1043;&#8470;ng V&#1046;°&#1046;&#1038;ng hi&#1073;»‡n &#1044;‘ang l&#1043;  nh&#1043;  cung c&#1073;&#1108;&#1168;p, ph&#1043;&#1118;n ph&#1073;»‘i h&#1043; ng &#1044;‘&#1073;&#1108;§u Vi&#1073;»‡t Nam trong l&#1044;©nh v&#1073;»±c thi&#1073;&#1108;&#1111;t b&#1073;»‹ &#1044;‘i&#1073;»‡n m&#1043;&#1038;y d&#1043;&#1118;n d&#1073;»&#1168;ng v&#1043;  c&#1043;&#1169;ng nghi&#1073;»‡p. Ch&#1043;&#1108;ng t&#1043;&#1169;i tin t&#1046;°&#1073;»&#1119;ng r&#1073;&#1108;±ng ngay b&#1043;&#1118;y gi&#1073;»&#1116; s&#1073;&#1108;&#1029; tr&#1073;»&#1119; th&#1043; nh &#1044;‘&#1073;»‘i t&#1043;&#1038;c truy&#1073;»&#1027;n th&#1073;»‘ng c&#1073;»§a Qu&#1043;&#1029; kh&#1043;&#1038;ch v&#1073;»›i gi&#1043;&#1038; th&#1043; nh v&#1043;  d&#1073;»‹ch v&#1073;»&#1168; sau b&#1043;&#1038;n h&#1043; ng ho&#1043; n h&#1073;&#1108;&#1032;o nh&#1073;&#1108;&#1168;t.</span></span></p>

											<p>&#1042; </p>

											<ul>
												<li><span style="font-family:helvetica;"><span style="font-size: 14px; background-color: rgb(255, 255, 255);">Tell: (+84) 848 029 029</span></span></li>
											</ul>
											</td>
										</tr>
									</tbody>
								</table>
						';} ?>
				</div>
			</div>
		</div>

	<?php } ?>

<style>
	.btn_sp_mb .btn_ac:hover{background:#7d1315;color:#fff}
</style>
<button class="close-overlay"><span>&#1074;&#1114;–</span> &#1044;&#1106;&#1043;&#1110;ng</button>
</body>
</html>