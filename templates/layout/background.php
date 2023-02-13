<?php
$d->reset();
$sql="select * from #_anhnen where type='background' limit 0,1";
$d->query($sql);
$background=$d->fetch_array();
if($background['hienthi']==0){
	$str_background = 'style="background:'.$background['color'].'"';}
	else{$str_background = 'style="background:'.$background['color'].' url('._upload_hinhanh_l.$background['photo'].') '.$background['repea'].' '.$background['position_x'].' '.$background['position_y'].' '.$background['fixed'].';background-size:'.$background['bgsize'].'"';}
	?>