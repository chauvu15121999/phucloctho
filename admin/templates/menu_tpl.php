<div class="logo"><a href="index.php" style="display:block;"><img style="width:100%" src="logo-3301.png" /></a></div>
<div class="sidebarSep mt0"></div>

<!-- Left navigation -->
<ul id="menu" class="nav">
<li class="dash" id="menu1"><a class=" active" title="" href="index.php"><span>Trang chủ</span></a></li>

<li class="categories_li <?php if(($_GET['com']=='product'&&$_GET['type']=='san-pham') || $_GET['com']=='order' || ($_GET['com']=='excel') || ($_GET['com']=='product'&&$_GET['type']=='san-pham')) echo ' activemenu' ?>" id="menu_"><a href="" title="" class="exp"><span>Sản phẩm</span><strong></strong></a>
    <ul class="sub">
        <?php //phanquyen_menu('Quản lý tags','product','man_tags','san-pham'); ?>
        <?php //phanquyen_menu('Quản lý màu sắc','product','man_mausac','san-pham'); ?>
        <?php //phanquyen_menu('Quản lý kích thước','product','man_kichco','san-pham'); ?>
        <?php phanquyen_menu('Quản lý thương hiệu','product','man_thuonghieu','san-pham'); ?>
        <?php phanquyen_menu('Quản lý giá','product','man_gia','san-pham'); ?>
    	<?php phanquyen_menu('Quản lý danh mục 1','product','man_danhmuc','san-pham'); ?>
        <?php phanquyen_menu('Quản lý danh mục 2','product','man_list','san-pham'); ?>
        <?php phanquyen_menu('Quản lý danh mục 3','product','man_cat','san-pham'); ?>
        <?php phanquyen_menu('Quản lý sản phẩm','product','man','san-pham'); ?>
        <?php phanquyen_menu('Kiot','kiot','man','san-pham'); ?>
         <?php phanquyen_menu('Hình thức vận chuyển','news','man','htvc'); ?>

         <?php phanquyen_menu('Thông tin ngân hàng','about','capnhat','bank'); ?>
        
    </ul>
</li>

<li class="categories_li <?php if($_GET['com']=='news' or $_GET['com']=='vnexpress'|| ($_GET['com']=='product'&&$_GET['type']=='tin-tuc')) echo ' activemenu' ?>" id="menu_tt"><a href="" title="" class="exp"><span>Bài viết</span><strong></strong></a>
    <ul class="sub">
        <?php //phanquyen_menu('Quản lý tags','product','man_tags','tin-tuc'); ?>
        <?php //phanquyen_menu('Quản lý danh mục 1','news','man_danhmuc','tin-tuc'); ?>
        <?php //phanquyen_menu('Quản lý danh mục 2','news','man_list','tin-tuc'); ?>
        <?php phanquyen_menu('Quản lý giới thiệu','news','man','gioi-thieu'); ?>
        <?php phanquyen_menu('Quản lý chính sách mua hàng','news','man','chinh-sach-mua-hang'); ?>
        <?php phanquyen_menu('Quản lý tin tức','news','man','tin-tuc'); ?>
        <?php phanquyen_menu('Quản lý thông báo','news','man','thong-bao'); ?>
        <?php phanquyen_menu('Quản lý hỗ trợ','news','man','ho-tro'); ?>
        <?php phanquyen_menu('Quản lý bài viết banner','news','man','bai-viet'); ?>
        <?php phanquyen_menu('Quản lý bài viết dự án','news','man','du-an'); ?>

        <?php phanquyen_menu('Lý do hủy nhận email','news','man','why-huy'); ?>

        <?php //phanquyen_menu('Quản lý thư viện','news','man','thu-vien'); ?>
        <?php //phanquyen_menu('Lấy tin từ Vnexpress','vnexpress','man',''); ?>
        <?php phanquyen_menu('Danh mục tag tìm kiếm','news','man_danhmuc','tag-seo'); ?>
        <?php phanquyen_menu('Tag tìm kiếm','news','man','tag-seo'); ?>
    </ul>
</li>

<li class="categories_li <?php if($_GET['com']=='about' || $_GET['com']=='video') echo ' activemenu' ?>" id="menu_t"><a href="" title="" class="exp"><span>Trang tĩnh</span><strong></strong></a>
    <ul class="sub">
    	<?php phanquyen_menu('Quản lý Video','video','man','video'); ?>
        <?php //phanquyen_menu('Cập nhật bảo hành - bảo trì','about','capnhat','baohanh'); ?>
        <?php //phanquyen_menu('Cập nhật giao hàng nhanh','about','capnhat','giaohang'); ?>
        <?php //phanquyen_menu('Cập nhật đổi trả','about','capnhat','doitra'); ?>
        <?php phanquyen_menu('Cập nhật liên hệ','about','capnhat','lienhe'); ?>
        <?php phanquyen_menu('Cập nhật footer','about','capnhat','footer'); ?>
        <?php phanquyen_menu('Cập nhật footer mobile','about','capnhat','footer_mobile'); ?>
        <?php phanquyen_menu('Cập nhật giới thiệu','about','capnhat','hung-vuong'); ?>
    </ul>
</li>

<li class="categories_li <?php if($_GET['com']=='newsletter' || $_GET['com']=='lkweb' || $_GET['com']=='yahoo') echo ' activemenu' ?>" id="menu_nt"><a href="" title="" class="exp"><span>Marketing Online</span><strong></strong></a>
      	<ul class="sub">
            <?php //phanquyen_menu('Quản lý mạng xã hội top','lkweb','man','mxh_top'); ?>
        	<?php phanquyen_menu('Quản lý mạng xã hội','lkweb','man','mxh'); ?>
        	
            <?php phanquyen_menu('Quản lý hỗ trợ trực tuyến','yahoo','man','yahoo'); ?>
            <?php //phanquyen_menu('Quản lý Đăng ký nhận tin','newsletter','man','newsletter'); ?>
        </ul>
</li>

<li class="categories_li gallery_li <?php if($_GET['com']=='anhnen' || ($_GET['com']=='background' && $_GET['type']!='qc1' && $_GET['type']!='qc2' && $_GET['type']!='qc3' && $_GET['type']!='qc4' ) || ( $_GET['com']=='slider' && $_GET['type'] !='ketnoi' ) || $_GET['com']=='letruot') echo ' activemenu' ?>" id="menu_qc"><a href="" title="" class="exp"><span>Banner </span><strong></strong></a>
     <ul class="sub">		
        <?php phanquyen_menu('Cập nhật logo 1','background','capnhat','logo1'); ?>
        <?php phanquyen_menu('Cập nhật logo 2','background','capnhat','logo2'); ?>
        <?php phanquyen_menu('Cập nhật banner','background','capnhat','banner'); ?>
        <?php phanquyen_menu('Cập nhật logo in','background','capnhat','logo'); ?>
        <?php phanquyen_menu('Cập nhật thanh toán','background','capnhat','payment'); ?>
        <?php //phanquyen_menu('Cập nhật banner mobile','background','capnhat','banner_mobi'); ?>
        <?php phanquyen_menu('Cập nhật Bộ công thương','background','capnhat','congthuong'); ?>
        <?php phanquyen_menu('Quản lý slider','slider','man_photo','slider'); ?>
        <?php phanquyen_menu('Quản lý slider trang con','slider','man_photo','slider1'); ?>
        <?php //phanquyen_menu('Quản lý mạng xã hội','slider','man_photo','mangxahoi'); ?>
        <?php phanquyen_menu('Quản lý đối tác','slider','man_photo','doi-tac'); ?>
        <?php phanquyen_menu('Cập nhật góp ý','background','capnhat','qc5'); ?>

        <?php //phanquyen_menu('Cập nhật background','anhnen','capnhat','background'); ?>
        <?php //phanquyen_menu('Quản lý quảng cáo','slider','man_photo','quang-cao'); ?>
        <?php //phanquyen_menu('Quản lý quảng cáo 2 bên','slider','man_photo','le-truot'); ?>
        <?php //phanquyen_menu('Cập nhật pupop quảng cáo','background','capnhat','pupop'); ?>
     </ul>
</li>

<li class="categories_li gallery_li <?php if( $_GET['com']=='background' && ($_GET['type']=='qc1' || $_GET['type']=='qc2' || $_GET['type']=='qc3' || $_GET['type']=='qc4' )) echo ' activemenu' ?>" id="menu_qc"><a href="" title="" class="exp"><span>Quảng cáo</span><strong></strong></a>
     <ul class="sub">		
         <?php phanquyen_menu('Banner header','background','capnhat','qc2'); ?>
        <?php phanquyen_menu('Cập nhật quảng cáo trang chủ 1','background','capnhat','qc1'); ?>
       
        <?php phanquyen_menu('Cập nhật quảng cáo trang chủ 2','background','capnhat','qc3'); ?>
       
	   
	    <?php phanquyen_menu('Cập nhật quảng cáo trang trong 1','background','capnhat','qc4'); ?>
       
        <?php phanquyen_menu('Cập nhật quảng cáo trang trong 2','background','capnhat','qc5'); ?>
       

        <?php //phanquyen_menu('Cập nhật background','anhnen','capnhat','background'); ?>
        <?php //phanquyen_menu('Quản lý quảng cáo','slider','man_photo','quang-cao'); ?>
        <?php //phanquyen_menu('Quản lý quảng cáo 2 bên','slider','man_photo','le-truot'); ?>
        <?php //phanquyen_menu('Cập nhật pupop quảng cáo','background','capnhat','pupop'); ?>
     </ul>
</li>



<?php /*<li class="categories_li <?php if($_GET['com']=='database' || $_GET['com']=='backup') echo ' activemenu' ?>" id="menu_ntt"><a href="" title="" class="exp"><span>Database</span><strong></strong></a>
      	<ul class="sub">
        	<?php phanquyen_menu('Quản lý database','database','man',''); ?>
            <?php phanquyen_menu('Backup database','backup','backup_database',''); ?>
            <?php phanquyen_menu('Backup file','backup','backup_file',''); ?>
        </ul>
</li>



<li class="categories_li <?php if($_GET['com']=='place') echo ' activemenu' ?>" id="menu_pl"><a href="" title="" class="exp"><span>Địa điểm</span><strong></strong></a>
    <ul class="sub">
        <?php phanquyen_menu('Quản lý Tỉnh thành','place','man_city',''); ?>
        <?php phanquyen_menu('Quản lý Quận huyện','place','man_dist',''); ?>
        <?php phanquyen_menu('Quản lý Phường xã','place','man_ward',''); ?>
        <?php phanquyen_menu('Quản lý Đường','place','man_street',''); ?>
    </ul>
</li>
<li class="categories_li <?php if($_GET['com']=='phanquyen' || $_GET['com']=='com' || $_GET['com']=='user' && $_GET['act']=='man') echo ' activemenu' ?>" id="menu_pq"><a href="" title="" class="exp"><span>Phân quyền</span><strong></strong></a>
  <ul class="sub">
        <?php phanquyen_menu('Quản lý nhóm nhân viên quản trị','phanquyen','man',''); ?>
        <?php phanquyen_menu('Quản lý nhân viên quản trị','user','man',''); ?>
        <?php //phanquyen_menu('Quản lý com','com','man',''); ?>
    </ul>
</li>
<li class="categories_li <?php if($_GET['com']=='thanhvien') echo ' activemenu' ?>" id="menu_tv"><a href="" title="" class="exp"><span>Thành viên website</span><strong></strong></a>
  <ul class="sub">
        <?php phanquyen_menu('Quản lý thành viên đăng ký','thanhvien','man',''); ?>
    </ul>
</li>*/?>
<li class="categories_li setting_li <?php if($_GET['com']=='company' ||$_GET['com']=='lkweb' || $_GET['com']=='meta' || $_GET['com']=='about' || $_GET['com']=='user' && $_GET['act']=='admin_edit') echo ' activemenu' ?>" id="menu_cp"><a href="" title="" class="exp"><span>Nội dung khác</span><strong></strong></a>
    <ul class="sub">
	<?php phanquyen_menu('Quản lý liên kết','lkweb','man','lkweb'); ?>
    	<?php phanquyen_menu('Cấu hình thông tin Website','company','capnhat','company'); ?>
        <?php phanquyen_menu('Tài nguyên website','company','assets','company'); ?>
         <li<?php if($_GET['act']=='admin_edit') echo ' class="this"' ?>><a href="index.php?com=user&act=admin_edit">Quản lý Tài Khoản</a></li>
    </ul>
</li>
</ul>
