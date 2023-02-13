<?php

	$d->reset();
	$sql_video = "select id,ten$lang as ten,link from #_video where hienthi=1 and type='video' order by stt,id desc";
	$d->query($sql_video);
	$video = $d->result_array();

?>
<div class="tieude2">Video</div>
<link href="css/fotorama.css" rel="stylesheet">
<script src="js/fotorama.js" type="text/javascript"></script>
<div class="fotorama" data-nav="thumbs" data-width="700" data-arrows="true" data-thumbwidth="125" data-thumbheight="80" data-loop="true" data-autoplay="40000" data-fit="contain" data-allowfullscreen="true" data-stopautoplayontouch="false">            
    <?php for($j=0,$count_video=count($video);$j<$count_video;$j++){?>
        <a href="<?=$video[$j]['link']?>"><?=$video[$j]['ten']?></a>
    <?php } ?>
</div>
