<div id="sticky-right-3">
	<ul>
	
	   <li>
			 
			<a class="zalo1" href="<?=$company['toptop']?>" rel="nofollow" target="_blank" style="padding-top: 0px;">
				<img src="images/toptop.png" style="max-height: 20px;" alt="Tiktok">
			</a>
		</li>
		<li>
			 
			<a class="zalo1" href="http://zalo.me/<?=preg_replace('/[^0-9]/','',$company['fax']);?>" target="_blank">
				<img src="images/2zalo.png" style="    max-height: 25px;
    filter: brightness(0) invert(1);" alt="icon zalo">
			</a>
			<?php /*<span class="tooltip">Zalo </span>*/ ?>
		</li>
		<li>
			<a href="<?=$company['skype']?>"  id="page-top1"><i class="fab fa-skype"></i></a>
			<?php /*<span class="tooltip">Skype</span>*/ ?>
		</li>
		<li class="">
			<i class="we fab fa-weixin"></i>
			<?php /*<span class="tooltip">Wechat</span>
			<img class="tooltip2" src="<?=$company['whatapp']?>" />*/ ?>
		</li>
        <li>
            <a href="<?=str_replace('https://www.facebook.com/','https://m.me/',$company['fanpage'])?>" target="_blank"><i class="fab fa-facebook-messenger"></i></a>
            <?php /*<span class="tooltip">Messenger</span>*/ ?>
        </li>
		<li>
			<a href="<?=$company['fanpage']?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
			<?php /*<span class="tooltip">Facebook</span>*/ ?>
		</li>
        <li>
           <a href="<?=$company['youtube']?>" target="_blank" style="font-size: 11px; line-height: 21px;"><i class="fab fa-youtube"></i></a>
           <?php /*<span class="tooltip">Youtube</span>*/ ?>
        </li>
		<li>
           <a  href="<?= $company['googlemap'] ?>" target="_blank">
			<i class="fas fa-map-marker-alt"></i>
		   </a>
        </li>
	    <li class="loadtoptop"></li>
		
   </ul>
</div>
<style>
.mes {
   
}
.mes {
    position: fixed;
    bottom:5px; left:5px;
    text-align: left;
    width: 28px;
     <?php /*height: 40px;*/?>
	 display: block;
}
.mes i {
    width: 25px;
    <?php /*height: 40px;
    background: #43a1f3;*/?>
    background: none;
    color: #fff;
    border-radius: 100%;
    font-size: 20px;
    text-align: center;
    line-height: 1.9;
    position: relative;
    z-index: 999; display:block;
}
.mes i img{
	filter: brightness(0%); display:block;
}
.mes i {
    <?php /*background: orange;*/?>
	background: none;
}
.mes span {
    border-radius: 2px;
    text-align: center;
    background: rgb(103, 182, 52);
    padding: 9px;
    display: none;
    width: 180px;
    margin-left: 10px;
    position: absolute;
    color: #ffffff;
    z-index: 999;
    top: 0px;
    left: 40px;
    transition: all 0.2s ease-in-out 0s;
    -moz-animation: headerAnimation 0.7s 1;
    -webkit-animation: headerAnimation 0.7s 1;
    -o-animation: headerAnimation 0.7s 1;
    animation: headerAnimation 0.7s 1;
	
	top: 50%;
	transform: translateY(-50%);
}
.mes:hover span {
    display: block;
}
.mes span:before {
    content: "";
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 10px 10px 10px 0;
    border-color: transparent rgb(103, 182, 52) transparent transparent;
    position: absolute;
    left: -10px;
    top: 10px;
}

.zalo1 { line-height: 19px !important;}
.zalo1 img{ max-height: 7px;}
.zalo1:hover img{ filter: grayscale(0%); }
    #sticky-right-3 ul{
     list-style: none;
 }
 #sticky-right-3 {
    position: fixed;
	display: flex;
	justify-content: center;
    align-items: center;
	z-index: 10000;
    top: 2px;
	bottom: 2px;
	right: 2px;
	width: 32px;
	background-color: #7d1315;
	/*border-right: 2px solid #fff;*/
}
#sticky-right-3 li {
    -webkit-transition: .3s;
    -moz-transition: .3s;
    -o-transition: .3s;
    transition: .3s;
}
#sticky-right-3 a {
    width: 23px;
    height: 23px;
    color: #fff;
    display: block; margin: auto;
    text-align: center;
    line-height: 23px;
    cursor: pointer;
    right: initial;
    bottom: initial;
    position: relative;
	font-size: 13px;
	border: 1px solid #f0ff00;
}
.we{
    width: 23px;
    height: 23px;
    color: #fff;
    display: block;  margin: auto;
    text-align: center;
    line-height: 23px;
    cursor: pointer;
    right: initial;
    bottom: initial;
    position: relative;
	font-size: 13px;
	border: 1px solid #f0ff00;
}
#sticky-right-3 a:hover, #sticky-right-3 .we:hover {
    background: #da282d;
}
#sticky-right-3 a .fa {
    line-height: 27px;
}
#sticky-right-3 li .tooltip {
    position: absolute;
    right: 40px;
    display: block;
    line-height: 24px;
    background: #7e7e7e;
    top: 3px;
    padding: 0 15px;
    visibility: hidden;
    color: #fff;
    white-space: nowrap;
    font-size: 12px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    opacity: 0;
    -webkit-transition: .3s;
    -moz-transition: .3s;
    -o-transition: .3s;
    transition: .3s;
}
.tooltip2{
    display: none;
    position: absolute;
    top: -25px;
    right: 115px;
    width: 90px !important;
    height: 90px;
    max-width: initial !important;
}
#sticky-right-3 li:hover .tooltip2{
    display: block;
}
#sticky-right-3 li:hover .tooltip {
    opacity: 1;
    visibility: visible;
}
#sticky-right-3 li+li {
    margin-top: 15px;
}
#sticky-right-3 li .tooltip:after {
    content: '';
    width: 8px;
    height: 8px;
    background: #7e7e7e;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
    position: absolute;
    right: -4px;
    top: 8px;
}
</style>