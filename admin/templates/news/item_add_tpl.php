<script language="javascript">
	function select_onchange()
	{
		var chuoi = "";if("<?=$_GET['act']?>"=='add' && "<?=$_GET['id_danhmuc']?>"<=0)
		chuoi= "&id_danhmuc="+document.getElementById("id_danhmuc").value;
		window.location = location.href.replace("id_danhmuc=<?=$_GET['id_danhmuc']?>", "id_danhmuc="+document.getElementById("id_danhmuc").value)+chuoi;
		return true;
	}
	function select_onchange1()
	{
		var chuoi = "";if("<?=$_GET['act']?>"=='add' && "<?=$_GET['id_list']?>"<=0)
		chuoi= "&id_list="+document.getElementById("id_list").value;
		window.location = location.href.replace("id_list=<?=$_GET['id_list']?>", "id_list="+document.getElementById("id_list").value)+chuoi;
		return true;
	}
	function select_onchange2()
	{
		var chuoi = "";if("<?=$_GET['act']?>"=='add' && "<?=$_GET['id_cat']?>"<=0)
		chuoi= "&id_cat="+document.getElementById("id_cat").value;
		window.location = location.href.replace("id_cat=<?=$_GET['id_cat']?>", "id_cat="+document.getElementById("id_cat").value)+chuoi;
		return true;
	}
</script>
<?php
function get_main_danhmuc()
	{
		$sql="select * from table_news_danhmuc where type='".$_REQUEST['type']."' order by stt";

		$stmt=mysql_query($sql);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" onchange="select_onchange()" class="main_select select_danhmuc">
			<option value="0">Chọn danh mục</option>
			';
		while ($row=@mysql_fetch_array($stmt))
		{
			if($row["id"]==(int)@$_REQUEST["id_danhmuc"])
				$selected="selected";
			else
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';
		}
		$str.='</select>';
		return $str;
	}

function get_main_list()
	{
		$sql="select * from table_news_list where id_danhmuc=".$_REQUEST['id_danhmuc']."  order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange1()" class="main_select select_danhmuc">
			<option value="0">Chọn danh mục</option>
			';
		while ($row=@mysql_fetch_array($stmt))
		{
			if($row["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';
		}
		$str.='</select>';
		return $str;
	}

function get_main_category()
	{
		$sql="select * from table_news_cat where id_list=".$_REQUEST['id_list']." order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange2()" class="main_select select_danhmuc">
			<option value="0">Chọn danh mục</option>
			';
		while ($row=@mysql_fetch_array($stmt))
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';
		}
		$str.='</select>';
		return $str;
	}


function get_main_item()
	{
		$sql_huyen="select * from table_news_item where id_cat=".$_REQUEST['id_cat']." order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item" class="main_select select_danhmuc">
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result))
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';
		}
		$str.='</select>';
		return $str;
	}
	$d->reset();
	$sql_images="select * from #_hinhanh where id_hinhanh='".$item['id']."' and type='".$_GET['type']."' order by stt, id desc ";
	$d->query($sql_images);
	$ds_photo=$d->result_array();
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	   <li><a href="index.php?com=news&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Sản phẩm</span></a></li>
               <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                <a href="index.php?com=news&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
        <input type="button" class="blueB taoseo" value="Tạo seo" />

    </div>
</div>

<script type="text/javascript">
	function TreeFilterChanged2(){
				$('#validate').submit();
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=news&act=save&p=<?=$_REQUEST['p']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">


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
	<?php if(in_array('danhmuc',$config['type'])) { ?>
		<div class="formRow ">
			<label>Chọn danh mục 1</label>
			<div class="formRight">
			<?=get_main_danhmuc()?>
			</div>
			<div class="clear"></div>
		</div>

	<?php } ?>
	<?php if(in_array('list',$config['type'])) { ?>
        <div class="formRow ">
			<label>Chọn danh mục cấp 2</label>
			<div class="formRight">
			<?=get_main_list()?>
			</div>
			<div class="clear"></div>
		</div>
	<?php } ?>

	<?php if(in_array('tags',$config['type'])) { ?>
	<link href="css/fSelect.css" rel="stylesheet">
	<div class="formRow">
		<label>Tags sản phẩm</label>
		<div class="formRight">
        	<?php
			$arr_id_tags = explode(',', $item['id_tags']);
			$d->reset();
			$sql="select id,ten from table_product_tags where type='".$_GET['type']."' order by stt, id asc";
			$d->query($sql);
			$arr_tags = $d->result_array();
			if(!empty($arr_tags)){ ?>
            	<select id="kichco_multi" multiple="multiple" class="main_select se-w" name="id_tags[]">
            		<?php foreach($arr_tags as $tag){ ?>
						<option value="<?=$tag['id']?>" data-list="true" <?php if(in_array($tag['id'], $arr_id_tags)) { echo 'selected'; } ?>><b><?=$tag['ten']?></b></option>
            		<?php } ?>
				</select>
			<?php } ?>
        
		</div>
		<div class="clear"></div>
	</div>
    
    <script src="js/fSelect.js" type="text/javascript"></script>
	<script type="text/javascript">
		$().ready(function(){
			$('#tags_multi').fSelect();
		})
	</script>
	<?php } ?>

	<?php if(in_array('hinhanh',$config['type'])) { ?>

        <div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
            	<input type="file" id="file" name="file" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				<div class="note"> Width:170px | Height:130px<?=_format_duoihinh_l?> </div>
			</div>
			<div class="clear"></div>
		</div>
         <?php if($_GET['act']=='edit'){?>
		<div class="formRow">
			<label>Hình Hiện Tại :</label>
			<div class="formRight">

			<div class="mt10"><img src="<?=_upload_tintuc.$item['photo']?>"  width="100px" alt="NO PHOTO" width="100" /></div>

			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
	<?php } ?>

	<?php if(in_array('hinhanh1',$config['type'])) { ?>

        <div class="formRow">
			<label>Tải hình ảnh 2:</label>
			<div class="formRight">
            	<input type="file" id="file" name="file_h2" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				<div class="note"> Width:170px | Height:130px<?=_format_duoihinh_l?> </div>
			</div>
			<div class="clear"></div>
		</div>
         <?php if($_GET['act']=='edit'){?>
		<div class="formRow">
			<label>Hình Hiện Tại :</label>
			<div class="formRight">

			<div class="mt10"><img src="<?=_upload_tintuc.$item['photo1']?>"  width="100px" alt="NO PHOTO" width="100" /></div>

			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
	<?php } ?>

	<?php if(in_array('icon',$config['type'])) { ?>
        <div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
            	<input type="file" id="file" name="file_icon" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				<div class="note"> Width:70px | Height:70px<?=_format_duoihinh_l?> </div>
			</div>
			<div class="clear"></div>
		</div>
         <?php if($_GET['act']=='edit'){?>
		<div class="formRow">
			<label>Icon Hiện Tại :</label>
			<div class="formRight">
			<div class="mt10"><img src="<?=_upload_tintuc.$item['icon']?>"  width="70px" alt="NO PHOTO" width="70" /></div>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
	<?php } ?>

	<?php if(in_array('hinhthem',$config['type'])) { ?>
      <div class="formRow">
      <label>Hình ảnh kèm theo: </label>
       <?php if($act=='edit'){?>
       <div class="formRight">
      <?php if(count($ds_photo)!=0){?>
            <?php for($i=0;$i<count($ds_photo);$i++){?>
              <div class="item_trich trich<?=$ds_photo[$i]['id']?>" id="<?=md5($ds_photo[$i]['id'])?>">
                   <img class="img_trich" width="100px" height="80px" src="<?=_upload_hinhthem.$ds_photo[$i]['photo']?>" />
                 <input data-val0="<?=$ds_photo[$i]['id']?>" data-val2="table_hinhanh" data-val3="stt" onblur="stt(this);" type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS" />
                 <a style="cursor:pointer" class="remove_images" data-id="<?=$ds_photo[$i]['id']?>"><i class="fa fa-trash-o"></i></a>
              </div>
            <?php }?>

      <?php }?>
		</div>
    <?php }?>
      <div class="formRight">
          <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="fa fa-paperclip"></i>Thêm ảnh</a>

      </div>
          <div class="clear"></div>
        </div>
			<?php } ?>


	<?php if(in_array('download',$config['type'])) { ?>
	        <div class="formRow">
				<label>Tải file kèm theo:</label>
				<div class="formRight">
	        <input type="file" id="file" name="file_download" accept="image/*" onchange="loadFile(event)" />
					<img src="./images/question-button.png" alt="Upload file" class="icon_question tipS" original-title="Tải file (doc, .xls, .ppt, .pdf, .rar, .win, .zip)">
					<div class="note">Width:<?=_width_thumb*2?>px | Height:<?=_height_thumb*2?>px <?=_format_duoitailieu_l?> </div>
				</div>
				<div class="clear"></div>
			</div>
	    <?php if($_GET['act']=='edit'){?>
			<div class="formRow">
				<label>File Hiện Tại :</label>
				<div class="formRight">
				<div class="mt10"><a href="<?=_upload_tintuc.$item['download']?>" target='_blank'><?=$item['download']?></a></div>
				</div>
				<div class="clear"></div>
			</div>
	        <?php } ?>
		<?php } ?>


	<?php if(in_array('link',$config['type'])) { ?>
		<div class="formRow">
            <label>Link</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['link']?>" name="link" title="Nhập link" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
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

         <div class="formRow none">
            <label>Thẻ tag:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Mỗi thẻ tag cách nhau bởi dấu , " class="tipS description_input" name="tag"><?=@$item['tag']?></textarea>
                <b>(Mỗi thẻ tag cách nhau bởi dấu , )</b>
            </div>
            <div class="clear"></div>
        </div>

			<?php } ?>
			<?php if(in_array('noibat',$config['type'])) { ?>
        <div class="formRow">
          <label>Nổi bật : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này !"> </label>

         <div class="formRight">
            <input type="checkbox" name="noibat" id="check1" <?=($item['noibat']==1)?'checked="checked"':''?> />
            </div>
			<div class="clear"></div>
        </div>
			<?php } ?>
			<?php if(in_array('spmoi',$config['type'])) { ?>


        <div class="formRow ">
          <label>Mới : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này !"> </label>

         <div class="formRight">
            <input type="checkbox" name="spmoi" id="check1" <?=($item['spmoi']==1)?'checked="checked"':''?> />
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
                <a href="index.php?com=news&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
            </div>
            <div class="clear"></div>
        </div>

       </div>

       <?php if(in_array('no_tacgia',$config['type'])){ ?>
	       <div class="formRow">
	            <label>Tên tác giả</label>
	            <div class="formRight">
	                <input type="text" name="tacgia" title="Nhập tên tác giả" id="tacgia" class="tipS" value="<?=@$item['tacgia']?>" />
	            </div>
	            <div class="clear"></div>
	        </div>
	    <?php } ?>

       <!-- End info -->
        <?php foreach ($config['lang'] as $key => $value) {
        ?>

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
                <textarea  rows="8" cols="" title="Viết mô tả ngắn bài viết" class="tipS" name="mota<?=$key?>" id="mota<?=$key?>"><?=@$item['mota'.$key]?></textarea>
            </div>
            <div class="clear"></div>
        </div>
			<?php } ?>
			<?php if(in_array('noidung',$config['type'])) { ?>
            <div class="formRow">
            <label>Nội dung chính: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
            <div class="formRight"><textarea class="ck_editor" name="noidung<?=$key?>" id="noidung<?=$key?>" rows="8" cols="60"><?=@$item['noidung'.$key]?></textarea>
</div>
            <div class="clear"></div>
        </div>
			<?php } ?>


        <div class="formRow">
            <div class="formRight">
            	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>

       </div><!-- End content <?=$key?> -->

     <?php } ?>


    </div>
</form>

<script type="text/javascript">
	$(document).ready(function(e) {
        $('.remove_images').click(function(){
			var id=$(this).data("id");
			$.ajax({
				type: "POST",
				url: "ajax/xuly_admin_dn.php",
				data: {id:id, act: 'remove_image'},
				success:function(data){
					$jdata = $.parseJSON(data);
					$("#"+$jdata.md5).fadeOut(500);
					setTimeout(function(){
						$("#"+$jdata.md5).remove();
					}, 1000)
				}
			})
		})

		$('.update_stt').blur(function(){
			var a=$(this).val();
			$.ajax({
				type: "POST",
				url: "ajax/ajax_hienthi.php",
				data:{
					id: $(this).attr("data-val0"),
					bang: $(this).attr("data-val2"),
					type: $(this).attr("data-val3"),
					value:a
				},
				success:function(kq){
					alert('Cập nhật stt thành công.');
				}
			});
		})
    });
</script>
<script>
  $(document).ready(function() {
    $('.file_input').filer({
            showThumbs: true,
            templates: {
                box: '<ul class="jFiler-item-list"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" />\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" />\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true
        });
  });
</script>
