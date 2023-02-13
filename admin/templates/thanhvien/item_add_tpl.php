<script language="javascript" src="media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(isEmpty(document.frm.thanhvienname, "Chưa nhập tên đăng nhập.")){
		document.frm.thanhvienname.focus();
		return false;
	}
	<?php if($_GET['act']=='add'){?>
	if(isEmpty(document.frm.oldpassword, "Chưa nhập mật khẩu.")){
		document.frm.oldpassword.focus();
		return false;
	}
	
	if(document.frm.oldpassword.value.length<5){
		alert("Mật khẩu phải nhiều hơn 4 ký tự.");
		document.frm.oldpassword.focus();
		return false;
	}
	<?php } ?>
	if(!isEmpty(document.frm.email) && !check_email(document.frm.email.value)){
		alert('Email không hợp lệ.');
		document.frm.email.focus();
		return false;
	}
	if(document.frm.thanhvienname.value==0){
		alert('Chưa chọn nhóm thành viên.');
		document.frm.email.focus();
		return false;
	}
}
</script>


<div class="wrapper">

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=thanhvien&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm thành viên</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>



<form name="frm"  class="form"  method="post" action="index.php?com=thanhvien&act=save" enctype="multipart/form-data" class="nhaplieu" onSubmit="return js_submit();">
<div class="widget">

	<div class="formRow">
		<label>Mật khẩu :</label>
		<div class="formRight">
        	<input type="password" name="oldpassword" id="oldpassword" value="" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Email :</label>
		<div class="formRight">
        	<input type="text" value="<?=$item['email']?>" class="input" readonly="readonly"/>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Họ tên:</label>
		<div class="formRight">
        	<input type="text" name="ten" id="ten" value="<?=$item['hoten']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Điện thoại :</label>
		<div class="formRight">
        	<input type="text" name="dienthoai" value="<?=$item['dienthoai']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<!-- <div class="formRow">
		<label>Địa chỉ :</label>
		<div class="formRight">
        	<input type="text" name="diachi" id="diachi" value="<?=$item['diachi']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div> -->

	<!-- <div class="formRow">
		<label>Hiển thị :</label>
		<div class="formRight">
        	<input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>>
		</div>
		<div class="clear"></div>
	</div> -->
       	
	<div class="formRow">
	<label></label>
	<div class="formRight">
		<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
		<input type="submit" value="Lưu"  class="button blueB" />
		<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=thanhvien&act=man'" class="button blueB" />
	</div>
	<div class="clear"></div>
	</div>
</div>
</form>