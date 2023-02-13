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
			if (hoi==true) document.location = "index.php?com=comment&act=delete&type=<?=$_REQUEST['type']?>&listid=" + listid;
		});
	});
 
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});

	function timkiem(){
		var a = $('input.key').val();
		if(a=='Tên...') a='';
		window.location ="index.php?com=comment&act=man&type=<?=$_REQUEST['type']?>&key="+a;
		return true;
	}
</script>
 
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=comment&act=man&type=<?=$_REQUEST['type']?>"><span>Quản lý <?=$title_main ?></span></a></li>
        	<?php if($_GET['key']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['key']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="frm" id="frm" method="post" action="index.php?com=comment&act=savestt<?php if($_REQUEST['id_list']!='') echo'&id_list='.$_REQUEST['id_list'];?><?php if($_REQUEST['id_cat']!='') echo'&id_cat='.$_REQUEST['id_cat'];?><?php if($_REQUEST['id_item']!='') echo'&id_item='.$_REQUEST['id_item'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	 
        <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />

    </div>
</div>
<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Chọn tất cả</h6>
    <div class="timkiem">
	    <input type="text" value="" name="key" class="key"  placeholder="Nhập từ khóa tìm kiếm ">
	    <button type="button" class="blueB" onclick="timkiem();" value="">Tìm kiếm</button>
    </div>
  </div>

  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
      <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">STT</a></td>
        <td width="200"><div>Tên<span></span></div></td>
        <td width="200"><div>Email<span></span></div></td>
        <td class="sortCol"><div>Tiêu đề bài viết<span></span></div></td>
        <td width="200"><div>Loại bài viết<span></span></div></td>
        <td class="sortCol"><div>Nội dung<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td class="tb_data_small">Đã đọc</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tbody>
		<?php for($i=0, $count=count($items); $i<$count; $i++){?>
		<tr>
			<td>
				<input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="chon" />
			</td>
			<td align="center">
				<input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_GET['com']?>" type="text" value="<?=$items[$i]['stt']?>" name="stt<?=$i?>" data-val3="stt" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText update_stt" onblur="stt(this)" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />
			</td>

		   
			<td class="">
				<a href="index.php?com=comment&act=edit&product_id=<?=$items[$i]['product_id']?>&type=<?=$items[$i]['type']?>&id=<?php if($items[$i]['parent_id']==0){ echo $items[$i]['id'];}else{ echo $items[$i]['parent_id'];}?>&comment_type=<?=$items[$i]['comment_type']?>" class="tipS SC_bold">
				<?=$items[$i]['ten']?>
				</a>
			</td> 
			<td>
				<a href="index.php?com=comment&act=edit&product_id=<?=$items[$i]['product_id']?>&type=<?=$items[$i]['type']?>&id=<?php if($items[$i]['parent_id']==0){ echo $items[$i]['id'];}else{ echo $items[$i]['parent_id'];}?>&comment_type=<?=$items[$i]['comment_type']?>" class="tipS SC_bold">
				<?=$items[$i]['email']?>
				</a>
			</td> 
			<td class="title_name_data">
				<a href="index.php?com=comment&act=edit&product_id=<?=$items[$i]['product_id']?>&type=<?=$items[$i]['type']?>&id=<?php if($items[$i]['parent_id']==0){ echo $items[$i]['id'];}else{ echo $items[$i]['parent_id'];}?>&comment_type=<?=$items[$i]['comment_type']?>" class="tipS SC_bold">
				<?php
					if($items[$i]['type']=='san-pham'){
						$tbl= 'product';
					}else{
						$tbl= 'news';
					}
					$sql = "select ten from table_".$tbl." where id='".$items[$i]['product_id']."'";
					$result = mysql_query($sql);
					$item_item = mysql_fetch_array($result);
					echo @$item_item['ten']
				?>
				</a>
			</td>
			<td>
				<a href="index.php?com=comment&act=edit&product_id=<?=$items[$i]['product_id']?>&type=<?=$items[$i]['type']?>&id=<?php if($items[$i]['parent_id']==0){ echo $items[$i]['id'];}else{ echo $items[$i]['parent_id'];}?>&comment_type=<?=$items[$i]['comment_type']?>" class="tipS SC_bold">
				<?php 
					if($items[$i]['type']=='san-pham'){
						echo 'Sản phẩm';
					}
					if($items[$i]['type']=='chinh-sach-mua-hang'){
						echo 'Chính sách mua hàng';
					}
					if($items[$i]['type']=='tin-tuc'){
						echo 'Tin tức';
					}
					if($items[$i]['type']=='bai-viet'){
						echo 'Bài viết';
					}
					
				?>
				</a>
			</td>
			<td class="title_name_data">
				<a href="index.php?com=comment&act=edit&product_id=<?=$items[$i]['product_id']?>&type=<?=$items[$i]['type']?>&id=<?php if($items[$i]['parent_id']==0){ echo $items[$i]['id'];}else{ echo $items[$i]['parent_id'];}?>&comment_type=<?=$items[$i]['comment_type']?>" class="tipS SC_bold">
				<?=nl2br($items[$i]['mota'])?>
				</a>
			</td>
			 
			 

			<td align="center">
				<a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>
			</td>
			<td align="center">
				<a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['view']?>" data-val3="view" class="diamondToggle <?=($items[$i]['view']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>
			</td>
			<td class="actBtns">
				<a href="index.php?com=comment&act=edit&product_id=<?=$items[$i]['product_id']?>&type=<?=$items[$i]['type']?>&id=<?php if($items[$i]['parent_id']==0){ echo $items[$i]['id'];}else{ echo $items[$i]['parent_id'];}?>&comment_type=<?=$items[$i]['comment_type']?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

				<a href="index.php?com=comment&act=delete&product_id=<?=$items[$i]['product_id']?>&type=<?=$items[$i]['type']?>&id=<?=$items[$i]['id']?>&comment_type=<?=$items[$i]['comment_type']?>&p=<?=$_REQUEST['p']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa tin"><img src="./images/icons/dark/close.png" alt=""></a>
			</td>
		</tr>
		<?php } ?>
    </tbody>
  </table>
</div>
</form>
<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
