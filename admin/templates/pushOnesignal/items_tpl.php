<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=pushOnesignal&act=man"><span>Push OneSignal</span></a></li>
             <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mục này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}		
</script>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
<?php /*?>    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=pushOnesignal&act=add'" /><?php */?>
    </div>    
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách nick hỗ trợ hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>

        <td width="200"><div>Tên<span></span></div></td>
        <td class="tb_data_small"><div>Sync<span></span></div></td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
   
    <tbody>
          <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
        <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
     
        <td>
            <a href="index.php?com=pushOnesignal&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['name']?></a>
        </td>

        <td align="center"><a href="index.php?com=pushOnesignal&act=sync&id=<?=$items[$i]['id']?>"><img src="images/loa.png" /></a></td>
       
        <td class="actBtns">
            <a href="index.php?com=pushOnesignal&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa danh mục"><img src="./images/icons/dark/pencil.png" alt=""></a>
        </td>
      </tr>
           <?php } ?> 
                </tbody>
  </table>
</div>
</form>               