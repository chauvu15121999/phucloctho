<?php
	//bình luận
	
	/*$d->reset();
	$sql = "select id,ten$lang,mota$lang as mota,parent_id,ngaytao,qtv FROM #_comment where type='".$type."' and product_id='".$id."' and comment_type='hoidap' and hienthi=1 order by ngaytao";
	$d->query($sql);
	$binhluan1 = $d->result_array();
	
	function show_comment1($arr_dacap, $parent_id = 0, $kytu = ''){
		global $d,$type;
		echo '<div class="box_commnet">';
		foreach ($arr_dacap as $key => $value){
			// Nếu là chuyên mục con thì hiển thị
			if($value['parent_id'] == $parent_id){
				
				if($value['qtv']==1){
					$qtv='<span class="qtv">QTV</span>';
				}else{
					$qtv='';
				}
				
				echo '<div class="item_comment1">
					<div class="td_comment"><span class="first_cap">'.substr($kytu.$value['ten'],0,1).'</span><b>'.$kytu.$value['ten'].'</b> '.$qtv.' <div class="ngaytao_comment"><span>'.humanTiming($kytu.$value['ngaytao']).'</span></div></div>
					<div class="tl_comment">'.$kytu.$value['mota'].'</div>
					<div class="ngaytao_comment">';
					
					if($parent_id==0){
					echo '<span class="traloi1" data-id="'.$kytu.$value['id'].'">'._traloi.'</span>';
					}
					
					echo '<span class="bl_con"><span class="rutgon"></span><span class="so_bl_con"></span></span></div>
				</div>';
				// Xóa chuyên mục đã lặp
				unset($arr_dacap[$key]); 
				// Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
				
				$d->reset();
				$sql = "select count(id) as num FROM #_comment where type='".$type."' and parent_id='".$kytu.$value['id']."' and comment_type='hoidap' and hienthi=1 ";
				$d->query($sql);
				$cnt_bl = $d->fetch_array();
				
				if($cnt_bl['num']>0){
				 
				show_comment1($arr_dacap, $value['id'], '');
				}
			}
		}
		echo '<div class="clear"></div>
		
		</div>';
	}*/
?>

<link href="css/hoidap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(document).ready(function(e) {
		ob = localStorage.getItem('frameX');	
		if(ob!=null){
			ob = $.parseJSON(ob);
		if(ob.name!=undefined){
			
			$('#ten_commnet1').val(ob.name);
			$('#dienthoai_commnet1').val(ob.phone);
			$('#email_commnet1').val(ob.email);	
			
		}
		 
		}
		//Click vào nút xem bình luận con
		$('.item_comment1').each(function(index, element) {
            var bl_con = $(this).next('.box_commnet').find('>.item_comment1').length;
			if(bl_con>0){
				$(this).find('.bl_con').find('.rutgon').html('<?=_xemthem?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).find('.bl_con').find('.so_bl_con').html('('+bl_con+')');
			}
        });
		
		//Click vào nút xem bình luận con
        /*$('.item_comment1 .bl_con').click(function(){});*/
		$(document).on('click','.item_comment1 .bl_con',function() {
			if($(this).hasClass('active_bl_con')){
				$(this).removeClass('active_bl_con');
				$(this).find('.rutgon').html('<?=_xemthem?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).parents('.item_comment1:first').next('.box_commnet').find('>.item_comment1').hide(300);
			}else{
				$(this).addClass('active_bl_con');
				$(this).find('.rutgon').html('<?=_thugon?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).parents('.item_comment1:first').next('.box_commnet').find('>.item_comment1').show(300);
			}
		});
		
		//Click vào trả lời
        /*$('.item_comment1 .traloi1').click(function(){});*/
		$(document).on('click','.item_comment1 .traloi1',function() {
			$('.comment_old1 .comment1').remove();
			var comment = $('.comment1').html();
			var root = $(this).parents('.item_comment1');
			var id_parent = $(this).attr('data-id');
			root.append('<div class="comment1 comment_add">'+comment+'</div>');
			$('.comment1 #parent_id').val(id_parent);
			loadRecapchatFrm('recaptchaResponse_hoidap','hoidap');
			return false;
		});
		//Click vào nút gửi
		$(document).on('click','#huy_commnet1',function() {
			var root = $(this).parents('.item_comment1');
			$(root).find('.comment_add').remove();
			return false;
		});
		
		$(document).on('click','#gui_commnet1',function() {
			var root = $(this).parents('.item_comment1');
			if(isEmpty(root.find('#noidung_comment1').val(), "<?=_nhapnoidung?>")){
				root.find('#noidung_comment1').focus();
				return false;
			}
			<?php /*if(root.find('#noidung_comment1').val().length<30 || root.find('#noidung_comment1').val().length>1000){
				alert("<?=_tu30den1000?>");
				root.find('#noidung_comment1').focus();
				return false;
			}*/ ?>
			if(!root.find('.thongtin_commnet').hasClass('thongtin_commnet_active')){
				root.find('.thongtin_commnet').addClass('thongtin_commnet_active');
				root.find('.shadow').addClass('shadow_avtic');
			}else{
				alert("<?=_vuilongnhanguihoanthanh?>");
			}
			
			return false;
		});
		//Click vào nút Close comment
		$(document).on('click','.close_comment1',function() {
			var root = $(this).parents('.item_comment1');
			root.find('.thongtin_commnet').removeClass('thongtin_commnet_active');
			root.find('.shadow').removeClass('shadow_avtic');
				
			/*root.find('.thongtin_commnet').slideUp(300);
			root.find('.thongtin_commnet').removeClass('daclick');*/
		});
		//Click vào nút gửi và hoàn tất
		$(document).on('click','#hoantat_commnet1',function() {
			var root = $(this).parents('.item_comment1');
			
			if(isEmpty(root.find('#ten_commnet1').val(), "<?=_nhaphoten?>")){
				root.find('#ten_commnet1').focus();
				return false;
			}
			if(isEmpty(root.find('#dienthoai_commnet1').val(),"Xin nhập số điện thoại")){
				root.find('#dienthoai_commnet1').focus();
				return false;
			}
			if(isEmpty(root.find('#email_commnet1').val(), "<?=_emailkhonghople?>")){
				root.find('#email_commnet1').focus();
				return false;
			}
			if(isEmail(root.find('#email_commnet1').val(), "<?=_emailkhonghople?>")){
				root.find('#email_commnet1').focus();
				return false;
			}
			
			<?php /*var product_id = "<?=$id?>";
			var parent_id = parseInt(root.find('.traloi1').data('id'));
			var ten = root.find('#ten_commnet1').val();
			var email = root.find('#email_commnet1').val();
			var dienthoai = root.find('#dienthoai_commnet1').val();
			var mota = root.find('#noidung_comment1').val();
			
			var type_comment = root.find('#type_comment').val();
			var type = "<?=$type?>";
			add_comment1(ten,email,dienthoai,mota,parent_id,type_comment,type,product_id);*/?>
			loadRecapchatFrm('recaptchaResponse_hoidap','hoidap');
			
			
			
			var ob = { 'name': root.find('#ten_commnet1').val(), 'phone': root.find('#dienthoai_commnet1').val(), 'email': root.find('#email_commnet1').val()};

			localStorage.setItem('frameX', JSON.stringify(ob));			
			
			add_comment1();
			
			root.find('.thongtin_commnet').removeClass('thongtin_commnet_active');
			root.find('.shadow').removeClass('shadow_avtic');

			return false;
		});
    });
	
	//Hàm thêm comment vào database
	<?php /*function add_comment1(ten,email,dienthoai,mota,parent_id,type_comment,type,product_id){}*/?>
	function add_comment1(){
			$.ajax({
				type:'post',
				url:'ajax/hoidap.php',
				<?php /*data:{ten:ten,email:email,dienthoai:dienthoai,mota:mota,parent_id:parent_id,type_comment:type_comment,type:type,product_id:product_id},*/?>
				data:$(".frm_hoidap").serialize(),
				dataType:'json',
				error: function(){
					add_popup('<?=_hethongloi?>');
					loadRecapchatFrm('recaptchaResponse_hoidap','hoidap');
				},
				success:function(kq){
					// add_popup(kq.thongbao);
					$('.comment_add').remove();
					$('#ten_commnet1').val('');
					$('#email_commnet1').val('');
					$('#dienthoai_commnet1').val('');
					$('#noidung_comment1').val('');
					loadRecapchatFrm('recaptchaResponse_hoidap','hoidap');
					 
				}
			});	
		}
		
		$(document).on('click','.hailong1',function() {
			if($(this).hasClass('rate-like')){
				$(this).removeClass('rate-like');
				$(this).addClass('rate-liked');
				var id=$(this).attr('data-id');
				var field=$(this).attr('data-field');
				var type= 1;
 			}else if($(this).hasClass('rate-liked')){
				$(this).removeClass('rate-liked');
				$(this).addClass('rate-like');
				var id=$(this).attr('data-id');
				var field=$(this).attr('data-field');
				var type= 2;
 			}  
			$.ajax({
				type:'post',
				url:'ajax/hailong.php',
				data:{id:id,type:type,field:field},
				dataType:'json',
				error: function(){
					add_popup('<?=_hethongloi?>');
				},
				success:function(kq){
 					$('#'+field+'_'+id).find('font').html(kq.luotthich);
 				}
			});	
		});
</script>

<p class="fs-dtrtcmti2">Hỏi đáp về <?=$row_detail['ten']?></p>
<div class="comment1 item_comment1 count_<?=$binhluan1['count']?>">
	<form method="post" name="frm_hoidap" class="frm_hoidap" action="" enctype="multipart/form-data">
		<input type="hidden" name="type" id="type" value="<?=$type?>" />
		<input type="hidden" name="product_id" id="product_id" value="<?=$id?>" />
		<input type="hidden" name="parent_id" id="parent_id" value="0" />
		<textarea name="noidung_comment1" id="noidung_comment1" rows="5" placeholder="<?=_nhaptiengvietcodau?>"></textarea>
		<div class="line_comment">
			<input type="button" value="HỦY" id="huy_commnet1" />
			<input type="button" value="Gửi câu hỏi" id="gui_commnet1" />
		</div>
		<div class="thongtin_commnet">
			<span class="close_comment1">X Close</span>
			<p class="ghichu_commnet" style="padding-bottom:0;"><span>Hoàn thành gửi nhận xét</span></p>
			<div class="thongtin_commnet1 clearfix">
			 
				<input type="hidden" name="score" id="score" value="3"/>
				<input type="hidden" name="type_comment" id="type_comment" value="hoidap"/>
				
				<div class="item_dknt clearfix"> 
					<span>Họ tên</span>
					<div>
						<input type="text" placeholder="Nhập họ tên" name="ten_commnet1" id="ten_commnet1" />
					</div>
				</div>
				<div class="item_dknt clearfix"> 
					<span>Điện thoại</span>
					<div>
						<input type="text" placeholder="Nhập số điện thoại" name="dienthoai_commnet1" id="dienthoai_commnet1"/>
					</div>
				</div>
				<div class="item_dknt clearfix"> 
					<span>Email</span>
					<div>
						<input type="email" placeholder="<?=_nhapemail?>" name="email_commnet1" id="email_commnet1" />
					</div>
				</div>
				<div class="item_dknt clearfix"> 
					<span>&nbsp;</span>
					<div class="r-dknt">
						Vui lòng nhập thông tin để hoàn thành gửi nhận xét
					</div>
				</div>
				<input type="hidden" id="recaptchaResponse_hoidap" name="recaptcha_response_hoidap">
				
				
				<input type="button" value="<?=_guivahoantat?>" id="hoantat_commnet1" />
			</div>
		</div>
	</form>
	<div class="clear"></div>
	<div class="shadow"></div>
</div>

<div class="comment_old1">
	<div class="bx_ww_content" ></div>
	<?php //show_comment1($binhluan1,0,''); ?>
</div>