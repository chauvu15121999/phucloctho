<?php

if($id_dm>0){
  $d->reset();
  $sql="select id,thuonghieu from table_product_danhmuc where id='".$id_dm."' order by stt,id desc";
  $d->query($sql); 	 
  $danhmuc=$d->fetch_array();	
  if($danhmuc['thuonghieu']!=''){ 
   $w=" and id IN (".$danhmuc['thuonghieu'].")";
 }else{
   $w='';
 }
}else{
  $w='';
}

$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,type,photo from #_product_thuonghieu where hienthi=1 and type='san-pham'  $w order by stt,id desc";
$d->query($sql);
$product_br=$d->result_array();

if($_GET['result']!=''){
  $d->reset();
  $sql="select ten$lang as ten from #_product_thuonghieu where hienthi=1 and type='san-pham' and id=".(int)$_GET['result']." order by stt,id desc";
  $d->query($sql);
  $detail_br=$d->fetch_array();
}

$d->reset();
$sql = "select count(id) as numb FROM #_comment where type='".$type."' and product_id='".$id."' and comment_type='nhanxet' and hienthi=1 order by ngaytao";
$d->query($sql);
$count_bl = $d->fetch_array();

$d->reset();
$sql = "select count(id) as count FROM #_comment where type='".$type."' and product_id='".$id."' and comment_type='hoidap' and parent_id=0 and hienthi=1 order by ngaytao";
$d->query($sql);
$binhluan1 = $d->fetch_array();
?>

<div class="box-slider clearfix">
  <div class="wap_l">
    <div class="tieude_giua tt_chitiet clearfix" style="margin-top:5px;">
     <div class="dt_right"><?=_chitietsanpham?></div>
     <div class="box-thuonghieu-right">
      <div class="box-thuonghieu1">
       <div class="bx_ww_content_ls load_page_ls_<?=(int)$id_dm?>" data-rel="<?=(int)$id_dm?>"></div>
       <div id="get_list"></div>
					<?php /*<div class="slider-thuonghieu1">
						<?php for($i=0;$i<count($product_br);$i++){?>
						<div>
							<div class="br_item">
								<a href="san-pham/<?=$product_dm['tenkhongdau']?>-<?=$product_dm['id']?>&result=<?=$product_br[$i]['id']?><?php if($_GET['gia']!=''){echo '&gia='.$_GET['gia'];}?><?php if($_GET['p']!=''){echo '&p='.$_GET['p'];}?>"><?=$product_br[$i]['ten']?></a>
							</div>
						</div>
						<?php }?>
           </div>*/?>
         </div>

       </div>
       <div class="clear"></div>
       <div class="mobile-thuonghieu-cnt">
        <div class="mobile-thuonghieu">
         <div class="over-thuonghieu">
          <?php for($i=0;$i<count($product_br);$i++){?>
            <div class="over_mobile">
             <div class="br_item">
              <a href="san-pham/<?=$product_dm['tenkhongdau']?>-<?=$product_dm['id']?>&result=<?=$product_br[$i]['id']?><?php if($_GET['gia']!=''){echo '&gia='.$_GET['gia'];}?><?php if($_GET['p']!=''){echo '&p='.$_GET['p'];}?>"><?=$product_br[$i]['ten']?></a>
            </div>
          </div>
        <?php }?>
      </div>
    </div>
  </div>
  <div class="box-gia">
    <div class="over-thuonghieu">
     <b class="tieude_gia over_mobile">Chọn mức giá:</b>
     <?php for($i=0;$i<count($product_gia);$i++){?>
       <a class="over_mobile" href="san-pham/<?=$product_dm['tenkhongdau']?>-<?=$product_dm['id']?><?php if($_GET['result']!=''){echo '&result='.$_GET['result'];}?>&gia=<?=$product_gia[$i]['id']?><?php if($_GET['p']!=''){echo '&p='.$_GET['p'];}?>" class="<?php if($_GET['gia']==$product_gia[$i]['id']){ echo 'checked_gia';}?>"><?=$product_gia[$i]['ten']?></a>
     <?php }?> 		 
   </div>
 </div>
</div>
<?php include _template."layout/bread.php";?>
<div class="box_container">
 <div class="wap_pro detail_bx">


  <div class="gala-pro">
      <?php  
      $d->reset();
      $d->query("select photo,link,file_up from table_video where hienthi=1 and type='video' and id_pro='".$row_detail['id']."' order by stt,id desc");
      $videos_pro = $d->result_array();?>

      <div id="show_gala">
        <?php if(!empty($videos_pro)){ ?>
            <div class="tab_gala active" id="tab_gala1">
              <div class="owl-gala-vd owl-carousel owl-theme">
                <?php foreach($videos_pro as $v){ ?>
                  <div class="img_gala" data-fo="fotorama_video" data-autoplay="1000" data-owl="owl-gala-vd">
                    
                      <img src="<?=_upload_khac_l.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>" onerror="this.src='images/noimage.png';">

                      <img class="over" src="images/icon-yt.png" alt="play">
                 
                  </div>
                <?php } ?>
              </div>
              <div class="prev_gala prev_gala_vd"></div>
              <div class="next_gala next_gala_vd"></div>
              <a class="countimg" data-fo="fotorama_video1" data-owl="owl-gala-vd">
                <span class="btn"><i class="fa fa-search-plus" aria-hidden="true"></i> Phòng to tính năng nổi bật</span>
                <span class="count count_vd">1/<?=count($videos_pro)?></span>
              </a>
            </div>
        <?php } ?>
        <div class="tab_gala <?php if(empty($videos_pro)) echo 'active'; ?>" id="tab_gala2">
          <div class="owl-gala-img owl-carousel owl-theme">
            <div class="img_gala" data-fo="fotorama_img" data-autoplay="1000" data-owl="owl-gala-img">
              <img src="<?php if($row_detail['photo'] != NULL)echo _upload_sanpham_l.$row_detail['photo'];else echo 'images/noimage.png';?>" />
            </div>
            <?php foreach($hinhthem as $v){ ?>
              <div class="img_gala" data-fo="fotorama_img" data-owl="owl-gala-img">
                <img src="<?=_upload_hinhthem_l.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
              </div>
            <?php } ?>
          </div>
          <div class="prev_gala prev_gala_img"></div>
          <div class="next_gala next_gala_img"></div>
          <a class="countimg" data-fo="fotorama_img" data-owl="owl-gala-img">
            <span class="btn"><i class="fa fa-search-plus" aria-hidden="true"></i> Phòng to hình ảnh sản phẩm</span>
            <span class="count count_img">1/<?=count($hinhthem)+1?></span>
          </a>
        </div>
      </div>

      <div class="flex_gala">
        <?php if(!empty($videos_pro)){ ?>
          <div class="item_gala active" data-tab="tab_gala1">
            <div class="img"><img src="thumb/66x55/2/<?=_upload_khac_l.$videos_pro[0]['photo']?>" onerror="this.src='thumb/66x55/2/images/noimage.png';" alt="<?=$row_detail['ten'.$lang]?>"><img class="over" src="images/icon-yt.png" alt="play"></div>
            <div class="name">Video</div>
          </div>
        <?php } ?>
        <div class="item_gala <?php if(empty($videos_pro)) echo 'active'; ?>" data-tab="tab_gala2">
          <div class="img"><img src="thumb/66x55/2/<?=_upload_sanpham_l.$row_detail['photo']?>" onerror="this.src='thumb/66x55/2/images/noimage.png';" alt="<?=$row_detail['ten'.$lang]?>"></div>
          <div class="name"><p>Hình</p><p>sản phẩm</p></div>
        </div>
        <div class="item_gala no-click xem_thongso">
          <div class="img">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            Xem thông số kỹ thuật
          </div>
        </div>
      </div>
        
 </div>


 <ul class="product_info">
    <?php
    if($row_detail['tiente']==2){
     $currency='usd';
   }else{
     $currency='vnđ';
   }	
   ?>
   <li class="ten"><?=$row_detail['ten']?></li>
   <li class="gh1">GIAO HÀNG TRÊN 63 TỈNH THÀNH</li>
   <?php if($row_detail['masp'] != '') { ?><li><b><?=_masanpham?>:</b> <span><?=$row_detail['masp']?></span></li><?php } ?>

   <li class="gia">
    <?php if($row_detail['giakm'] > 0){?>
      <span class="giakm">Giá: <?=number_format($row_detail['gia'],0, ',', '.').'  '.$currency;?></span>
      <span class="giacu">Giá: <?=number_format($row_detail['giakm'],0, ',', '.')?> </span>
      <span class="giam">(Giảm: -<?=tinh_phantram($row_detail['giakm'],$row_detail['gia']);?>%)</span>
    <?php } else{?>

      <?php if($row_detail['gia']>0) echo 'Giá: '.number_format($row_detail['gia'],0, ',', '.').' '.$currency;else echo _lienhe;?>

    </span>
  <?php }?>
  </li>
  <?php if($row_detail['size'] != '') { ?>
   <li><b><?=_chonsize?>:</b>
     <?php $arr_size = explode(',',$row_detail['size']);
     foreach($arr_size as $key=>$value){
       echo '<span class="size">'.$value.'</span>';
     }
     ?>
   </li>
  <?php } ?>

  <?php if($row_detail['mausac'] != '') { ?>
   <li><b style="float:left;"><?=_chonmau?>:</b>
     <?php $arr_mausac = explode(',',$row_detail['mausac']);
     foreach($arr_mausac as $key=>$value){
      echo '<span class="mausac" style="background:'.$value.'">'.$value.'</span>';
    }
    ?>
    <div class="clear"></div>
  </li>
  <?php } ?>
  <li><b><?=_soluong?>:</b> <input type="number" value="1" class="soluong" /> 

    <?php if($row_detail['tinhtrang']!=''){ ?><i class="tinhtrang"><?=$row_detail['tinhtrang']?></i> <?php }?>
  </li>
  <li><b><?=_luotxem?>:</b> <span><?=$row_detail['luotxem']?></span></li>
  <li><b><?=_baohanh?>:</b> <span><?=$row_detail['baohanh']?></span></li>
  <li><b><?=_congsuat?>:</b> <span><?=$row_detail['congsuat']?></span></li>

  <?php  if($row_detail['mota'] != '') { ?><li><?=$row_detail['mota']?></li><?php }?>


  <li class="btn_act_sp_detail">
    <a class="add_to_cart cart_popup dathang" data-id="<?=$row_detail['id']?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đặt mua</a>
    <a class="add_quantam" data-id="<?=$row_detail['id']?>" data-toggle="tooltip" data-placement="top" title="Thêm vào danh sách quan tâm"><i class="fas fa-heart"></i></a>
    <a class="add_sosanh" data-id="<?=$row_detail['id']?>" data-toggle="tooltip" data-placement="top" title="Thêm vào danh sách so sánh"><i class="fas fa-sync-alt"></i></a>
    <div class="clearfix"></div>
  </li>
  <?php /*?><li><div class="danhgiasao" data-url="<?=getCurrentPageURL();?>"><?php for($i=1;$i<=10;$i++) { ?><span data-value="<?=$i?>"></span><?php } ?>&nbsp;&nbsp;<b class="num_danhgia"><?=$num_danhgiasao?>/10</b></div><?php */?>
  </li>
  <li> 
   <div class="addthis_toolbox addthis_default_style ">
    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
    <a class="addthis_button_facebook_share" fb:share:layout="button_count"></a>
    <a class="addthis_button_tweet"></a>
    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
    <a class="addthis_counter addthis_pill_style"></a>
  </div>
  </li>
  <li>
    <div id="rattings">
      <b>Đánh giá: </b>
      <a class="rating_icon <?php if($row_detail['sao'] > 0) echo 'active';?>" data-id="1" data-sp="<?=$row_detail["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
      <a class="rating_icon <?php if($row_detail['sao'] >= 1.5) echo 'active';?>" data-id="2" data-sp="<?=$row_detail["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
      <a class="rating_icon <?php if($row_detail['sao'] >= 2.5) echo 'active';?>" data-id="3" data-sp="<?=$row_detail["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
      <a class="rating_icon <?php if($row_detail['sao'] >= 3.5) echo 'active';?>" data-id="4" data-sp="<?=$row_detail["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
      <a class="rating_icon <?php if($row_detail['sao'] >= 4.5) echo 'active';?>" data-id="5" data-sp="<?=$row_detail["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
      <?php if($row_detail['luot']>0) {?><span>(<?=$row_detail['luot']?> đánh giá)</span><?php }?>
    </div>
  </li>
</ul>
<div class="clear"></div>
</div><!--.wap_pro-->

<div id="tabs">
  <ul id="ultabs">
    <li data-vitri="0"><?=_thongtinsanpham?></li>
    <li data-vitri="1"><?=_binhluan?> (<?=$count_bl['numb']?>)</li>
  </ul>
  <div style="clear:both"></div>
  <div id="content_tabs">
    <div class="tab" id="tab_0">
      <div id="popupimage">
        <?=str_replace('http://', '//', $row_detail['noidung'])?>
      </div>
    </div>

  </div><!---END #content_tabs-->
</div><!---END #tabs-->

<?php if(!empty($_SESSION['product_viewed'])){ ?>
  <div class="sec_detail sec_pro_dx">
    <div class="tieude_giua"><div>Sản phẩm đã xem</div></div>
    <div class="wrap_detail">
      <div class="owl-sp-view owl-carousel owl-theme">
        <?php foreach($_SESSION['product_viewed'] as $idd){ 
          $v = get_fetch("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,sao,luot,tiente FROM #_product where hienthi=1 and id='$idd' limit 0,1"); ?>
              <div class="item-slick clearfix eff-btn-ac">
                  <div class="sp_img zoom_hinh">
                    <a data-id="<?=$v['id']?>" href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html">
                      <img class="lazy"  data-src="thumb/240x220/2/<?php if($v['photo']!=NULL) echo _upload_sanpham_l.$v['photo']; else echo 'images/noimage.png';?>" alt="<?=$v['ten']?>" />
                    </a>
                  </div>
                  <div class="thongtin-sp">
                    <h3 class="sp_name"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>" ><?=$v['ten']?></a></h3>
                    <p class="sp_gia">
                      <span class="gia"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' '.$currency;else echo _lienhe;?></span>
                    </p>
                    <div class="rattings">
                      <a class="rating_icon <?php if($v["sao"] > 0) echo 'active';?>" data-id="1" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <a class="rating_icon <?php if($v["sao"] >= 1.5) echo 'active';?>" data-id="2" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <a class="rating_icon <?php if($v["sao"] >= 2.5) echo 'active';?>" data-id="3" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <a class="rating_icon <?php if($v["sao"] >= 3.5) echo 'active';?>" data-id="4" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <a class="rating_icon <?php if($v["sao"] >= 4.5) echo 'active';?>" data-id="5" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <?php if($v['luot']>0) {?><span>(<?=$v['luot']?> đánh giá)</span><?php }?>
                    </div>
                  </div>
                </div>
        <?php } ?>
      </div>
      <div class="prev_sp_detail prev_sp_dx"></div>
      <div class="next_sp_detail next_sp_dx"></div>
    </div>
  </div>
<?php } ?>

<?php if(!empty($arr_mk)){ ?>
  <div class="sec_detail sec_pro_mk">
    <div class="tieude_giua"><div>Sản phẩm mua kèm</div></div>
    <div class="wrap_detail">
      <div class="owl-sp-mk owl-carousel owl-theme">
        <?php foreach($arr_mk as $idd){ 
          $v = get_fetch("select id,ten$lang as ten,tenkhongdau,type,thumb,photo,masp,gia,giakm,sao,luot,tiente FROM #_product where hienthi=1 and id='$idd' limit 0,1"); ?>
              <div class="item-slick clearfix eff-btn-ac">
                  <div class="sp_img zoom_hinh">
                    <a data-id="<?=$v['id']?>" href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html">
                      <img class="lazy"  data-src="thumb/240x220/2/<?php if($v['photo']!=NULL) echo _upload_sanpham_l.$v['photo']; else echo 'images/noimage.png';?>" alt="<?=$v['ten']?>" />
                    </a>
                  </div>
                  <div class="thongtin-sp">
                    <h3 class="sp_name"><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>" ><?=$v['ten']?></a></h3>
                    <p class="sp_gia">
                      <span class="gia"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' '.$currency;else echo _lienhe;?></span>
                    </p>
                    <div class="rattings">
                      <a class="rating_icon <?php if($v["sao"] > 0) echo 'active';?>" data-id="1" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <a class="rating_icon <?php if($v["sao"] >= 1.5) echo 'active';?>" data-id="2" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <a class="rating_icon <?php if($v["sao"] >= 2.5) echo 'active';?>" data-id="3" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <a class="rating_icon <?php if($v["sao"] >= 3.5) echo 'active';?>" data-id="4" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <a class="rating_icon <?php if($v["sao"] >= 4.5) echo 'active';?>" data-id="5" data-sp="<?=$v["id"]?>"><i class="fa fa-star" aria-hidden="true"></i></a>
                      <?php if($v['luot']>0) {?><span>(<?=$v['luot']?> đánh giá)</span><?php }?>
                    </div>
                  </div>
                </div>
        <?php } ?>
      </div>
      <div class="prev_sp_detail prev_sp_mk"></div>
      <div class="next_sp_detail next_sp_mk"></div>
    </div>
  </div>
<?php } ?>


<div id="tabs2"> 
  <div id="content_tabs">

    <div class="tab" id="tab_1">
     <?php include _template."layout/comment.php";?>
   </div>
 </div><!---END #content_tabs-->
</div><!---END #tabs-->


<div id="tabs1" class="tabs_<?=$binhluan1['count']?>">
  <div id="content_tabs">
    <div class="tab">
     <?php include _template."layout/hoidap.php";?>
   </div>
 </div><!---END #content_tabs-->
</div><!---END #tabs-->
<div class="clear"></div>
</div><!--.box_containerlienhe-->

<?php if(count($product)>0) { ?>
  <div id="tabs3">
    <div class="tieude_giua"><div><?=$title_other?></div></div>
    <div class="wap_item">
     <?php foreach ($product as $k => $v) { ?>
      <?php include _template."layout/sanpham.php";?>
    <?php } ?> 
  </div><!---END .wap_item-->
  <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div>
<?php } ?>

</div>
<div class="wap_r">
  <?php include _template."layout/left.php";?>
</div>
</div>
<style type="text/css">
  .addthis_button_facebook_like{
    float: left !important;
    width: 90px !important;
    margin-left: -10px;
    margin-right: 0px;
  }
</style>