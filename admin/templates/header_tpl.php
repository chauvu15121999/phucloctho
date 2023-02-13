<?php
	$d->reset();
	$sql = "select count(id) as dem from #_lienhe where type='dknt' and huy=0 and hienthi=0";
	$d->query($sql);
	$dem_thu = $d->result_array();

    $d->reset();
	$sql = "select count(id) as dem from #_lienhe where type='dknt' and huy=0 ";
	$d->query($sql);
	$dem_thu1 = $d->result_array();

    $d->reset();
    $sql = "select count(id) as dem from #_lienhe where type='tuvan' and huy=0 and hienthi=0";
    $d->query($sql);
    $dem_tuvan = $d->result_array();

	$d->reset();
    $sql = "select count(id) as dem from #_lienhe where type='tuvan' and huy=0";
    $d->query($sql);
    $dem_tuvan1 = $d->result_array();

	$d->reset();
    $sql = "select count(id) as dem from #_lienhe where type='thongtin' and huy=0";
    $d->query($sql);
    $dem_info = $d->result_array();

	$d->reset();
    $sql = "select count(id) as dem from #_comment where comment_type='nhanxet' and view=0";
    $d->query($sql);
    $dem_nhanxet = $d->result_array();

	$d->reset();
    $sql = "select count(id) as dem from #_comment where comment_type='hoidap' and view=0";
    $d->query($sql);
    $dem_hoidap = $d->result_array();

	$d->reset();
    $sql = "select count(id) as dem from #_donhang where  tinhtrang=1";
    $d->query($sql);
    $dem_cart = $d->result_array();
?>
<style>
	.ul_info{ position:relative;}
	.ul_info ul{ display:none; background:#313A42; position:absolute; left:0px; top:100%; width: max-content;}
	.ul_info:hover ul{ display:block;}
	.userNav ul li ul li{ border:none !important; float:none !important; display:block !important;}
	.userNav ul li ul li a{border:none !important; display:block; float:none !important;}
	.userNav ul li ul li a::after{content:''; display:block; clear:both;}
	.userNav ul li ul li img { margin: 9px 2px 0px 6px !important;}
</style>
<div class="wrapper">
		<div class="menu_mobi"><i class="fa fa-bars" aria-hidden="true"></i></div>
        <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Xin chào, <?=$_SESSION['login_admin']['username']?>!</span></div>
        <div class="userNav">
            <ul>
                <li><a href="sitemap.php" title="" target="_blank"><img src="./images/icons/topnav/export-icon.png" alt="" style="height: 15px;margin-top: 6px;" class="img_mg" /><span>Cập nhật sitemap</span></a></li>				 
                <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
				
				<?php if(phanquyen_menu1('order','man','')==true){ ?>
				<li><a href="index.php?com=order&act=man" title="" target="_blank"><img src="./images/icons/topnav/export-icon.png" alt="" style="height: 15px;margin-top: 6px;" class="img_mg" /><span>Đơn hàng</span><span class="numberTop"><?=$dem_cart[0]['dem']?></span></a></li>
				<?php }?>
				

				<li class="ddnew2 none"><a title="" class="hien_menu"><img src="images/icons/topnav/profile.png" alt="" /><span>Thành viên</span><span class="numberTop"></span></a>
                    <ul class="menu_header">                   	
                        <?php phanquyen_menu('Đăng ký','about','capnhat','dangky'); ?>
                        <?php phanquyen_menu('Đăng nhập','about','capnhat','dangnhap'); ?>
                        <?php phanquyen_menu('Quên mật khẩu','about','capnhat','quenmatkhau'); ?>
                        <?php phanquyen_menu('Thay đổi thông tin','about','capnhat','thaydoithongtin'); ?>
                        <?php phanquyen_menu('Quản lý thành viên','user','man',''); ?>
                    </ul>
                </li>
                <?php if(phanquyen_menu1('comment','man','nhanxet')==true){ ?>
                <li><a title="Có <?=$dem_nhanxet[0]['dem']?> chưa đọc" href="index.php?com=comment&act=man&comment_type=nhanxet" title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Nhận xét</span><span class="numberTop"><?=$dem_nhanxet[0]['dem']?></span></a></li>
				<?php }?>
				<?php if(phanquyen_menu1('comment','man','hoidap')==true){ ?>
                <li><a title="Có <?=$dem_hoidap[0]['dem']?> chưa đọc" href="index.php?com=comment&act=man&comment_type=hoidap" title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Hỏi đáp</span><span class="numberTop"><?=$dem_hoidap[0]['dem']?></span></a></li>
				<?php }?>
				
               <?php /* if(phanquyen_menu1('lienhe','man','thongtin')==true || phanquyen_menu1('lienhe','man','dknt')==true || phanquyen_menu1('lienhe','man','tuvan')==true){ ?>
				<li class="ul_info"><span>Thông tin khách hàng</span><span class="numberTop"><?=$dem_tuvan[0]['dem'] + $dem_thu[0]['dem']?></span>
					<ul>
						<?php if(phanquyen_menu1('lienhe','man','thongtin')==true){ ?>
						<li><a href="index.php?com=lienhe&act=man&type=thongtin" title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Hỏi đáp & nhận xét</span>
						<span class="numberTop"><?=$dem_info[0]['dem']?></span>
						</a></li>
						<?php }?>
						<?php if(phanquyen_menu1('lienhe','man','dknt')==true){ ?>
						<li><a title="Có <?=$dem_thu[0]['dem']?> chưa đọc" href="index.php?com=lienhe&act=man&type=dknt" title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Newsletter</span><span class="numberTop"><?=$dem_thu1[0]['dem']?></span></a></li>
						<?php }?>
						<?php if(phanquyen_menu1('lienhe','man','tuvan')==true){ ?>
						<li><a title="Có <?=$dem_tuvan[0]['dem']?> chưa đọc" href="index.php?com=lienhe&act=man&type=tuvan" title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Thư tư vấn</span><span class="numberTop"><?=$dem_tuvan1[0]['dem']?></span></a></li>
						<?php }?>
					</ul>
				</li>
				<?php }*/?>
                
				<li><a href="index.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
<?php echo $_SESSION['login']['role']; ?>

