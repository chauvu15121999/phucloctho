<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=lienhe&act=man&type=<?=$_REQUEST['type']?>"><span>Thư liên hệ</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=lienhe&act=save&type=<?=$_REQUEST['type']?>" method="post" enctype="multipart/form-data">
	

	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		



		<ul class="tabs">
           
           <li>
               <a href="#info">Thông tin chung</a>
           </li>
<?php if($_GET['type']!='dknt'){?>          
		  <?php foreach ($config['lang'] as $key => $value) { ?>
           <li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
           </li>
           <?php } ?>
           <?php } ?>


       </ul>

       <!-- begin: info -->
       <div id="info" class="tab_content">
       		<?php if($_GET['type']=='dknt'){?>
			<div class="formRow">
	            <label>Tên</label>
	            <div class="formRight">
	                <input type="text" name="ten<?=$key?>" title="Nhập tên Liên kết website" id="ten<?=$key?>" class="tipS" value="<?=@$item['ten'.$key]?>" />
	            </div>
	            <div class="clear"></div>
	        </div>
			<?php }?>
			
	        <div class="formRow">
				<label>Điện thoại</label>
				<div class="formRight">
	                <input type="text" name="dienthoai" title="Nhập link website" id="link" class="tipS" value="<?=@$item['dienthoai']?>" />
				</div>
				<div class="clear"></div>
			</div>
            
            <div class="formRow">
				<label>Email</label>
				<div class="formRight">
	                <input type="email" name="email" title="Nhập link website" id="email" class="tipS" value="<?=@$item['email']?>" />
				</div>
				<div class="clear"></div>
			</div>
	       
	        
			
	        <div class="formRow">
	          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
	          <div class="formRight">
	            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
	            <label for="check1">Đã đọc</label>            
	          </div>
	          <div class="clear"></div>
	        </div>


	        <div class="formRow">
	            <label>Số thứ tự: </label>
	            <div class="formRight">
	                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
	            </div>
	            <div class="clear"></div>
	        </div>
			
       </div>
        <!-- end: info -->
		<?php if($_GET['type']!='dknt'){?>
       <?php foreach ($config['lang'] as $key => $value) {
        ?>

        <!-- begin: Content -->
       <div id="content_lang_<?=$key?>" class="tab_content">  
       		<div class="formRow">
	            <label>Tên</label>
	            <div class="formRight">
	                <input type="text" name="ten<?=$key?>" title="Nhập tên Liên kết website" id="ten<?=$key?>" class="tipS" value="<?=@$item['ten'.$key]?>" />
	            </div>
	            <div class="clear"></div>
	        </div>
            
            <div class="formRow">
	            <label>Tên công ty</label>
	            <div class="formRight">
	                <input type="text" name="tencty<?=$key?>" title="Nhập tên công ty" id="tencty<?=$key?>" class="tipS" value="<?=@$item['tencty'.$key]?>" />
	            </div>
	            <div class="clear"></div>
	        </div>
            
            <div class="formRow <?php if($_GET['type']=='tuvan')echo 'none'?>">
	            <label>Địa chỉ</label>
	            <div class="formRight">
	                <input type="text" name="diachi<?=$key?>" title="Nhập tên Liên kết website" id="diachi<?=$key?>" class="tipS" value="<?=@$item['diachi'.$key]?>" />
	            </div>
	            <div class="clear"></div>
	        </div>
            <div class="formRow none">
	            <label>Chủ đề</label>
	            <div class="formRight">
	                <input type="text" name="chude<?=$key?>" title="Nhập tên Liên kết website" id="chude<?=$key?>" class="tipS" value="<?=@$item['chude'.$key]?>" />
	            </div>
	            <div class="clear"></div>
	        </div>
            
            <div class="formRow">
            <label>Nội dung chính: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
            <div class="formRight"><textarea class="ck_editor" name="noidung<?=$key?>" id="noidung<?=$key?>" rows="8" cols="60"><?=@$item['noidung'.$key]?></textarea>
</div>
            <div class="clear"></div>
        </div>
              
       </div>
       <!-- end: Content -->

       <?php } ?>
       <?php } ?>


		
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                 <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>

