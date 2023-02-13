<?php if($_GET['type']=='tuvan'){ ?>
<style type="text/css">
	.gioihan_div{max-height:500px; overflow-y: auto;}
</style>
<?php } ?>
<?php
	$_SESSION['backlink']=getCurrentPageURL();
	$huy = ($_REQUEST['huy']==1) ? 1 : 0;
	$type = htmlspecialchars($_REQUEST['type']);

	$d->reset();
	$d->query("select count(id) as tongdk from table_lienhe where type='$type' and huy=0");
	$r = $d->fetch_array();
	$tongdk = $r['tongdk'];

	$tonghuy = 0;
	if($huy == 0){
		$d->reset();
		$d->query("select count(id) as tong_huy from table_lienhe where type='$type' and huy=1");
		$r = $d->fetch_array();
		$tonghuy = $r['tong_huy'];
	}
?>
<script language="javascript" type="text/javascript">

	$(document).ready(function() {
		$("#chonhet").click(function(){
			var status=this.checked;
			$("input[name='chon']").each(function(){this.checked=status;})
		});
		
		$("#xoahet").click(function(){
			var listid="";
			$("input[name='chon']").each(function(){
				if (this.checked) listid = listid+","+this.value;
				})
			listid=listid.substr(1);	 //alert(listid);
			if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
			hoi= confirm("Bạn có chắc chắn muốn xóa?");
			if (hoi==true) document.location = "index.php?com=lienhe&act=delete&type=<?=$_REQUEST['type']?>&listid=" + listid;
		});

		$("#bohuy").click(function(){
			var listid="";
			$("input[name='chon']").each(function(){
				if (this.checked) listid = listid+","+this.value;
			})
			listid=listid.substr(1);	 //alert(listid);
			if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
			hoi= confirm("Bạn có chắc chắn muốn bỏ hủy?");
			if (hoi==true) document.location = "index.php?com=lienhe&act=bohuy&type=<?=$_REQUEST['type']?>&listid=" + listid;
		});
		
		$("#show_email").click(function(){
			var listid="";
			$("input[name='chon']").each(function(){
				if (this.checked) listid = listid+","+this.value;
				})
			listid=listid.substr(1);	 //alert(listid);
			
			if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
			hoi= confirm("Bạn có chắc chắn muốn gửi mail đến danh sách đã chọn?");
			$('#listid').val(listid);
			document.getElementById("frm_email").submit();
			
		 
		});
	});
	
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{	
		var a = $('input.key').val();	if(a=='Tên...') a='';		
		window.location ="index.php?com=lienhe&act=man&type=<?=$_REQUEST['type']?>&key="+a;	
		return true;
	}
</script>
<style>
	.pages li a:hover,.pages li a.current{ background:#e2e0e0;}
	.bx_ww_content  tr td:nth-child(1) input{ display:block; margin:auto;}
</style>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=lienhe&act=man&type=<?=$_REQUEST['type']?>"><span>Thư liên hệ</span></a></li>
        	<?php if($_GET['key']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['key']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<style type="text/css">
	.ds_huy{float: right; margin-left: 20px;}
	.ds_huy a{display: inline-block;}
</style>
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=lienhe&act=add&type=<?=$_REQUEST['type']?>'" />
        <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />
        <?php if($huy==1){ ?><input type="button" class="blueB" value="Bỏ Hủy" id="bohuy" /><?php } ?>
        <div class="ds_huy">
        	<?php if($huy==0){ ?>
        		<input type="button" class="redB" value="Danh sách hủy (<?=number_format($tonghuy,0,',','.')?>)" onclick="location.href='index.php?com=lienhe&act=man&type=<?=$_GET['type']?>&huy=1'" />
	        <?php }else{ ?>
	        	<input type="button" class="redB" value="trở về Danh sách nhận email (<?=number_format($tongdk,0,',','.')?>)" onclick="location.href='index.php?com=lienhe&act=man&type=<?=$_GET['type']?>'" />
	        <?php } ?>
        </div>
    </div>  
</div>
<form name="frm_email" id="frm_email" method="post" action="" enctype="multipart/form-data" class="form ">
	<div class="widget">
		<div class="title">
			<span class="titleIcon">
				<input type="checkbox" id="chonhet" name="titleCheck" />
				<input type="hidden" id="listid" name="listid" />
			</span>
			<h6>Chọn tất cả</h6>
			<div class="timkiem">
				<input type="text" value="" name="key" class="key" placeholder="Nhập từ khóa tìm kiếm ">
				<button type="button" class="blueB" onclick="timkiem();"  value="">Tìm kiếm</button>
			</div>
		</div>
		<div class="gioihan_div">
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
				<thead>
					<tr>
						<td></td>
						<td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">STT</a></td>
						<td width="200"><div>Tên<span></span></div></td>
						<td width="200"><div>Tên công ty<span></span></div></td>
						<td width="200"><div>Điện thoại<span></span></div></td>
						<td width="200"><div>Email<span></span></div></td>
						<?php /*<td class="sortCol"><div>Chủ đề<span></span></div></td>*/?>
						<?php if($huy==1){ ?>
							<td width="200">Lý do hủy</td>
						<?php }else{ ?>
							<td class="tb_data_small">Đã đọc</td>
						<?php } ?>
						<td width="200">Thao tác</td>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="10"></td>
					</tr>
				</tfoot>
				<tbody class="bx_ww_content load_page" data-id="<?=$_GET['type']?>">
					 
				</tbody>
			</table>
		</div>
		<?php /*<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>*/?>
	</div>
	<div class="widget">
        <div class="formRow">
			<label>Tiêu đề</label>
			<div class="formRight">
				<input type="text" name="tieude" class="tipS"/>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>File đính kèm</label>
			<div class="formRight">
				<input type="file" name="file" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<?php /*<div class="formRow">
			<label>Nội dung</label>
			<div class="formRight">
				<textarea name="noidung_email" class="ck_editor" id="noidung_email"></textarea>
			</div>
			<div class="clear"></div>
		</div>*/?>
		<div class="formRow">
			<?php include "mail.php";?>
		</div>
		
		<div class="formRow">
			<label>&nbsp;</label>
			<div class="formRight">
				<input type="button" name="show_email" id="show_email" value="Gửi" class="blueB" />
			</div>
			<div class="clear"></div>
		</div>
	</div><!-- /.box -->
</form>

<script type="text/javascript">
	function loadProduct(page, content,id,key , huy=0){
		$.ajax({
			<?php if($_GET['type']=='tuvan'){ ?>
				url: 'paging_ajax/ajax_paging_tuvan.php',
			<?php }else{ ?>
				url: 'paging_ajax/ajax_paging.php',
			<?php } ?>
			type: 'POST',
			dataType: 'html',
			data: {page:page,id:id,key:key,huy:huy},
		})
		.done(function(result) {
			$(content).html(result);
			$(content+" .pagination li a").click(function(e){
				e.preventDefault();
				if($.isNumeric($(this).text())){
					var pager = $(this).text();
				}else{
					var pager = $(this).data("page");
				}
				loadProduct(pager, content,id,key,huy);
				$('html,body').animate({scrollTop:$(content).offset().top-30},'slow');
			});
			var w=$('.withCheck tr td').first().width(); 
			$('.titleIcon').css({'width':w+'px'});
		})
		.fail(function() {
			console.log("error");
		});
	}
	$().ready(function(){
		$('.bx_ww_content').each(function(index, element) {
			var id=$(this).attr('data-id');;
			var key='<?=$_REQUEST['key']?>';
			var huy= <?=($_REQUEST['huy']==1) ? 1 : 0;?>;
			loadProduct(1,".load_page",'<?=$_GET['type']?>',key , huy);
		}); 
	});
</script>
 



 
</div> 
