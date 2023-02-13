<?php 
	$d->reset();
	$sql_slider = "select ten$lang as ten,link,photo,mota$lang as mota from #_slider where hienthi=1 and type='slider1' order by stt,id desc";
	$d->query($sql_slider);
	$slider=$d->result_array();
	?>
 
	<div class="slider box-slider clearfix">
		<div class="wap_l wap_l1">
			<div class="slider-slick">
				<?php for($i=0,$count_slider=count($slider);$i<$count_slider;$i++){ ?>
					<div>
						<a href="<?=$slider[$i]['link']?>">
							<img src="thumb/850x161/1/<?php if($slider[$i]['photo']!='')echo _upload_hinhanh_l.$slider[$i]['photo'];else echo 'images/noimage.png' ?>" alt="slider"/>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="wap_r wap_r1">
			<div class="dongho">
				<table border="0" bordercolor="white" width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="gray">
					<tr>
						<td width="100%" bgcolor="white" align="auto">
							<center>
								<script>
									var myVar=setInterval(function(){myTimer()},1000);
									function myTimer()
									{
										var d=new Date();
										var t=d.toLocaleTimeString();
										document.getElementById("h").innerHTML=t;
									}
								</script>
								<font size="5" color="#660000" id="h"></font>
								<font size="3" color="#660000">
									<script type="text/javascript">
										n=new Date();if(n.getTimezoneOffset()==0)t=n.getTime()+(7*60*60*1000);else t=n.getTime();n.setTime(t);var dn=new Array("Chủ nhật","Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy");d=n.getDay();m=n.getMonth()+1;y=n.getFullYear()
										document.write(dn[d]+", "+(n.getDate()<10?"0":"")+n.getDate()+"/"+(m<10?"0":"")+m+"/"+y)
									</script></font>
									<font size="1" color="#330099">
										<script type="text/javascript">
											n=new Date();if(n.getTimezoneOffset()==0)t=n.getTime()+(7*60*60*1000);else t=n.getTime();n.setTime(t);h=n.getHours()
											if(h>22)ht=dp="";else if(h<=4)ht=dp="";else if(h>4&&h<=6)ht=dp="";else if(h>17&&h<=18)ht=dp="";else if(h>18&&h<=22)ht=dp="";else {ht="";dp=""}if(n.getDay()==6 || n.getDay()==0)document.write(dp);else document.write(ht);
										</script>
										<script id="_wau9mr">
											var _wau = _wau || [];
											_wau.push(["small", "9u4k9xtsjmra", "9mr"]);
											function abc(){
												var s=document.createElement("script"); s.async=true;
												s.src="http://widgets.amung.us/small.js";
												document.getElementsByTagName("head")[0].appendChild(s);
											}
										</script>
									</font>
								</center></td></tr></table>
							</div>
							<a href="<?=layhinh('link','qc2')?>" class="quangcao-2" target="_blank"><img src="<?=layhinh('photo','qc2')?>" alt="Banner" /></a>
							 
						</div>
					</div>
					 
 
