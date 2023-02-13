<?php
	$d->reset();
	$sql="select id,ten from #_product_thuonghieu where type='san-pham' and hienthi=1 order by stt,id desc";
	$d->query($sql);
	$res1=$d->result_array(); 
?>
<link href="MultiSelect/jquery.multiselect.css" rel="stylesheet" type="text/css">
<style>
.ms-options-wrap button span{text-transform:initial;}

.ms-options .checker,.ms-options .radio { margin-right: 12px; margin-top: 0px; }
</style>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=product&act=man_danhmuc<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Danh mục</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                <a href="index.php?com=product&act=man_danhmuc<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
                <input type="button" class="blueB taoseo" value="Tạo seo" />

    </div>
</div>
<script type="text/javascript">
	function TreeFilterChanged2(){
		$('#validate').submit();
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_danhmuc<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">

     <div class="widget">
         <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
       <ul class="tabs">

           <li>
               <a href="#info">Thông tin chung</a>
           </li>
           <?php foreach ($config['lang'] as $key => $value) { ?>
           <li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
           </li>
           <?php } ?>


       </ul>

       <div id="info" class="tab_content">
          <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />

		<div class="formRow">
            <label>Chọn thương hiệu</label>
            <div class="formRight" style="position:relative;">
				<select  id="team_present1" name="team_present1[]" multiple class="tipS">
					<?php 
						$ar = array();
						if($item['thuonghieu']){
						$ar =  explode(",",$item['thuonghieu']);
					} ?>
					<?php for($i=0;$i<count($res1);$i++){?>
					<option value="<?=$res1[$i]['id']?>" <?=((in_array($res1[$i]['id'],$ar)) ? 'selected' : '')?>> <?=$res1[$i]['ten']?></option>
					<?php }?>
				</select>
  
            </div>
            <div class="clear"></div>
        </div>
		<?php if(in_array('hinhanh',$config['type'])) { ?>
        <div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
            	<input type="file" id="file" name="file" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				<div class="note">Width:<?=_width_thumb*2?>px | Height:<?=_height_thumb*2?>px <?=_format_duoihinh_l?> </div>
			</div>
			<div class="clear"></div>
		</div>
         <?php if($_GET['act']=='edit_danhmuc'){?>
		<div class="formRow">
			<label>Hình Hiện Tại :</label>
			<div class="formRight">

			<div class="mt10"><img src="<?=_upload_sanpham.$item['photo']?>"  width="100px" alt="NO PHOTO" width="100" /></div>

			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
    <?php } ?>

    <?php if(in_array('seo',$config['type'])) { ?>
 		<div class="formRow">
            <label>Title</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['title']?>" name="title" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>Từ khóa</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho bài viết" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>Description:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS description_input" name="description"><?=@$item['description']?></textarea>
                <b>(Tốt nhất là 68 - 170 ký tự)</b>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>H1</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['h1']?>" name="h1" title="" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>H2</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['h2']?>" name="h2" title="" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label>H3</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['h3']?>" name="h3" title="" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
      <?php } ?>

        <?php if(in_array('noibat',$config['type'])) { ?>
        <div class="formRow">
          <label>Nổi bật : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>

         <div class="formRight">
            <input type="checkbox" name="noibat" id="check1" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?> />
            </div>
			<div class="clear"></div>
          </div>
        <?php } ?>

        <div class="formRow">
          <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">

            <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
             <label>Số thứ tự: </label>
              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="formRight">

                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                <a href="index.php?com=product&act=man_danhmuc<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
            </div>
            <div class="clear"></div>
        </div>

       </div>
       
      <?php foreach ($config['lang'] as $key => $value) { ?>

       <div id="content_lang_<?=$key?>" class="tab_content">
         <?php if(in_array('ten',$config['type'])) { ?>
            <div class="formRow">
            <label>Tên bài viết</label>
            <div class="formRight">
                <input type="text" name="ten<?=$key?>" title="Nhập tên bài viết" id="ten<?=$key?>" class="tipS" value="<?=@$item['ten'.$key]?>" />
            </div>
            <div class="clear"></div>
        </div>
       <?php } ?>

       <?php if(in_array('mota',$config['type'])) { ?>
        <div class="formRow">
            <label>Mô tả ngắn:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Viết mô tả ngắn bài viết" class="tipS" name="mota<?=$key?>" id="mota<?=$key?>"><?=@$item['mota'.$key]?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>

        <?php if(in_array('noidung',$config['type'])) { ?>
        <div class="formRow ">
            <label>Nội dung:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Viết nội dung bài viết" class="tipS" name="noidung<?=$key?>" id="noidung<?=$key?>"><?=@$item['noidung'.$key]?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>

        <div class="formRow">
            <div class="formRight">
            	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                 <a href="index.php?com=product&act=man_danhmuc<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
            </div>
            <div class="clear"></div>
        </div>

       </div><!-- End content <?=$key?> -->

     <?php } ?>


    </div>

</form>
<script src="MultiSelect/jquery.multiselect.js"></script>
<script>
	$('#team_present1').multiselect({
		columns:5,
		placeholder: 'Chọn tag'
	});
	 
</script>