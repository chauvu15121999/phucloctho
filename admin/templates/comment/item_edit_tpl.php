<?php
	require_once "../sources/lang.php";
	//bình luận
	$id = $_GET['product_id'];
	$type = $_GET['type'];
	$comment_type = $_GET['comment_type'];
		
	if($type=='san-pham'){
		$tbl='product';
	}else{
		$tbl='news';
	}
	if($comment_type=='hoidap'){
		$tt_title='hỏi đáp';
	}else{
		$tt_title='nhận xét';
	}
	
	$d->reset();
	$sql = "select id,ten$lang,mota$lang as mota,parent_id,ngaytao,hienthi,qtv FROM #_comment where type='".$type."' and comment_type='".$comment_type."' and product_id='".$id."' order by ngaytao";
	$d->query($sql);
	$binhluan = $d->result_array();
	
	$d->reset();
	$sql = "select id,ten$lang FROM #_".$tbl." where type='".$type."' and id='".$id."' order by ngaytao";
	$d->query($sql);
	$tensp = $d->fetch_array();
	
	function show_comment($arr_dacap, $parent_id = 0, $kytu = '')
	{
		if($parent_id==0){ 
			$no_tl='';
		}else{
			$no_tl='none';
		}
		echo '<div class="box_commnet">';
		foreach ($arr_dacap as $key => $value)
		{
			
			// Nếu là chuyên mục con thì hiển thị
			if($value['parent_id'] == $parent_id)
			{
				if($kytu.$value['hienthi']==1)$an_hienthi = 'diamondToggleOff'; else $an_hienthi = '';
				
				if($value['qtv']==1){
					$qtv='<font class="qtv">QTV</font>';
					$mota= nl2br2($kytu.$value['mota']);
				}else{
					$qtv='';
					$mota= nl2br2($kytu.$value['mota']);
				}
				echo '<div class="item_comment">
					<p class="td_comment"><span>'.substr($kytu.$value['ten'],0,1).'</span>'.$kytu.$value['ten'].$qtv.'<b class="an_hienthi">Thao tác <a data-val2="table_comment" rel="'.$kytu.$value['hienthi'].'" data-val3="hienthi" data-val0="'.$kytu.$value['id'].'" class="diamondToggle '.$an_hienthi.'" title="Duyệt bình luận"></a><a href="index.php?com=comment&act=delete&product_id='.$_GET['product_id'].'&type='.$_GET['type'].'&comment_type='.$_GET['comment_type'].'&id='.$kytu.$value['id'].'" title="Xóa bình luận này"><img src="./images/icons/dark/close.png" alt=""></a></b>
					</p>
					<div class="tl_comment">'.$mota.'</div>
					<div class="ngaytao_comment"><span class="traloi '.$no_tl.'" data-id="'.$kytu.$value['id'].'">'._traloi.'</span><span>'.humanTiming($kytu.$value['ngaytao']).'</span><span class="bl_con"><span class="rutgon"></span><span class="so_bl_con"></span></span></div>
				</div>';
				// Xóa chuyên mục đã lặp
				unset($arr_dacap[$key]); 
				// Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
				show_comment($arr_dacap, $value['id'], '');
			}
		}
		echo '<div class="clear"></div></div>';
	}
?>
<style>
	.qtv{font-size: 12px; display:inline-block; color:#fff; line-height:1.4; background: #d0011b; font-weight:normal; padding: 1px 6px; margin-left: 8px;}

</style>
<link href="css/comment.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/my_script.js"></script>
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
        $('.item_comment .bl_con').click(function(){
			if($(this).hasClass('active_bl_con'))
			{
				$(this).removeClass('active_bl_con');
				$(this).find('.rutgon').html('<?=_xemthem?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).parents('.item_comment:first').next('.box_commnet').find('>.item_comment').hide(300);

			}
			else
			{
				$(this).addClass('active_bl_con');
				$(this).find('.rutgon').html('<?=_thugon?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).parents('.item_comment:first').next('.box_commnet').find('>.item_comment').show(300);
			}
		});
		
		//Click vào nút gửi
		$(document).on('click','#huy_commnet1',function() {
			var root = $(this).parents('.item_comment');
			$(root).find('.comment_add').remove();
			return false;
		});
		//Click vào trả lời
        $('.item_comment .traloi').click(function(){
			$('.comment_old .comment').remove();
			var comment = $('.comment').html();
			var root = $(this).parents('.item_comment');
			root.append('<div class="comment comment_add">'+comment+'</div>');
			$('.comment #parent_id').val(id_parent);
			return false;
		});
		//Click vào nút gửi
		/*$(document).on('click','#gui_commnet',function() {
			var root = $(this).parents('.item_comment');
			if(isEmpty(root.find('#noidung_comment').val(), "<?=_nhapnoidung?>")){
				root.find('#noidung_comment').focus();
				return false;
			}if(root.find('#noidung_comment').val().length<30 || root.find('#noidung_comment').val().length>1000){
				alert("<?=_tu30den1000?>");
				root.find('#noidung_comment').focus();
				return false;
			}if(!root.find('.thongtin_commnet').hasClass('daclick')){
				root.find('.thongtin_commnet').slideDown(300);
				root.find('.thongtin_commnet').addClass('daclick');
			}else{
				alert("<?=_vuilongnhanguihoanthanh?>");
			}
			return false;
		});*/
		//Click vào nút Close comment
		$(document).on('click','.close_comment',function() {
			var root = $(this).parents('.item_comment');
			root.find('.thongtin_commnet').slideUp(300);
			root.find('.thongtin_commnet').removeClass('daclick');
		});
		//Click vào nút gửi và hoàn tất
		$(document).on('click','#hoantat_commnet',function() {
			var root = $(this).parents('.item_comment');
			
			if(isEmpty(root.find('#ten_commnet').val(), "<?=_nhaphoten?>")){
				root.find('#ten_commnet').focus();
				return false;
			}
			
			if(isEmpty(root.find('#noidung_comment').val(), "<?=_nhapnoidung?>")){
				root.find('#noidung_comment').focus();
				return false;
			}
			/*if(root.find('#noidung_comment').val().length<30 || root.find('#noidung_comment').val().length>1000){
				alert("<?=_tu30den1000?>");
				root.find('#noidung_comment').focus();
				return false;
			}*/ 
			 
			
			var product_id = "<?=$id?>";
			var parent_id = parseInt(root.find('.traloi').data('id'));
			var ten = root.find('#ten_commnet').val();
			var mota = root.find('#noidung_comment').val();
			var qtv = root.find('#qtv').val();
			 
			
			var type = "<?=$type?>";
			var comment_type = "<?=$comment_type?>";
			add_comment(ten,mota,qtv,parent_id,type,comment_type,product_id);
			return false;
		});
    });
	
	//Hàm thêm comment vào database
	function add_comment(ten,mota,qtv,parent_id,type,comment_type,product_id){
			$.ajax({
				type:'post',
				url:'ajax/comment.php',
				data:{ten:ten,mota:mota,qtv:qtv,parent_id:parent_id,type:type,comment_type:comment_type,product_id:product_id},
				dataType:'json',
				error: function(){
					alert('<?=_hethongloi?>');
				},
				success:function(kq){
					alert(kq.thongbao);
					$('.comment_add').remove();
					location.reload();
				}
			});	
		}
</script>
<div style="background:#fff; padding:5px 10px; margin-top:30px;">
<div class="widget" style="margin-top:0;">
	<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
		<h6>Có (<?=count($binhluan)?>) <?=$tt_title?> về <?=$tensp['ten'.$lang]?></h6>
	</div>
</div>
<div class="comment item_comment none">
        	<input type="hidden" id="parent_id" value="0" />
            <textarea name="noidung_comment" id="noidung_comment" rows="5" placeholder="<?=_nhaptiengvietcodau?>"></textarea>
         
            <input type="text" placeholder="<?=_nhaphoten?>" id="ten_commnet" />
			
			<a rel="0" class="diamondToggle1" title=""></a>Quản trị viên
			<input type="hidden" value="0" id="qtv" />
			<div>&nbsp;<br/></div>
			<input type="button" value="HỦY" id="huy_commnet1" />
            <input type="button" value="<?=_guivahoantat?>" id="hoantat_commnet" />
        <div class="clear"></div>
</div>

<div class="comment_old">
	<?php show_comment($binhluan,0,''); ?>
</div>
</div>