<?php if($deviceType=='phone') { ?>
	<style>div.phone_mobi{background: rgba(242, 7, 7, 0.87);width:100%;position:fixed;left:0;bottom:0;height:45px;line-height:45px;color:#fff; z-index:50;}
    div.phone_mobi ul{list-style:none; margin:0; padding:0; display: flex;}
    div.phone_mobi ul li{flex: auto 1 0;text-align:center;}
    div.phone_mobi ul li a{color:#fff;text-decoration:none;font-size:15px;}
    div.phone_mobi ul li a i{font-size:19px;margin-right:5px;margin-top:3px;}
    .blink_me {-webkit-animation-name: blinker;-webkit-animation-duration: 1s;-webkit-animation-timing-function: linear;-webkit-animation-iteration-count: infinite;-moz-animation-name: blinker;-moz-animation-duration: 1s;-moz-animation-timing-function: linear;-moz-animation-iteration-count: infinite;animation-name: blinker;
    animation-duration: 1s;animation-timing-function: linear;animation-iteration-count: infinite;}
    @-moz-keyframes blinker {  0% { opacity: 1.0; }50% { opacity: 0.0; }100% { opacity: 1.0; }}
    @-webkit-keyframes blinker {  0% { opacity: 1.0; }50% { opacity: 0.0; }100% { opacity: 1.0; }}
    @keyframes blinker {0% { opacity: 1.0; }50% { opacity: 0.0; }100% { opacity: 1.0; }}
    </style>
    <div class="phone_mobi">
        <ul>
            <li><a class="blink_me" href="tel:<?=preg_replace('/[^0-9]/','',$company['dienthoai']);?>"><i class="fas fa-phone-volume"></i><?=_goidien?></a></li>
            <li><a href="sms:<?=preg_replace('/[^0-9]/','',$company['dienthoai']);?>"><i class="fas fa-comments"></i><?=_nhantin?></a></li>
            <li><a href="lien-he.html"><i class="fas fa-map-marker-alt"></i><?=_chiduong?></a></li>
						<!--<li><a href="https://zalo.me/<?=preg_replace('/[^0-9]/','',$company['dienthoai']);?>"><i class="fas fa-comment"></i>ZaLo</a></li>-->
        </ul>
    </div>
<?php } ?>
