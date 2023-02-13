<?php 

	include ("ajax_config.php");
	
	$d->reset();
	$sql_video = "select id,ten$lang as ten,link from #_video where hienthi=1 and type='video' order by stt,id desc";
	$d->query($sql_video);
	$video = $d->result_array();
	
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#clickvideo').change(function(){
			var src = '//www.youtube.com/embed/'+$(this).val()+'&autoplay=1';
			$('.left_video iframe').attr('src',src);
		});
    });
</script>

<div class="video_popup left_video">
	<iframe title="<?=$video[0]['ten']?>" width="100%" src="//www.youtube.com/embed/<?=getYoutubeIdFromUrl($video[0]['link'])?>" frameborder="0" allowfullscreen></iframe></div>
<select id="clickvideo">
    <?php for($i=0,$count_video=count($video);$i<$count_video;$i++){?>
        <option value="<?=getYoutubeIdFromUrl($video[$i]['link'])?>"><?=$video[$i]['ten']?></option>
    <?php } ?>
</select>
