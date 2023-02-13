<?php
	$tinmoi = get_news('tin-tuc',10);	

	$hotro = get_result("select ten$lang as ten,dienthoai,email,skype from #_yahoo where hienthi=1 and type='yahoo' order by stt,id desc");

	$lkweb = get_result("select id,ten$lang as ten,link from #_lkweb where hienthi=1 and type='lkweb' order by stt,id desc");

    $where = "type='san-pham' and sale > 0 and hienthi > 0 ";

    $dem = get_fetch("SELECT count(id) AS numrows FROM #_product where $where");

    $totalRows = $dem['numrows'];
    $page = $_GET['p2'];
    
    $pageSize = 6;//Số item cho 1 trang
  
    
    $offset = 5;//Số trang hiển thị
    if ($page == "")$page = 1;
    else $page = $_GET['p2'];
    $page--;
    $bg = $pageSize*$page;

    $product = get_result("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,congsuat,baohanh,tiente FROM #_product where $where  limit $bg,$pageSize");
    $url_link = getCurrentPageURL2();
    

?>
<style>
	#scroll-left{ z-index:998;}
	#scroll-left1{ min-height:300px; position: sticky; top: 43px; z-index: 999; background: #f1f1f1;}
    @media (max-width: 1366px){
        #scroll-left1{top: 44px !important;}
    }
</style>


<div class="tieude">Sản phẩm sale off</div>
<div id="zproduct">
<div class="xproduct">
  
        
         <?php foreach ($product as $k => $v) { ?>
          <?php include _template."layout/sanpham.php";?>
        <?php } ?> 
<div class="pagination"><?=pagesListLimitadmin2z($url_link , $totalRows , $pageSize, $offset)?></div>
</div>
</div>
<script>
    $().ready(function(){
        $("body").on("click","#zproduct .pages a",function(){
            $.ajax({
                url:$(this).attr("href"),
                success:function(data){
                    $("#zproduct").html($(data).find("#zproduct").html());
                }
            })
            return false;
        })

    })
    </script>
