$().ready(function(){
	$('.slider-slick22').slick({
			infinite: true,
			accessibility:true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay:false,
			autoplaySpeed:3000,
			speed:1000,
			arrows:false,
			
			dots:false,
			draggable:true,
		});
	$(".controller button").click(function(){
		i = $(this).parent().find("input");
		v = parseInt(i.val());
		v++;
		if($(this).hasClass("increment")){
			v=v-2;
		}
		if(v<1){
			v = 1;
		}
		i.val(v);
	})

	$(document).on('click','.trigger-login',function() {
	$tab = $(this).data("tab");
	$(".head_tab div[data-id='"+$tab+"']").trigger("click");
	var root = $('.dknt_fix_content');
	root.find('.dknt_fix').addClass('dknt_fix_active');
	$('.shadow_dknt').addClass('shadow_dknt_avtic');
	
	return false;
});
//Click vào nút Close comment
$(document).on('click','.close_dknt',function() {
	var root = $('.dknt_fix_content');
	root.find('.dknt_fix').removeClass('dknt_fix_active');
	$('.shadow_dknt').removeClass('shadow_dknt_avtic');
	});

	
})