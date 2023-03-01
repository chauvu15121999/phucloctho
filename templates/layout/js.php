<h1 style="position:absolute; top:-1000px;"><?php if($h1!='')echo $h1;else echo $company['h1'];?></h1><h2 style="position:absolute; top:-1000px;"><?php if($h2!='')echo $h2;else echo $company['h2'];?></h2><h3 style="position:absolute; top:-1000px;"><?php if($h3!='')echo $h3;else echo $company['h3'];?></h3>
<script src="js/jquery-migrate-1.2.1.min.js" ></script>
<script src="js/my_script.js"></script>
<?php if($template != 'index') { ?>
<script src="js/jquery.fancybox.min.js"></script>
<?php } ?>

<?php if($template == 'product_detail' || $template == 'news_detail' || $template == 'tainguyen') { ?>
	<script src="js/jquery.lockfixed.min.js"></script>
	<script>
		$(window).load(function(e) {
			(function($) {
					var bod=$('body').width();
					if(bod>1000){
						var left_h=$('.wap_r').height();
						var main_h=$('.wap_l').height();
						var main_h1=$('.f').height() ;
						if(main_h>left_h){
							// $.lockfixed("#scroll-left",{offset: {top: 43, bottom: main_h1}});
						}
					}
			})(jQuery);
		});
	</script>
<?php } ?>
<?php if($template=='product_detail'){ ?>
	<script type="text/javascript" src="fotorama/fotorama.js?v=<?=time()?>"></script>
	<!-- <script type="text/javascript">
		$().ready(function(){
			var $window = $(window);
			var windowsize = $window.width();
	        if (windowsize < 570) {
	            $(".content_tskt table tbody tr:last-child td").attr("colspan","2");
	        }else{
	        	$(".content_tskt table tbody tr:last-child td").attr("colspan","0");
	        }
		});
	</script> -->

	

	
<?php } ?>
<script src="js/slick.min.js"></script>
<script type="text/javascript" src="js/jquery.simplyscroll.js?v=1"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".grida").each(function(){
			$a = $(this).find("a").length;
			$p = $(this).parents(".box_grid_menu").find(".posi").length;
			$(this).attr({"data-total-link":$a,"data-parent":$p,"data-page":Math.round($a/9)});
			$x = Math.round($a/9);
			if($x >=5){
				$x = 4;
			}
			if($x==2){
				if($a - (9 * $x) > 4){
					$x = 3;
				}
			}
			if($a>27){
				$x=4;
			}
			$(this).parent().addClass("grid-"+$x);
			
			
		})
		
		$(function() {
			$("#scroller").simplyScroll();
		});
	
	});
</script>
<script src="js/owl.carousel.min.js"></script>
<script type="text/javascript">
$().ready(function(){
$(".owl-carousel-video").owlCarousel({
					loop:false,
					margin:10,
					responsiveClass:true,
					responsive:{
						0:{
							items:3,
							
						},
						600:{
							items:5,
							
						},
						1000:{
							items:10,
							
						}
					}
				})
})
	$('.owl-hotro').owlCarousel({
      items: 3,
      margin:20,
      nav:false,
      dots:false,
      lazyLoad:true,
      rewind:true,
      autoplay:true,
      //animateOut: 'fadeOut',
      //animateIn: 'fadeIn',
      autoplayTimeout:5000,
      autoplayHoverPause:true,
      responsive:{
        0: { items: 2}, 
        603: { items:2},
        768: { items: 3},
        1024: { items:3},
        1200: { items:3}
      }
    });
	$('.owl-duan').owlCarousel({
      loop:true,
		margin:10,
		dots:false,
		nav:false,
		responsiveClass:true,
		responsive:{
			0:{
				items:2,
				nav:true
			},
			600:{
				items:3,

			},
			1000:{
				items:4,
				margin:20,
			}
		}
    });


    var owl_sp_dx = $('.owl-sp-view').owlCarousel({
      items: 4,
      margin:20,
      nav:false,
      dots:false,
      lazyLoad:true,
      rewind:true,
      autoplay:true,
      //animateOut: 'fadeOut',
      //animateIn: 'fadeIn',
      autoplayTimeout:5000,
      autoplayHoverPause:true,
      responsive:{
        0: { items: 2,margin:10}, 
        603: { items:2},
        768: { items: 3},
        1024: { items:3},
        1200: { items:4}
      }
    });
    $(".next_sp_dx").click(function(){
		owl_sp_dx.trigger('next.owl');
	});
	$(".prev_sp_dx").click(function(){
		owl_sp_dx.trigger('prev.owl');
	});

	var owl_sp_mk = $('.owl-sp-mk').owlCarousel({
      items: 4,
      margin:20,
      nav:false,
      dots:false,
      lazyLoad:true,
      rewind:true,
      autoplay:true,
      //animateOut: 'fadeOut',
      //animateIn: 'fadeIn',
      autoplayTimeout:5000,
      autoplayHoverPause:true,
      responsive:{
        0: { items: 2,margin:10}, 
        603: { items:2},
        768: { items: 3},
        1024: { items:3},
        1200: { items:4}
      }
    });
    $(".next_sp_mk").click(function(){
		owl_sp_mk.trigger('next.owl');
	});
	$(".prev_sp_mk").click(function(){
		owl_sp_mk.trigger('prev.owl');
	});

	var owl_gala_vd = $(".owl-gala-vd").on("initialized.owl.carousel changed.owl.carousel", function(e) {
	    if (!e.namespace) { return; }
	    $(".count_vd").text(
	      e.relatedTarget.relative(e.item.index) + 1 + "/" + e.item.count
	    );
  	}).owlCarousel({
	    items: 1,
		margin:0,
		nav:false,
		dots:false,
		lazyLoad:true,
		rewind:true,
		autoplay:false
  	});
  	$(".next_gala_vd").click(function(){
		owl_gala_vd.trigger('next.owl');
	});
	$(".prev_gala_vd").click(function(){
		owl_gala_vd.trigger('prev.owl');
	});


	var owl_gala_img = $(".owl-gala-img").on("initialized.owl.carousel changed.owl.carousel", function(e) {
	    if (!e.namespace) { return; }
	    $(".count_img").text(
	      e.relatedTarget.relative(e.item.index) + 1 + "/" + e.item.count
	    );
  	}).owlCarousel({
	    items: 1,
		margin:0,
		nav:false,
		dots:false,
		lazyLoad:true,
		rewind:true,
		autoplay:false
  	});
  	$(".next_gala_img").click(function(){
		owl_gala_img.trigger('next.owl');
	});
	$(".prev_gala_img").click(function(){
		owl_gala_img.trigger('prev.owl');
	});


	$("body").on('click', '.item_gala', function() {
		if($(this).hasClass('active') || $(this).hasClass('no-click')){}else{
			$("#show_gala").css({'opacity':'0'});
			$(".item_gala").removeClass('active');
			let ta = $(this).attr('data-tab');
			$(this).addClass('active');
			$(".tab_gala").removeClass('active');
			$("#"+ta).addClass('active');
			$("#show_gala").animate({opacity:1.0},1000);
		}
	});

	$("body").on('click', '.xem_thongso', function() {
		open_thongso();
	});
	$("body").on('click', '.close_thongso, .overlay_body', function() {
		close_thongso();
	});

	function open_thongso(){
		$(".overlay_body").show();
		$(".close_thongso").show();
		$(".wrap_thongso").show();
	}

	function close_thongso(){
		$(".overlay_body").hide();
		$(".close_thongso").hide();
		$(".wrap_thongso").hide();
	}

	$("body").on('click', '.img_gala, .countimg', function() {
		let ele_fo = $(this).attr("data-fo");
		let ele_owl = $(this).attr("data-owl");
		let index_owl = $("."+ele_owl).find(".owl-item.active").index();
		if($(this).data("owl")=="owl-gala-vd"){
			setTimeout(function(){
			$(".owl-carousel-video .owl-item.active:first a").trigger("click");
			},400);
		}else{
			let fotorama = $("."+ele_fo).fotorama({allowfullscreen: true}).data('fotorama');
			fotorama.requestFullScreen();
			fotorama.show(index_owl);
			$("."+ele_fo).on('fotorama:fullscreenexit',function(){
			$("#fixed_nav_foto").css({'display':'none'});
			$(".fotorama_video").removeClass('active');
			$(".fotorama_img").removeClass('active');
		});
		}
		$("."+ele_fo).addClass('active');
		/*$('.fotorama__stage__shaft .fotorama__active').html('<iframe title="<?=$videos_pro[0]['ten']?>" width="100%" style="height: 100%;width:100%;" src="//www.youtube.com/embed/<?=getYoutubeIdFromUrl($videos_pro[0]['link'])?>?rel=1&autoplay=1" frameborder="0" ></iframe>');*/
		$(".tab_nav_foto").removeClass('active');
		$(".tab_nav_foto[data-fo='"+ele_fo+"']").addClass('active');
		$("#fixed_nav_foto").css({'display':'flex'});
		$(".close-overlay").show();
		
		
		
	});

	$("body").on('click', '.close-overlay', function() {
		$(".close-overlay").hide();
		$(".fotorama_video .wrap-video").html('');
		$("#fixed_nav_foto").hide();
		$("html,body").removeClass("fullscreen");
		$(".fotorama_video,.fotorama_img").removeClass("active");
		$(".owl-carousel-video .owl-item.active a").removeClass("active");
		return false;
	})
	$("body").on('click', '.tab_nav_foto', function() {
		$(".owl-carousel-video .owl-item.active a").removeClass("active");
		if($(this).hasClass('active')){}else{
			let ele_fo = $(this).attr("data-fo");
			$(".tab_nav_foto").removeClass('active');
			$(this).addClass('active');
			$(".fotorama_video").removeClass('active');
			$(".fotorama_img").removeClass('active');
			if(ele_fo!='fotorama_video'){
			let fotorama = $("."+ele_fo).fotorama({allowfullscreen: true}).data('fotorama');
				fotorama.requestFullScreen();
				fotorama.show(0);
				$("."+ele_fo).on('fotorama:fullscreenexit',function(){
					$("#fixed_nav_foto").css({'display':'none'});
					$(".fotorama_video").removeClass('active');
					$(".fotorama_img").removeClass('active');
				
				});
				$(".fotorama_video .wrap-video").html('');
			}else{
				
				$(".owl-carousel-video .owl-item.active:first a").trigger("click");
			}
			$("."+ele_fo).addClass('active');
			
			
			
		}
		return false;
	});
	


</script>
<script>
		function load_slick(id){
			$.ajax({
				type: "POST",
				url: "ajax/slick.php",
				data: {id:id},
				success: function(msg){
					$('.load_slick_sp').html(msg);
					var myLazyLoad = new LazyLoad({
						elements_selector: ".lazy"
					});
					$('.slick-'+id).slick({
					infinite: true,
					accessibility:true,
					slidesToShow: 5,
					slidesToScroll: 1,
					autoplay:true,
					autoplaySpeed:3000,
					speed:1000,
					lazyLoad: 'ondemand',
					arrows:false,
					centerMode:false,
					dots:false,
					draggable:true,
					arrows:true,
					prevArrow:'<button type="button" class="slick-prev"></button>',
					nextArrow:'<button type="button" class="slick-next"></button>',
					responsive: [
					{
					  breakpoint: 1024,
					  settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
						infinite: true,
						dots: true
					  }
					},
					{
					  breakpoint: 770,
					  settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 600,
					  settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					  }
					}
				  ]
				}); 
				}
			});
		}
	$().ready(function(){
		load_slick("spmoi");
		 
		$('.change_slick span').click(function() {
			var id=$(this).attr('data-id');
			$('.change_slick span').removeClass('check_acti');
			$(this).addClass('check_acti');
			load_slick(id);
		});
	});
		
	</script>
<?php if($template == 'index') { ?>
	<script>
		var fired = false;
		window.addEventListener("scroll", function(){
			if ((document.documentElement.scrollTop != 0 && fired === false) || (document.body.scrollTop != 0 && fired === false)) {
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0';
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));

				$('.bando-footer').html('<?=$company['bando']?>');
				$('.video-aaaa').html('<iframe title="<?=$video[0]['ten']?>" width="100%" style="height: 254px;width:100%;" src="//www.youtube.com/embed/<?=getYoutubeIdFromUrl($video[0]['link'])?>" frameborder="0" allowfullscreen></iframe>');

				fired = true;
			}
		}, true);
		
		
	</script>
	
<?php }else{ ?>
	<script src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&autoLogAppEvents=1"></script>
<?php } ?>


<script src="https://www.google.com/recaptcha/api.js?render=<?=$site_key?>"></script>
<script>
    grecaptcha.ready(function () {
 		
 		grecaptcha.execute('<?=$site_key?>', { action: 'dknt2' }).then(function (token) {
        var recaptchaResponsedknt2 = document.getElementById('recaptchaResponsedknt2');
        recaptchaResponsedknt2.value = token;
    });

		grecaptcha.execute('<?=$site_key?>', { action: 'dknt' }).then(function (token) {
        var recaptchaResponsedknt = document.getElementById('recaptchaResponsedknt');
        recaptchaResponsedknt.value = token;
    });

		<?php if($deviceType == 'computer') {?>
		grecaptcha.execute('<?=$site_key?>', { action: 'tuvan_footer' }).then(function (token) {
            var recaptchaResponsefooter = document.getElementById('recaptchaResponsefooter');
            recaptchaResponsefooter.value = token;
        });
		<?php }?>
		<?php if($template!='index') { ?>
		grecaptcha.execute('<?=$site_key?>', { action: 'tuvan_left' }).then(function (token) {
            var recaptchaResponse_left = document.getElementById('recaptchaResponse_left');
            recaptchaResponse_left.value = token;
        });
		<?php }?>
		<?php if($template=='giohang') { ?>
		grecaptcha.execute('<?=$site_key?>', { action: 'order' }).then(function (token) {
            var recaptchaResponse_order = document.getElementById('recaptchaResponse_order');
            recaptchaResponse_order.value = token;
        });
		<?php }?>
		<?php if($template=='product_detail') { ?>
		grecaptcha.execute('<?=$site_key?>', { action: 'nhanxet' }).then(function (token) {
            var recaptchaResponse_nhanxet = document.getElementById('recaptchaResponse_nhanxet');
            recaptchaResponse_nhanxet.value = token;
        });
		<?php }?>
		<?php if($template=='product_detail' || $template=='news_detail') { ?>
		grecaptcha.execute('<?=$site_key?>', { action: 'hoidap' }).then(function (token) {
            var recaptchaResponse_hoidap = document.getElementById('recaptchaResponse_hoidap');
            recaptchaResponse_hoidap.value = token;
        });
		<?php } ?>
    });
</script>
<script>
	function loadRecapchatFrm(id,act){
		grecaptcha.ready(function () {
		  grecaptcha.execute('<?=$site_key?>', { action: act }).then(function (token) {
			  var recapchaBook = document.getElementById(id);
			  recapchaBook.value = token;
		  });
		});
	  }
	 
	$(document).ready(function(){
		$('.slider-thuonghieu').slick({
			infinite: true,
			accessibility:true,
			slidesToShow: 7,
			slidesToScroll: 7,
			autoplay:false,
			autoplaySpeed:3000,
			speed:1000,
			arrows:false,
			centerMode:false,
			dots:true,
			draggable:true,
			arrows:false,
			prevArrow:'<button type="button" class="slick-prev">Previous</button>',
			nextArrow:'<button type="button" class="slick-next">Next</button>',
		});
		$('.slider-thuonghieu1').slick({
			infinite: true,
			accessibility:true,
			slidesToShow: 5,
			slidesToScroll: 5,
			autoplay:false,
			autoplaySpeed:3000,
			speed:1000,
			arrows:false,
			centerMode:false,
			dots:true,
			draggable:true,
			arrows:false,
			prevArrow:'<button type="button" class="slick-prev">Previous</button>',
			nextArrow:'<button type="button" class="slick-next">Next</button>',
		});
		$('.slider-slick').slick({
			infinite: true,
			accessibility:true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay:true,
			autoplaySpeed:3000,
			speed:1000,
			arrows:false,
			centerMode:false,
			dots:false,
			draggable:true,
		});
		$('.chay_tinsl').slick({
			infinite: true,
			accessibility:true,
			vertical:true,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay:true,
			autoplaySpeed:3000,
			speed:1000,
			arrows:false,
			centerMode:false,
			dots:false,
			draggable:true,
		});
		$('.menu_mb ul').slick({
			infinite: true,
			accessibility:true,
			vertical:false,
			slidesToShow: 5,
			slidesToScroll: 2,
			autoplay:false,
			autoplaySpeed:3000,
			speed:1000,
			arrows:false,
			centerMode:false,
			dots:false,
			draggable:true,
			variableWidth:true
		});
		$('.tuvanf').click(function(){

			if(isEmpty($('#ten_lienhe_fot').val(), "<?=_nhaphoten?>")) {
				$('#ten_lienhe_fot').focus();
				return false;
			}
			if(isEmpty($('#email_lienhe_fot').val(), "<?=_emailkhonghople?>")) {
				$('#email_lienhe_fot').focus();
				return false;
			}
			if(isEmail($('#email_lienhe_fot').val(), "<?=_emailkhonghople?>")) {
				$('#email_lienhe_fot').focus();
				return false;
			}
			if(isEmpty($('#dienthoai_lienhe_fot').val(), "<?=_nhapsodienthoai?>")) {
				$('#dienthoai_lienhe_fot').focus();
				return false;
			}
			if(isEmpty($('#noidung_lienhe_fot').val(), "<?=_nhapnoidung?>")) {
				$('#noidung_lienhe_fot').focus();
				return false;
			}
			loadRecapchatFrm('recaptchaResponsefooter','tuvan_footer');
			$.ajax({
				type:'post',
				url:"ajax/tuvan.php",
				data:$(".frm_fot").serialize(),
				dataType:'json',
				beforeSend: function() {
					$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
				},
				error: function(){
					add_popup('<?=_hethongloi?>');
					$(".frm_fot")[0].reset();
 				},
				success:function(kq){
					add_popup(kq.thongbao);
					$('#capcha').val('');
					if(kq.nhaplai=='nhaplai'){
						$(".frm_fot")[0].reset();
					}
 				}
			});
		});
		
		
		var menu_mobi = $('.wap_menu ul').html();
		$('.menu_mobi_add').append('<span class="close_menu">X</span><ul>'+menu_mobi+'</ul>');
		$(".menu_mobi_add ul li").each(function(index, element) {
			if($(this).children('ul').children('li').length>0){
				$(this).children('a').append('<i class="fas fa-chevron-right"></i>');
			}
		});
		$(".menu_mobi_add ul li a i").click(function(){
			if($(this).parent('a').hasClass('active2')){
				$(this).parent('a').removeClass('active2');
				if($(this).parent('a').parent('li').children('ul').children('li').length > 0){
					$(this).parent('a').parent('li').children('ul').hide(300);
					return false;
				}
			}
			else{
				$(this).parent('a').addClass('active2');
				if($(this).parents('li').children('ul').children('li').length > 0){
					$(".menu_m ul li ul").hide(0);
					$(this).parents('li').children('ul').show(300);
					return false;
				}
			}
		});
		$('.icon_menu_mobi_mn,.close_menu,.menu_baophu').click(function(){
			if($('.menu_mobi_add').hasClass('menu_mobi_active')) {
				$('.menu_mobi_add').removeClass('menu_mobi_active');
				$('.menu_baophu').fadeOut(300);
			} else {
				$('.menu_mobi_add').addClass('menu_mobi_active');
				$('.menu_baophu').fadeIn(300);
			}
			return false;
		});
		$(".menu ul li").hover(function(){
			$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(300);
		},function(){
			$(this).find('ul:first').css({visibility: "hidden"});
		});
		$(".menu ul li").hover(function(){
			$(this).find('>a').addClass('active2');
		},function(){
			$(this).find('>a').removeClass('active2');
		});
		$("#danhmuc > ul > li > a").click(function(){
			if($(this).parents('li').children('ul').find('li').length>0) {
				$("#danhmuc ul li ul").hide(300);
				if($(this).hasClass('active')) {
					$("#danhmuc ul li a").removeClass('active');
					$(this).parents('li').find('ul:first').hide(300);
					$(this).removeClass('active');
				} else {
					$("#danhmuc ul li a").removeClass('active');
					$(this).parents('li').find('ul:first').show(300);
					$(this).addClass('active');
				}
				return false;
			}
		});
		$('img').each(function(index, element) {
			if(!$(this).attr('alt') || $(this).attr('alt')=='') {
				$(this).attr('alt','<?=$company['ten']?>');
			}
		});

		$("body").on('click', '.add_quantam', function(event) {
			var id = $(this).attr('data-id');

			$.ajax({
				type:'post',
				url:'ajax/add_danhsach.php',
				data:{id:id,type:'ds_quantam'},
				beforeSend: function() {
					$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
				},
				error: function(){
					add_popup('<?=_hethongloi?>');
				},
				success:function(kq){
					// add_popup("Đã thêm vào sản phẩm danh sách quan tâm");
					$('.num_quantam').text(kq);
				}
			});
		});

		$("body").on('click', '.add_sosanh', function(event) {
			var id = $(this).attr('data-id');
			$.ajax({
				type:'post',
				url:'ajax/add_danhsach.php',
				data:{id:id,type:'ds_sosanh'},
				beforeSend: function() {
					$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
				},
				error: function(){
					add_popup('<?=_hethongloi?>');
				},
				success:function(kq){
					// add_popup("Đã thêm vào sản phẩm danh sách so sánh");
					$('.num_sosanh').text(kq);
				}
			});
		});

		$("body").on('click', '.del_quantam', function(event) {
			var id = $(this).attr('data-id');
			$.ajax({
				type:'post',
				url:'ajax/del_danhsach.php',
				data:{id:id,type:'ds_quantam'},
				beforeSend: function() {
					$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
				},
				error: function(){
					add_popup('<?=_hethongloi?>');
				},
				success:function(kq){
					location.reload();
				}
			});
		});

		$(".left_ss").click(function () { 
		  var leftPos = $('.table-resp').scrollLeft();
		  $(".table-resp").animate({scrollLeft: leftPos - 500}, 800);
		});

		$(".right_ss").click(function () { 
		  var leftPos = $('.table-resp').scrollLeft();
		  $(".table-resp").animate({scrollLeft: leftPos + 500}, 800);
		});

		
		$("#show_table_ss").on('click', '.doi_sp_ss', function() {
			let id = $(this).attr('data-id');
			$(".sel_sp_ss").attr('data-idold',id);
			$("#pop_ds_pro").fadeIn('fast');
		});

		$("#pop_ds_pro").on('click', '.overlay, .close_pop', function() {
			$("#pop_ds_pro").fadeOut('fast');
		});

		$("#pop_ds_pro").on('click', '.sel_sp_ss', function() {
			$(".header-overlay").show();
			let id_new = $(this).attr('data-idnew');
			let id_old = $(this).attr('data-idold');
			$.ajax({
				url: 'ajax/change_table_ss.php',
				type: 'POST',
				data: {id_new:id_new,id_old,id_old},
				success: function(data){
					$("#show_table_ss").html(data);
					
					
				}
			});

			$.ajax({
				url: 'ajax/change_pop_ss.php',
				type: 'POST',
				success: function(data){
					$("#pop_ds_pro .content_dssp").html(data);
				}
			});

			$("#pop_ds_pro").fadeOut('fast');
			$(".header-overlay").fadeOut('fast');
		});

		$("body").on('click', '.add_cart', function(event) {
			var id = $(this).attr('data-id');
			var sl = 1;
			$.ajax({
				type:'post',
				url:'ajax/cart.php',
				dataType:'json',
				data:{id:id,size:'',mausac:'',soluong:sl,act:'dathang'},
				beforeSend: function() {
					$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
				},
				error: function(){
					add_popup('<?=_hethongloi?>');
				},
				success:function(kq){
					// add_popup(kq.thongbao);
					$('.box-giohang-fix b').html(kq.sl);
					$('.giohanghead b').html(kq.sl);
					$('.qty_cart').html(kq.sl);
					location.href="gio-hang.html";
					// setTimeout(function(){location.href="gio-hang.html"},3000);
					// console.log(kq);
				}
			});
		});


	});
function doEnter(evt){
	var key;
	if(evt.keyCode == 13 || evt.which == 13){
		onSearch(evt);
	}
}
function onSearch(evt) {
	var keyword1 = $('.keyword:eq(0)').val();
	var keyword2 = $('.keyword:eq(1)').val();
	if(keyword1=='<?=_nhaptukhoatimkiem?>...') {
		keyword = keyword2;
	} else {
		keyword = keyword1;
	}
	if(keyword=='' || keyword=='<?=_nhaptukhoatimkiem?>...') {
		alert('<?=_chuanhaptukhoa?>');
	} else {
		location.href = "tim-kiem.html&keyword="+keyword;
		loadPage(document.location);
	}
}
</script>
<?php if($template!='index') { ?>
	<script>
		$(document).ready(function(e) {
			$('.tuvanf_l').click(function(){
				loadRecapchatFrm('recaptchaResponse_left','tuvan_left');

				if(isEmpty($('#ten_lienhe_l').val(), "<?=_nhaphoten?>")) {
					$('#ten_lienhe_l').focus();
					return false;
				}
				if(isEmpty($('#email_lienhe_l').val(), "<?=_emailkhonghople?>")) {
					$('#email_lienhe_l').focus();
					return false;
				}
				if(isEmail($('#email_lienhe_l').val(), "<?=_emailkhonghople?>")) {
					$('#email_lienhe_l').focus();
					return false;
				}
				if(isEmpty($('#dienthoai_lienhe_l').val(), "<?=_nhapsodienthoai?>")) {
					$('#dienthoai_lienhe_l').focus();
					return false;
				}
				if(isEmpty($('#noidung_lienhe_').val(), "<?=_nhapnoidung?>")) {
					$('#noidung_lienhe_').focus();
					return false;
				}
				$.ajax({
					type:'post',
					url:$(".frm_l").attr('action'),
					data:$(".frm_l").serialize(),
					dataType:'json',
					beforeSend: function() {
						$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
					},
					error: function(){
						add_popup('<?=_hethongloi?>');
						$(".frm_l")[0].reset();
 					},
					success:function(kq){
						add_popup(kq.thongbao);
						$('#capcha').val('');
						if(kq.nhaplai=='nhaplai') {
							$(".frm_l")[0].reset();
 						}
					}
				});
			});
		});
	</script>
<?php }?>
<?php if($template=='product_detail') { ?>
	<script type = "text/javascript" src = "js/jquery.raty.js"></script>

	<script>
		$(document).ready(function(){
			$('.slick2').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				autoplay:false,
				autoplaySpeed:5000,
				asNavFor: '.slick'
			});
			$('.slick').slick({
				slidesToShow: 5,
				slidesToScroll: 1,
				asNavFor: '.slick2',
				dots: false,
				centerMode: false,
				focusOnSelect: true,
				responsive: [
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 376,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				}
				]
			});
		});
	</script>
	<script src="magiczoomplus/magiczoomplus.js"></script>
	<script>
		var mzOptions = {
			zoomMode:true,
			zoomPosition: 'inner ',
			onExpandClose: function(){MagicZoom.refresh();}
		};
		$(document).ready(function(){
			//$('#content_tabs .tab').hide();
			//$('#content_tabs .tab:first').show();
			$('#ultabs li:first').addClass('active');
			$('#ultabs li').click(function(){
				var vitri = $(this).data('vitri');
				$('html, body').animate({
					scrollTop: $("#tab_"+vitri).offset().top
				}, 1000);
				/*$('#ultabs li').removeClass('active');
				$(this).addClass('active');
				$('#content_tabs .tab').hide();
				$('#content_tabs .tab:eq('+vitri+')').show();
				return false;*/
			});
			
			$('.size').click(function(){
				$('.size').removeClass('active_size');
				$(this).addClass('active_size');
			});
			$('.mausac').click(function(){
				$('.mausac').removeClass('active_mausac');
				$(this).addClass('active_mausac');
			});

			


			$("body").on('click', '.dathang', function() {
				$alert = $(this).hasClass("cart_popup");

				
				if($('.size').length && $('.active_size').length==false) {
					alert('<?=_chonsize?>');
					return false;
				}
				if($('.active_size').length) {
					var size = $('.active_size').html();
				} else {
					var size = '';
				}
				if($('.mausac').length && $('.active_mausac').length==false) {
					alert('<?=_chonmau?>');
					return false;
				}
				if($('.active_mausac').length) {
					var mausac = $('.active_mausac').html();
				} else {
					var mausac = '';
				}
				var act = "dathang";
				var id = "<?=$row_detail['id']?>";
				var soluong = 1;
				if($('.soluong').val()>0){
					soluong = $('.soluong').val();
				}
				if(soluong>0) {
					$.ajax({
						type:'post',
						url:'ajax/cart.php',
						dataType:'json',
						data:{id:id,size:size,mausac:mausac,soluong:soluong,act:act},
						beforeSend: function() {
							$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
						},
						error: function(){
							add_popup('<?=_hethongloi?>');
						},
						success:function(kq){
							$('.box-giohang-fix b').html(kq.sl);
							$('.giohanghead b').html(kq.sl);
							$('.qty_cart').html(kq.sl);
							if($alert){
							 add_popup(kq.thongbao);
							}else{
							
							location.href="gio-hang.html";
						}
							
						}
					});
				} else {
					alert('<?=_nhapsoluong?>');
				}
				return false;
			});
		});
	</script>
	<script language="javascript" type="text/javascript">
 	$(document).ready(function() {
		jQuery(document).ready(function(){
			jQuery('.guidanhgia').on("click", function(){
				if ( $('.comment_hide').css('display') == 'none' ) {
					$('.comment_hide').animate({height: 'show'}, 400); 
				} else {
					$('.comment_hide').animate({height: 'hide'}, 200); 
				} 
			});
			 
		}); 
	});
</script>
	
<?php } ?>
<script src='js/flags.js'></script>
<script>
	function GoogleLanguageTranslatorInit() {
		new google.translate.TranslateElement({pageLanguage: 'vi', autoDisplay: false }, 'google_language_translator');
	}
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=GoogleLanguageTranslatorInit"></script>
<?php if($template == 'news_detail'){?>
<script type="text/javascript" language="javascript">
		function loadData_ls(page,id_tab,id_danhmuc){
			$.ajax({
				type: "POST",
				url: "paging_ajax_list/ajax_paging.php",
				data: {page:page,id_danhmuc:id_danhmuc,gia:<?=(int)$_GET['gia']?>,p:<?=(int)$_GET['p']?>},
				success: function(msg){
					$(id_tab).html(msg);
					  
					var myLazyLoad = new LazyLoad({
						elements_selector: ".lazy"
					});
				 
					$(id_tab+" .pagination li.active").click(function(){
						var pager = $(this).attr("p");
						var id_danhmucr = $(this).parents().parents().parents().attr("data-rel");
						loadData_ls(pager,".load_page_ls_"+id_danhmucr,id_danhmucr);
					});  
				}
			});
		}
		 
		$().ready(function(){
			if($('#get_list').length){
				$('.bx_ww_content_ls').each(function(index, element) {
					var id=$(this).attr('data-rel');
					loadData_ls(1,".load_page_ls_"+id,id);
				});
			}
		}); 
	 
</script>
<?php }?>
<?php if($template == 'product'){?>
<script type="text/javascript" language="javascript">
		function loadData_ls(page,id_tab,id_danhmuc){
			$.ajax({
				type: "POST",
				url: "paging_ajax_list/ajax_paging1.php",
				data: {page:page,id_danhmuc:id_danhmuc,gia:<?=(int)$_GET['gia']?>,p:<?=(int)$_GET['p']?>},
				success: function(msg){
					$(id_tab).html(msg);
					  
					var myLazyLoad = new LazyLoad({
						elements_selector: ".lazy"
					});
				 
					$(id_tab+" .pagination li.active").click(function(){
						var pager = $(this).attr("p");
						var id_danhmucr = $(this).parents().parents().parents().attr("data-rel");
						loadData_ls(pager,".load_page_ls_"+id_danhmucr,id_danhmucr);
					});  
				}
			});
		}
		 
		$().ready(function(){
			if($('#get_list').length){
				$('.bx_ww_content_ls').each(function(index, element) {
					var id=$(this).attr('data-rel');
					loadData_ls(1,".load_page_ls_"+id,id);
				});
			}
		}); 
	 
</script>
<?php }?>
<?php if($template == 'product_detail'){?>
<script type="text/javascript" language="javascript">
		function loadData_ls(page,id_tab,id_danhmuc){
			$.ajax({
				type: "POST",
				url: "paging_ajax_list/ajax_paging2.php",
				data: {page:page,id_danhmuc:id_danhmuc,gia:<?=(int)$_GET['gia']?>,p:<?=(int)$_GET['p']?>},
				success: function(msg){
					$(id_tab).html(msg);
					  
					var myLazyLoad = new LazyLoad({
						elements_selector: ".lazy"
					});
				 
					$(id_tab+" .pagination li.active").click(function(){
						var pager = $(this).attr("p");
						var id_danhmucr = $(this).parents().parents().parents().attr("data-rel");
						loadData_ls(pager,".load_page_ls_"+id_danhmucr,id_danhmucr);
					});  
				}
			});
		}
		 
		$().ready(function(){
			if($('#get_list').length){
				$('.bx_ww_content_ls').each(function(index, element) {
					var id=$(this).attr('data-rel');
					loadData_ls(1,".load_page_ls_"+id,id);
				});
			}
		}); 
	 
</script>
<?php }?>
<?php if($template == 'product_detail' || $template == 'news_detail' ){?>
<script type="text/javascript">
	function loadProduct(page, content,id,type){
		$.ajax({
			url: 'paging_comment/ajax_paging.php',
			type: 'POST',
			dataType: 'html',
			data: {page:page,id:id,type:type},
		})
		.done(function(result) {
			$(content).html(result);
			$(content+" .pagination li a").click(function(e){
				e.preventDefault();
				if($.isNumeric($(this).text())){
					var pager = $(this).text();
				}else{ var pager = $(this).data("page"); }
				loadProduct(pager, content,id,"<?=$type?>");
				var roll=(pager-1)*10;
				if(roll==0){ roll++; }  
				var rollpage= '#roll'+roll;
				$('html,body').animate({scrollTop:$(rollpage).offset().top-30},'slow');
			});
		})
		.fail(function() {
			console.log("error");
		});
	}
	$().ready(function(){
		var id = <?=$id?>;
		loadProduct(1, ".bx_ww_content",id,"<?=$type?>");
	});
</script>
<?php }?>
<?php if($template == 'product_detail'){?>
<script type="text/javascript">
	function load_nhanxet(content,id,type,sort,limit){
		$.ajax({
			url: 'ajax/ajax_nhanxet.php',
			type: 'POST',
			dataType: 'html',
			data: {id:id,type:type,sort:sort,limit:limit},
		})
		.done(function(result) {
			$(content).html(result);
			 
		})
		.fail(function() {
			console.log("error");
		}); 
	}
	 
	$().ready(function(){
		var id = <?=$id?>;
		var sort = $('.sort_active').attr('data-id');
		  
		load_nhanxet(".show_nhanxet",id,"<?=$type?>",sort,3);
		$(document).on('click','.sort_cm',function() {
			var sort1 = $(this).attr('data-id');
			$('.sort_cm').removeClass('sort_active');
			$(this).addClass('sort_active');
			
			load_nhanxet(".show_nhanxet",id,"<?=$type?>",sort1,3);
		});
		$(document).on('click','.load_nhanxet',function() {
			var lim= $(this).find('b').html(); 
			var limit= <?=count($binhluan)?> - lim;
			var limit1= limit + 3;
			load_nhanxet(".show_nhanxet",id,"<?=$type?>",sort,limit1);
		});
		 
	});
	 
</script>


<?php }?>
<?php if( isset($type) && $type == 'tin-tuc'){?>
	<link rel="stylesheet" href="jquery.mCustomScrollbar.css">
	<script src="jquery.mCustomScrollbar.concat.min.js"></script>
	<script>
		$(document).ready(function(e) {
			$("#content-1").mCustomScrollbar({
				theme:"minimal"
			});
		});
	</script>
<?php } ?>
<script type="text/javascript" language="javascript">
	 
		function change_v(){
			var id= $('#clickvideo option:selected').val(); 
			$('.video-aaaa iframe').attr('src','//www.youtube.com/embed/'+id);
		}
	 
</script>



<script type="text/javascript">
	$(document).ready(function(e) {
		//Click vào nút Close comment

		//Click vào nút gửi và hoàn tất
		$(document).on('click','#hoantat_dknt',function() {
			var root = $('.dknt_fix_content');
			loadRecapchatFrm('recaptchaResponsedknt','dknt');
			if(isEmpty(root.find('#ten_dknt').val(), "<?=_nhaphoten?>")){
				root.find('#ten_dknt').focus();
				return false;
			}
			if(isEmpty(root.find('#dienthoai_dknt').val(),"Xin nhập số điện thoại")){
				root.find('#dienthoai_dknt').focus();
				return false;
			}
			if(isEmpty(root.find('#email_dknt').val(), "<?=_emailkhonghople?>")){
				root.find('#email_dknt').focus();
				return false;
			}
			if(isEmail(root.find('#email_dknt').val(), "<?=_emailkhonghople?>")){
				root.find('#email_dknt').focus();
				return false;
			}
			
 			<?php /*var ten = root.find('#ten_dknt').val();
			var email = root.find('#email_dknt').val();
			var dienthoai = root.find('#dienthoai_dknt').val();
 			add_dknt(ten,email,dienthoai);*/?>
			add_dknt();
			
			root.find('.dknt_fix').removeClass('dknt_fix_active');
			root.find('.shadow_dknt').removeClass('shadow_dknt_avtic');

			return false;
		});
		
		$(document).on('click','#index_hoantat_dknt',function() {
			var root = $('.dknt_index_content');
			loadRecapchatFrm('recaptchaResponsedknt','dknt');
			if(isEmpty(root.find('#index_ten_dknt').val(), "<?=_nhaphoten?>")){
				root.find('#tindex_en_dknt').focus();
				return false;
			}
			if(isEmpty(root.find('#index_dienthoai_dknt').val(),"Xin nhập số điện thoại")){
				root.find('#index_dienthoai_dknt').focus();
				return false;
			}
			if(isEmpty(root.find('#index_email_dknt').val(), "<?=_emailkhonghople?>")){
				root.find('#index_email_dknt').focus();
				return false;
			}
			if(isEmail(root.find('#index_email_dknt').val(), "<?=_emailkhonghople?>")){
				root.find('#index_email_dknt').focus();
				return false;
			}
 			<?php /*var ten = root.find('#index_ten_dknt').val();
			var email = root.find('#index_email_dknt').val();
			var dienthoai = root.find('#index_dienthoai_dknt').val();*/?>
 			add_dknt1();
		  
			return false;
		});
    });
	
	//Hàm thêm comment vào database
	function add_dknt(){
		$.ajax({
			type:'post',
			url:'ajax/dknt.php',
			data:$(".frm_dk_top").serialize(),
			dataType:'json',
			error: function(){
				add_popup('<?=_hethongloi?>');
				 
			},
			success:function(kq){
				add_popup(kq.thongbao);
				$(".frm_dk_top")[0].reset();
 			}
		});	
	} 
	function add_dknt1(){
		$.ajax({
			type:'post',
			url:'ajax/dknt1.php',
			data:$(".frm_dk_dknt").serialize(),
			dataType:'json',
			error: function(){
				add_popup('<?=_hethongloi?>');
				
			},
			success:function(kq){
				add_popup(kq.thongbao);
				$(".frm_dk_dknt")[0].reset();
 			}
		});	
	} 
	
	<?php /*function add_dknt(ten,email,dienthoai){
			$.ajax({
				type:'post',
				url:'ajax/dknt.php',
				data:{ten:ten,email:email,dienthoai:dienthoai},
				dataType:'json',
				error: function(){
					add_popup('<?=_hethongloi?>');
				},
				success:function(kq){
					add_popup(kq.thongbao);
				 
					$('#ten_dknt').val('');
					$('#email_dknt').val('');
					$('#dienthoai_dknt').val('');
 				}
			});	
		}*/?>

</script>
<?php if($template == 'product_detail') { ?>
<link rel="stylesheet" href="fancybox/dist/jquery.fancybox.min.css">
<script src="fancybox/dist/jquery.fancybox.min.js"></script>
<?php }?>