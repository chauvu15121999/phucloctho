

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li class="current"><a href="index.php?com=product&act=man_thuonghieu&type=<?=$_REQUEST['type']?>"><span>Đồng bộ</span></a></li>
        	
        </ul>
        <div class="clear"></div>
    </div>
</div>


<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<a   class="blueB button xbtn" value="Thêm" href="index.php?com=<?=$com?>&act=importKiotCategory&type=product" >Đồng bộ danh mục</a>
    	<a   class="blueB button xbtn" value="Thêm" href="index.php?com=<?=$com?>&act=importKiotProduct&type=product" >Đồng bộ sản phẩm</a>
      
        
    </div>  
</div>
<div class="contentx">

</div>
<script>
	$().ready(function(){
		$(".xbtn").click(function(){
			if(confirm("Bạn có chắc chắn muốn "+$(this).html())){
				$(".page-loading").show();
				$(".contentx").html('');
				$.ajax({
					url:$(this).attr("href"),
					success:function(data){
						$(".contentx").html(data);
						$(".page-loading").hide();
					}
				})
			}
			return false;
		})
	})
</script>

<style>

td.insert {
    background: #19bf19;
    color: #fff;
}
	table.mtable {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  /* width: 100%; */
  }
table.mtable tr{}
table.mtable tr td{ border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;}
table.mtable tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
