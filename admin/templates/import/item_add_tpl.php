<script type="text/javascript">
	$(document).ready(function(e) {
		$('#ok').click(function(){
			$('#load').css({visibility: "visible"});
		});    
    });
</script>
<?php


if(isset($_POST['id'])){		
	$file_type=$_FILES['linkfile']['type'];
	if($file_type=="application/vnd.ms-excel" || $file_type=="application/x-ms-excel")
	{			
			$filename=$_FILES["linkfile"]["name"];
			move_uploaded_file($_FILES["linkfile"]["tmp_name"],$filename);
			require 'PHPExcel.php';
			require_once 'PHPExcel/IOFactory.php';

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$worksheetTitle = $worksheet->getTitle();
			$highestRow = $worksheet->getHighestRow(); // e.g. 10
			$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			
			$nrColumns = ord($highestColumn) - 64;
			
			for ($row = 2; $row <= $highestRow; ++ $row) {
					$cell = $worksheet->getCellByColumnAndRow(0, $row);
					if($cell!='')
					{
						$data['stt'] = $cell->getValue();
						
						$cell = $worksheet->getCellByColumnAndRow(1, $row);
						$data['id_danhmuc'] = $cell->getValue();
						
						$cell = $worksheet->getCellByColumnAndRow(2, $row);
						$data['id_list'] = $cell->getValue();
						
						$cell = $worksheet->getCellByColumnAndRow(3, $row);
						$data['id_cat'] = $cell->getValue();
						
						$cell = $worksheet->getCellByColumnAndRow(4, $row);
						$data['masp'] = chuanhoa($cell->getValue());
						
						$cell = $worksheet->getCellByColumnAndRow(5, $row);
						$data['gia'] = $cell->getValue();
						
						$cell = $worksheet->getCellByColumnAndRow(6, $row);
						$data['title'] = chuanhoa($cell->getValue());
						
						$cell = $worksheet->getCellByColumnAndRow(7, $row);
						$data['keywords'] = chuanhoa($cell->getValue());
						
						$cell = $worksheet->getCellByColumnAndRow(8, $row);
						$data['description'] = chuanhoa($cell->getValue());
						
						$cell = $worksheet->getCellByColumnAndRow(9, $row);
						$data['ten'] = chuanhoa($cell->getValue());
						
						$cell = $worksheet->getCellByColumnAndRow(10, $row);
						$data['mota'] = chuanhoa($cell->getValue());
						
						$cell = $worksheet->getCellByColumnAndRow(11, $row);
						$data['noidung'] = chuanhoa($cell->getValue());
						
						$data['type'] = 'san-pham';
						$data['hienthi'] = 1;
						$d->setTable('product');
						if(!$d->insert($data)){	
							echo "Import dữ liệu lỗi".'<br/>';
						}
					}
				}		
			}
			echo alert('Import dữ liệu thành công');
			unlink($filename) or DIE("couldn't delete $dir$file<br />");
	} else { ?>
	<script language="javascript">alert("CHỉ hỗ trợ excel 2003 trở xuống .xls");</script>
<?php }} ?>


<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=import&act=capnhat&type=" method="post" enctype="multipart/form-data">

     <div class="widget">
         <div class="title"><img src="../images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nhập dữ liệu</h6>
        </div>
       <ul class="tabs">
           
           <li>
               <a href="#info">Thông tin chung</a>
           </li>
          
       </ul>

       <div id="info" class="tab_content">
          <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
        <span id="load" style="visibility: hidden;"><img border="0" src="../images/ajax-loader.gif" align="absmiddle"></span>
        <div class="formRow">
			<label>Tải hình ảnh:</label>
			<div class="formRight">
            	<input type="file" id="file" name="linkfile" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				<div class="note"> .xls (Ms.Excel 2003) <a href="../filemau.xls" style="color:red; margin-left:20px;" target="_blank">Xem file mẫu</a></div>
			</div>
			<div class="clear"></div>
		</div>
       
        <div class="formRow">
            <div class="formRight">
                
                <input type="button" name="ok" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                <a href="index.php?com=news&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
            </div>
            <div class="clear"></div>
        </div>

       </div>
    </div> 
</form>