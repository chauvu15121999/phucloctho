<?php
	//bình luận
	$d->reset();
	$sql = "select id,ten$lang,mota$lang as mota,parent_id,ngaytao,score,luotthich,qtv FROM #_comment where type='".$type."' and product_id='".$id."' and comment_type='nhanxet' and hienthi=1 order by ngaytao";
	$d->query($sql);
	$binhluan = $d->result_array();
	
	/*function show_comment($arr_dacap, $parent_id = 0, $kytu = ''){
		echo '<div class="box_commnet">';
		
		foreach ($arr_dacap as $key => $value){
			// Nếu là chuyên mục con thì hiển thị
			$star='';
			if($value['parent_id'] == $parent_id){
				if($value['qtv']==1){
					$qtv='<span class="qtv">QTV</span>';
				}else{
					$qtv='';
				}
				
				echo '<div class="item_comment">';
				$star.='<i class="star_cm">';
				for($i=0;$i<5;$i++){
					if($i<$value['score']){
						$st='on';
					}else{
						$st='off';
					}
				$star.='<img src="img/star-'.$st.'.png"/>';	
				}
				$star.='</i>';
				if($parent_id==0){
				echo '<div>'.$star.'</div>';
				}
				echo '<div class="td_comment">Bởi: <b>'.$kytu.$value['ten'].'</b> ';
				
				/*echo '<div class="td_comment"><span class="first_cap">'.substr($kytu.$value['ten'],0,1).'</span>'.$kytu.$value['ten'].' ';* /
				
				echo $qtv.'<div class="ngaytao_comment">
					<span>'.humanTiming($kytu.$value['ngaytao']).'</span>
				</div>';
				
				echo '</div>';
					
				echo '<div class="tl_comment">'.$kytu.$value['mota'].'</div>';
				echo '<p class="fs-dttrlike rate-like" id="like_'.$kytu.$value['id'].'" data-id="'.$kytu.$value['id'].'"><span><i class="icdt irtlike"></i>'.$kytu.$value['luotthich'].'</span></p>';
				
				echo '</div>';
				// Xóa chuyên mục đã lặp
				unset($arr_dacap[$key]); 
				// Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
				show_comment($arr_dacap, $value['id'], '');
			}
		}
		echo '<div class="clear"></div></div>';
	}*/
?>
<script type="text/javascript">
	$(document).ready(function(e) {
		//Click vào nút xem bình luận con
		$('.item_comment').each(function(index, element) {
            var bl_con = $(this).next('.box_commnet').find('>.item_comment').length;
			if(bl_con>0)
			{
				$(this).find('.bl_con').find('.rutgon').html('<?=_xemthem?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).find('.bl_con').find('.so_bl_con').html('('+bl_con+')');
			}
        });
		
		//Click vào nút xem bình luận con
        
		/*$('.item_comment .bl_con').click(function(){});*/
		$(document).on('click','.item_comment .bl_con',function() {
			if($(this).hasClass('active_bl_con')){
				$(this).removeClass('active_bl_con');
				$(this).find('.rutgon').html('<?=_xemthem?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).parents('.item_comment:first').next('.box_commnet').find('>.item_comment').hide(300);

			}else{
				$(this).addClass('active_bl_con');
				$(this).find('.rutgon').html('<?=_thugon?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).parents('.item_comment:first').next('.box_commnet').find('>.item_comment').show(300);
			}
		});
		
		//Click vào trả lời
       <?php /* $('.item_comment .traloi').click(function(){
			$('.comment_old .comment').remove();
			var comment = $('.comment').html();
			var root = $(this).parents('.item_comment');
			root.append('<div class="comment comment_add">'+comment+'</div>');
			return false;
		});*/?>
		//Click vào nút gửi
		$(document).on('click','#gui_commnet',function() {
			var root = $(this).parents('.item_comment');
			
			if(isEmpty(root.find('#noidung_comment').val(), "<?=_nhapnoidung?>"))
			{
				root.find('#noidung_comment').focus();
				return false;
			}
			<?php /*if(root.find('#noidung_comment').val().length<30 || root.find('#noidung_comment').val().length>1000)
			{
				alert("<?=_tu30den1000?>");
				root.find('#noidung_comment').focus();
				return false;
			}*/?>
			if(!root.find('.thongtin_commnet').hasClass('thongtin_commnet_active'))
			{
				root.find('.thongtin_commnet').addClass('thongtin_commnet_active');
				root.find('.shadow').addClass('shadow_avtic');
				//root.find('.thongtin_commnet').addClass('daclick');
			}
			else
			{
				alert("<?=_vuilongnhanguihoanthanh?>");
			}
			
			return false;
		});
		//Click vào nút Close comment
		$(document).on('click','.close_comment',function() {
			var root = $(this).parents('.item_comment');
			root.find('.thongtin_commnet').removeClass('thongtin_commnet_active');
			root.find('.shadow').removeClass('shadow_avtic');
				
			/*root.find('.thongtin_commnet').slideUp(300);
			root.find('.thongtin_commnet').removeClass('daclick');*/
		});
		//Click vào nút gửi và hoàn tất
		$(document).on('click','#hoantat_commnet',function() {
			var root = $(this).parents('.item_comment');
			
			if(isEmpty(root.find('#ten_commnet').val(), "<?=_nhaphoten?>"))
			{
				root.find('#ten_commnet').focus();
				return false;
			}
			if(isEmpty(root.find('#dienthoai_commnet').val(), "Xin nhập số điện thoại"))
			{
				root.find('#dienthoai_commnet').focus();
				return false;
			}
			if(isEmpty(root.find('#email_commnet').val(), "<?=_emailkhonghople?>"))
			{
				root.find('#email_commnet').focus();
				return false;
			}
			if(isEmail(root.find('#email_commnet').val(), "<?=_emailkhonghople?>"))
			{
				root.find('#email_commnet').focus();
				return false;
			}
			
			<?php /*var product_id = "<?=$id?>";
			var parent_id = parseInt(root.find('.traloi').data('id'));
			var ten = root.find('#ten_commnet').val();
			var email = root.find('#email_commnet').val();
			var dienthoai = root.find('#dienthoai_commnet').val();
			var mota = root.find('#noidung_comment').val();
			var score = root.find('#score').val();
			var type_comment = root.find('#type_comment').val();
			var type = "<?=$type?>";
			add_comment(ten,email,dienthoai,mota,score,parent_id,type_comment,type,product_id);*/?> 
			loadRecapchatFrm('recaptchaResponse_nhanxet','nhanxet');
			add_comment();
			root.find('.thongtin_commnet').removeClass('thongtin_commnet_active');
			root.find('.shadow').removeClass('shadow_avtic');

			return false;
		});
		
		/*$('.fs-dttrlike').click(function(){});*/
		$(document).on('click','.fs-dttrlike',function() {
			if($(this).hasClass('rate-like')){
				$(this).removeClass('rate-like');
				$(this).addClass('rate-liked');
				var id=$(this).attr('data-id');
				var type= 1;
 			}else if($(this).hasClass('rate-liked')){
				$(this).removeClass('rate-liked');
				$(this).addClass('rate-like');
				var id=$(this).attr('data-id');
				var type= 2;
 			}  
			$.ajax({
				type:'post',
				url:'ajax/like.php',
				data:{id:id,type:type},
				dataType:'json',
				error: function(){
					add_popup('<?=_hethongloi?>');
				},
				success:function(kq){
 					$('#like_'+id).html(kq.luotthich);
 				}
			});	
		});
    });
	
	//Hàm thêm comment vào database
	<?php /*function add_comment(ten,email,dienthoai,mota,score,parent_id,type_comment,type,product_id){}*/?>
	function add_comment(){
			$.ajax({
				type:'post',
				url:'ajax/comment.php',
				<?php /*data:{ten:ten,email:email,dienthoai:dienthoai,mota:mota,score:score,parent_id:parent_id,type_comment:type_comment,type:type,product_id:product_id},*/?>
				data:$(".frm_nhanxet").serialize(),
				dataType:'json',
				error: function(){
					add_popup('<?=_hethongloi?>');
					loadRecapchatFrm('recaptchaResponse_nhanxet','nhanxet');
				},
				success:function(kq){
					<?php /*add_popup(kq.thongbao);*/?>
					$('.comment_add').remove();
					$('#ten_commnet').val('');
					$('#email_commnet').val('');
					$('#dienthoai_commnet').val('');
					$('#noidung_comment').val('');
					$('#score').val('3');
					loadRecapchatFrm('recaptchaResponse_nhanxet','nhanxet');
				}
			});	
		}
</script>
<script>
	$(function() {
		$('div#rate').raty({
			start: 3,
			scoreName: 'general-score',
 		});
		
		$('.rate').hover(function(){
			var op= $(this).attr('title');
			var title= $('.small').attr('title');
			$('.small').html(op);
		}); 
		$( ".rate" ).mouseout(function() {
			var op= $(this).attr('title');
			var title= $('.small').attr('title');
			$('.small').html(title);
		});
	 
		$('.rate').click(function(){
			var op= $(this).attr('title');
			var score= $(this).attr('alt');
			$('.small').attr('title',op);
			$('.small').html(op);
			$('#score').val(score);
		});
		
	});
</script>
<style>
	
</style>
<p class="fs-dtrtcmti21">Đánh giá & nhận xét <?=$row_detail['ten']?></p>
<div class="box_content_rates">
	<div class="item_rates">
		<div>
			<div class="pointer_rates"><?=round($sao,1)?>/5</div>
			<div class="star_rates">
				<?php  /*for($i=0;$i<5;$i++){?>
					<img src="img/<?php if($i<$sao){ echo 'star-on.png';}else{ echo 'star-off.png';}?>"/>
				<?php }*/ ?>
				<img src="img/<?php if($sao>0 && $sao<0.5){ echo 'star-haff.png';}else if($sao>=0.5){ echo 'star-on.png';}else{ echo 'star-off.png';}?>"/>
				<img src="img/<?php if($sao>1 && $sao<1.5){ echo 'star-haff.png';}else if($sao>=1.5){ echo 'star-on.png';}else{ echo 'star-off.png';}?>"/>
				<img src="img/<?php if($sao>2 && $sao<2.5){ echo 'star-haff.png';}else if($sao>=2.5){ echo 'star-on.png';}else{ echo 'star-off.png';}?>"/>
				<img src="img/<?php if($sao>3 && $sao<3.5){ echo 'star-haff.png';}else if($sao>=3.5){ echo 'star-on.png';}else{ echo 'star-off.png';}?>"/>
				<img src="img/<?php if($sao>4 && $sao<4.5){ echo 'star-haff.png';}else if($sao>=4.5){ echo 'star-on.png';}else{ echo 'star-off.png';}?>"/>
				
			</div>
			<div class="count_rates"><?=$luot?> đánh giá & nhận xét</div>
		</div>
	</div>
	<div class="item_rates">
		<div>
			<div class="num_of_rate clearfix">
				<span>5 sao</span>
				<span><i style="background: #2a7709; width: <?=get_per_rates($id,5)?>%; height:5px; display:block;"></i></span>
				<span><?=get_num_of_rates($id,5)?></span>
			</div>
			<div class="num_of_rate clearfix">
				<span>4 sao</span>
				<span><i style="background: #2a7709; width: <?=get_per_rates($id,4)?>%; height:5px; display:block;"></i></span>
				<span><?=get_num_of_rates($id,4)?></span>
			</div>
			<div class="num_of_rate clearfix">
				<span>3 sao</span>
				<span><i style="background: #2a7709; width: <?=get_per_rates($id,3)?>%; height:5px; display:block;"></i></span>
				<span><?=get_num_of_rates($id,3)?></span>
			</div>
			<div class="num_of_rate clearfix">
				<span>2 sao</span>
				<span><i style="background: #f6a623; width: <?=get_per_rates($id,2)?>%; height:5px; display:block;"></i></span>
				<span><?=get_num_of_rates($id,2)?></span>
			</div>
			<div class="num_of_rate clearfix">
				<span>1 sao</span>
				<span><i style="background: #f00; width: <?=get_per_rates($id,1)?>%; height:5px; display:block;"></i></span>
				<span><?=get_num_of_rates($id,1)?></span>
			</div>
		</div>
	</div>
	<div class="item_rates">
		<div>
			<p class="dadungsp">Bạn đã dùng sản phẩm này?</p>
			<button class="guidanhgia">Gửi đánh giá của bạn</button>
		</div>
	</div>
</div>
<div class="comment_hide">
<div class="comment item_comment">
	<p class="fs-dtrtcmti2">Bạn chấm sản phẩm này bao nhiêu sao?</p>
	<div class="detail"> 
		<div id="rate" class="score" style=""></div>
		<p class="small" title="Bình thường">Bình thường</p>
	</div>
	<form method="post" name="frm_nhanxet" class="frm_nhanxet" action="" enctype="multipart/form-data">
	
	
		<input type="hidden" name="type" id="type" value="<?=$type?>" />
		<input type="hidden" name="product_id" id="product_id" value="<?=$id?>" />
		<input type="hidden" name="parent_id" id="parent_id" value="0" />
		<textarea name="noidung_comment" id="noidung_comment" rows="5" placeholder="<?=_nhaptiengvietcodau?>"></textarea>
		
		
		<div class="line_comment">
			<p>Một đánh giá có ích thường dài từ 100 ký tự trở lên</p>
			<ul>
				<li>
					<input type="button" value="<?=_gui?>" id="gui_commnet" />
				</li>
			</ul>
		</div>
		<div class="thongtin_commnet">
			<span class="close_comment">X Close</span>
			<p class="ghichu_commnet" style="padding-bottom:0;"><span>Hoàn thành gửi nhận xét</span></p>
			<div class="thongtin_commnet1 clearfix">
				 
				<input type="hidden" name="score" id="score" value="3"/>
				<input type="hidden" name="type_comment" id="type_comment" value="nhanxet"/>
				
				<div class="item_dknt clearfix"> 
					<span>Họ tên</span>
					<div>
						<input type="text" placeholder="Nhập họ tên" name="ten_commnet" id="ten_commnet" />
					</div>
				</div>
				<div class="item_dknt clearfix"> 
					<span>Điện thoại</span>
					<div>
						<input type="text" placeholder="Nhập số điện thoại" name="dienthoai_commnet" id="dienthoai_commnet" />
					</div>
				</div>
				<div class="item_dknt clearfix"> 
					<span>Email</span>
					<div>
						<input type="email" placeholder="<?=_nhapemail?>" name="email_commnet" id="email_commnet" />
					</div>
				</div>
				<div class="item_dknt clearfix"> 
					<span>&nbsp;</span>
					<div class="r-dknt">
						Vui lòng nhập thông tin để hoàn thành gửi nhận xét
					</div>
				</div>
				<input type="hidden" id="recaptchaResponse_nhanxet" name="recaptcha_response_nhanxet">
				<input type="button" value="<?=_guivahoantat?>" id="hoantat_commnet" />
			</div>
		</div>
	</form>
	<div class="clear"></div>
	<div class="shadow"></div>
</div>
</div>
<?php if(count($binhluan)){?>
<div class="title_comment_cap clearfix">
	Nhận xét của khách hàng (<?=count($binhluan)?>)
	<div class="right_title_comment_cap">
		<span class="sort_cm sort_active" data-id="ngaytao">Mới nhất</span>
		<span class="sort_cm" data-id="luotthich">Hữu ích nhất</span>
	</div>
</div>
<?php }?>
<div class="comment_old show_nhanxet">
	<?php //show_comment($binhluan,0,''); ?>
</div>