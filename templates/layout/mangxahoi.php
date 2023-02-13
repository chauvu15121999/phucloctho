<?php
	$d->reset();
	$sql="select id,ten$lang as ten,link,photo from #_lkweb where hienthi=1 and type='mxh' order by stt,id desc";
	$d->query($sql);
	$mxh=$d->result_array();
?>
<?php for($i=0,$count_mxh=count($mxh);$i<$count_mxh;$i++) { ?>
    <a href="<?=$mxh[$i]['link']?>" target="_blank" title="<?=$mxh[$i]['ten']?>"><img src="<?=_upload_khac_l.$mxh[$i]['photo']?>" alt="<?php if($mxh[$i]['ten']!='') echo $mxh[$i]['ten'];else echo $company['ten']?>" /></a>
<?php } ?>