<!--Tim kiem-->
<script language="javascript"> 
    function doEnter2(evt){
	var key;
	if(evt.keyCode == 13 || evt.which == 13){
		onSearch2(evt);
	}
	}
	function onSearch2(evt) {			
			var keyword2 = document.getElementById("keyword2").value;
			if(keyword2=='' || keyword2=='<?=_nhaptukhoatimkiem?>...')
			{
				alert('<?=_chuanhaptukhoa?>');
			}
			else{
				location.href = "tim-kiem.html&keyword="+keyword2;
				loadPage(document.location);			
			}
		}		
</script>   
<!--Tim kiem-->

<link type="text/css" rel="stylesheet" href="css/jquery.mmenu.all.css" />
<script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script>
<script type="text/javascript">
	$(function() {
		$('.hien_menu').click(function(){
			$('nav#menu_mobi').css({height: "auto"});
		});
		$('.user .fa-user-plus').toggle(function(){
			$('.user ul').slideDown(300);
		},function(){
			$('.user ul').slideUp(300);
		});
		$('nav#menu_mobi').mmenu({
			extensions	: [ 'effect-slide-menu', 'pageshadow' ],
			searchfield	: true,
			counters	: true,
			navbar 		: {
				title		: 'Menu'
			},
			navbars		: [
				{
					position	: 'top',
					content		: [ 'searchfield' ]
				}, {
					position	: 'top',
					content		: [
						'prev',
						'title',
						'close'
					]
				}, {
					position	: 'bottom',
					content		: [
						'<a>Online : <?php $count=count_online();echo $tong_xem=$count['dangxem'];?></a>',
						'<a><?=_tong?> : <?php $count=count_online();echo $tong_xem=$count['daxem'];?></a>'
					]
				}
			]
		});
	});
</script>

<div class="header"><a href="#menu_mobi" class="hien_menu"><i class="fa fa-bars" aria-hidden="true"></i> <i class="fa fa-caret-right" aria-hidden="true"></i></a>
<a href="gio-hang.html" class="sp_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span><?php if(count($_SESSION['cart'])>0)echo count($_SESSION['cart']);else echo '0';?></span><sup></sup></a> 

<div class="user"><i class="fa fa-user-plus" aria-hidden="true"></i>
	<ul>
	<?php if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false)){?>
        <li><a href="dang-ky.html"><?=_dangky?></a></li>
        <li><a href="dang-nhap.html"><?=_dangnhap?></a></li>
        <li><a style="border:none;" href="quen-mat-khau.html"><?=_quenmatkhau?></a></li>
    <?php } else { ?>
        <li><a>Xin chào <span style="color:#e00a1f;">(
        <?php $info_user=info_user($_SESSION['login']['id']);echo $info_user['username']?>)</span></a></li>
        <li><a href="dang-xuat.html"><?=_dangxuat?></a></li>
        <li><a style="border:none;" href="thay-doi-thong-tin.html"><?=_thaydoithongtin?></a></li>
    <?php } ?>
    </ul>
</div>
</div> 

<nav id="menu_mobi" style="height:0; overflow:hidden;">
    <ul>	
    	<div class="search_mobi">
            <input type="text" name="keyword2" id="keyword2" onKeyPress="doEnter2(event,'keyword2');" value="<?=_nhaptukhoatimkiem?>..." onclick="if(this.value=='<?=_nhaptukhoatimkiem?>...'){this.value=''}" onblur="if(this.value==''){this.value='<?=_nhaptukhoatimkiem?>...'}">
            <i class="fa fa-search" aria-hidden="true" onclick="onSearch2(event,'keyword2');"></i>
    	</div><!---END #search-->

        <li><a class="<?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or $_REQUEST['com']=='index') echo 'active'; ?>" href=""><?=_trangchu?></a></li>
        
        <li><a class="<?php if($_REQUEST['com'] == 'gioi-thieu') echo 'active'; ?>" href="gioi-thieu.html"><?=_gioithieu?></a></li>
        
        <li><a class="<?php if($_REQUEST['com'] == 'san-pham') echo 'active'; ?>" href="san-pham.html"><?=_sanpham?></a>
            <ul>
                <?php for($i = 0, $count_product_danhmuc = count($product_danhmuc); $i < $count_product_danhmuc; $i++){ ?>
                <li><a href="san-pham/<?=$product_danhmuc[$i]['tenkhongdau']?>-<?=$product_danhmuc[$i]['id']?>"><?=$product_danhmuc[$i]['ten']?></a>
                    <ul>
                            <?php	
                                $d->reset();
                                $sql_product_list="select ten$lang as ten,tenkhongdau,id from #_product_list where hienthi=1 and id_danhmuc='".$product_danhmuc[$i]['id']."' order by stt,id desc";
                                $d->query($sql_product_list);
                                $product_list=$d->result_array();															
                            ?>
                             <?php for($j = 0, $count_product_list = count($product_list); $j < $count_product_list; $j++){ ?>
                                    <li><a href="san-pham/<?=$product_list[$j]['tenkhongdau']?>-<?=$product_list[$j]['id']?>/"><?=$product_list[$j]['ten']?></a>
                                        
                                    </li>
                             <?php } ?>
                     </ul>
                    </li>
                    <?php } ?>
                </ul>	
        </li>
        
        <li><a class="<?php if($_REQUEST['com'] == 'tin-tuc') echo 'active'; ?>" href="tin-tuc.html"><?=_tintuc?></a></li>
        
        <li><a class="<?php if($_REQUEST['com'] == 'du-an') echo 'active'; ?>" href="du-an.html"><?=_duan?></a></li>
        
        <li><a class="<?php if($_REQUEST['com'] == 'video') echo 'active'; ?>" href="video.html">Video</a></li>
        <?php /*?>
        <li><a class="<?php if($_REQUEST['com'] == 'lien-he') echo 'active'; ?>" href="lien-he.html"><?=_lienhe?></a></li>
		<?php */?>
    </ul>
</nav>