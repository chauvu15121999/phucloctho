<?php

	$d->reset();
	$sql_hotro = "select ten$lang as ten,dienthoai,email,skype from #_yahoo where hienthi=1 and type='yahoo' order by stt,id desc";
	$d->query($sql_hotro);
	$hotro = $d->result_array();
?>
<script type="text/javascript">
	$(document).ready(function(e) {
		var laan = 0;
        var cao_hotro = $('.hotro_fix').height()-44;
		$('.hotro_fix').css({bottom:'-'+cao_hotro+'px'});
		$('.tieude_ht').click(function(){
			if(laan==0){
				$('.hotro_fix').animate({bottom:0},500);
				laan = 1;
			}else{
				$('.hotro_fix').animate({bottom:'-'+cao_hotro+'px'},500);
				laan = 0;
			}
		});
		
    });
</script>
<div class="hotro_fix">
<div class="tieude_ht"><img src="images/hotro.png" /></div>
	<div class="phone_ht"><?=$company['dienthoai']?></div>
    <?php for($i = 0, $count_hotro = count($hotro); $i < $count_hotro; $i++){ ?>
        <ul>
            <li><?=$hotro[$i]['ten']?></li>
            <li><b><?=$hotro[$i]['dienthoai']?></b></li>
            <li><a href="skype:<?=$hotro[$i]['skype']?>?chat"><img src="images/skype.png" alt="<?=$hotro[$i]['ten']?>" /></a></li>            
        </ul>
    <?php } ?>
</div><!---END #danhmuc-->

<style>
div.hotro_fix
{
	width: 300px;
	position:fixed;
	right:5px;
	bottom:0px;
	z-index:50;
	margin:0;
	border:1px solid  #d40808;
	background:#fff;
	border-radius:7px 7px 0px 0px;
}
div.tieude_ht
{
	position:absolute;
	top:-161px;
	left:0;
}
div.hotro_fix .phone_ht
{
	background:yellow;
	color:#d40808;
	border:2px solid  #d40808;
	text-align:center;font-size:21px;
	font-weight:bold;padding:4px;
	border-radius:7px 7px 0px 0px;
	margin-bottom:15px;
}
div.hotro_fix ul
{	
	padding:5px 15px;
	list-style:none;
}
div.hotro_fix ul li
{
	display:block;
	font-size:14px;
	display:inline-block;
	font-weight:bold;
	padding:0px 5px;
}
div.hotro_fix ul li img
{
	height:20px;
}
</style>