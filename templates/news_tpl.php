<div class="tieude_giua"><div><?=$title_cat?></div></div>
<div class="box_container">

<?php if($type=='thu-vien'){?>

	<link rel="stylesheet" href="js/photobox/photobox/photobox.css">
        <script src='js/photobox/photobox/jquery.photobox.js'></script>
        <script type="text/javascript">
            $(document).ready(function($) {
                !(function(){
                    $('.item').photobox('a.thumb-k', { thumbs:true, loop:false });
                })();
            });
        </script>
        <div class="clearfix">
        <?php for($i=0;$i<count($tintuc);$i++){
			
			$sql_hinhkhac = "select id,ten,thumb,photo from #_hinhanh where type='".$type."' and hienthi=1 and id_hinhanh='".$tintuc[$i]['id']."' order by stt,id desc";
		$d->query($sql_hinhkhac);
			$hinhthem = $d->result_array();			
		?>
            <div class="item" itemscope itemtype="http://schema.org/Product">
            
                    <p class="sp_img"><a class="thumb-k" href="<?php echo _upload_tintuc_l.$tintuc[$i]['photo']?>" title="<?=$tintuc[$i]['ten']?>">
                    <img src="thumb/220x165/1/<?php if($tintuc[$i]['photo']!=NULL) echo _upload_tintuc_l.$tintuc[$i]['photo']; else echo 'images/noimage.png';?>" alt="<?=$tintuc[$i]['ten']?>" itemprop="image" /></a></p>
                    <h3 class="sp_name"><a title="<?=$tintuc[$i]['ten']?>" itemprop="name"><?=$tintuc[$i]['ten']?></a></h3>
                    
					<?php if(count($hinhthem)>0){?>
					<?php for($j = 0;$j<count($hinhthem); $j++){ ?>
                        <a class="thumb-them thumb-k" href="<?=_upload_hinhthem_l.$hinhthem[$j]['photo']?>"><img src="<?=_upload_hinhthem_l.$hinhthem[$j]['thumb']?>" alt="<?=$tintuc[$i]['ten']?> " /></a>                
                    <?php }}?>
                    
            </div><!---END .item-->
        <?php } ?>
        </div>

<?php }else{?>



<div class="box-slider clearfix">
    <div class="wap_l">

        <div class="p-15">

        <div class="wap_box_new clearfix">
            <?php 
           
            foreach($tintuc as $k => $v) { ?>
                <div class="box_news clearfix">
                    <div class="w-b">
                    <a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>"><img src="<?php if($v['photo']!=NULL)echo _upload_tintuc_l.$v['photo'];else echo 'images/noimage.png';?>" alt="<?=$v['ten']?>" /></a>      
                    <h3><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
                    <div class="mota catchuoi3"><?=$v['mota']?></div>
                     <p class="ngaytao"><b><?=$v['tacgia']?> - </b> Đăng lúc: <?=date('H:s d/m/Y',$v['ngaytao'])?><span></i><?=_luotxem?>: <?=$v['luotxem']?></span></p>
                    <a class="xemthem" href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html"><?=_xemthem?></a>                  
                </div>
                </div>
            <?php  }?>
    </div>
    </div>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
    </div>
    <div class="wap_r">
        <?php include _template."layout/left.php";?>
    </div>
</div>
<?php }?>


</div><!---END .box_container-->