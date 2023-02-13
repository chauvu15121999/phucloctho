<!--Nut Back to top-->
$(document).ready(function() {
   setTimeout(function(){
	   $(".wap_load").fadeOut(1000);
   },1000);
    $('body').append('<div id="toptop" title="Lên đầu trang"><span></span></div>');
    $('.loadtoptop').append('<div id="toptopdesk" title="Lên đầu trang">▲</div>');
   $(window).scroll(function() {
		if($(window).scrollTop() != 0){
			$('#toptop').fadeIn();
		}else {
			$('#toptop').fadeOut();
		}
   });

   $('#toptop').click(function() {
		$('html, body').animate({scrollTop:0},500);
   });
   
    $('#toptopdesk').click(function() {
		$('html, body').animate({scrollTop:0},500);
   });

   $('#page-top').click(function() {
		$('html, body').animate({scrollTop:0},500);
   });

  $(document).on('click','#baophu, .close-popup,.ttmh',function(){
		$('#baophu,.popup_donhang,.login-popup').fadeOut('fast');
      	setTimeout(function(){
          	$('#baophu,.wap_giohang,.login-popup').remove()
      	}, 700);
	});
});
<!--Nut Back to top-->

<!--Kiểm tra liên hệ-->
function isEmpty(str,text){
		if(str != "") return false;
		if(typeof(text) != 'undefined')	alert(text);
		return true;
}
function isPhone(str,text){
	if((str.length==10 && (str.substr(0,1)==0)))
		return false;
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function isEmail(str, text){
	emailRegExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(emailRegExp.test(str.toLowerCase())){		
		return false;
	}
	if(typeof(text)!='undefined') alert(text);	
	return true;
}
function isSpace(str,text){
	for(var i=0; i < str.length; i++)
	{
		if((str.charAt(i)) == " ")
		{
			if(typeof(text)!='undefined') alert(text);
			return true;

		}
	}
	return false;
}
function isCharacters(str,text){
	if(str=='') return false;
	var searchReg = /^[a-zA-Z0-9-]+$/;
	if(searchReg.test(str)) {
		return false;
	}
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function isRepassword(str,str2,text){
	if(str2=='') return false;
	if(str==str2) return false;
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function isCharacterlimit(str,text,intmin,intmax){
	if(str=='') return false;
	intmin = parseInt(intmin);
	intmax = parseInt(intmax);

	if(str.length>=intmin && str.length<=intmax)
	{
		return false;
	}
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function add_popup(str){
	$(".login-popup").remove();
	$("#baophu").remove();
	$('body').append('<div class="login-popup" style="width:300px;"><div class="close-popup">x</div><div class="popup_thongbao"><p class="tieude_tb">Thông báo</p><p class="popup_kq">'+str+'</p></div></div>');
	$('.thongbao').html('');
	$('.login-popup').fadeIn(300);
	$('body').append('<div id="baophu"></div>');
	$('#baophu').fadeIn(300);
	return false;
}
<!--Kiểm tra liên hệ-->
