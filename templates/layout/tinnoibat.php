<?php
	$d->reset();
	$sql = "select id,ten$lang as ten,tenkhongdau,type,thumb,mota$lang as mota from #_news where type='tin-tuc' and hienthi=1 and noibat=1 order by stt,id desc";
	$d->query($sql);
	$tinmoi = $d->result_array();
?>
<script type="text/javascript">
    $(document).ready(function(){
      $('.chay_tinnoibat').slick({
				  lazyLoad: 'ondemand',
		      infinite: true,//Hiển thì 2 mũi tên
					accessibility:true,
					vertical:true,//Chay dọc
				  slidesToShow: 3,    //Số item hiển thị
				  slidesToScroll: 1, //Số item cuộn khi chạy
				  autoplay:true,  //Tự động chạy
					autoplaySpeed:3000,  //Tốc độ chạy
					speed:1000,
					arrows:false, //Hiển thị mũi tên
					centerMode:false,  //item nằm giữa
					dots:false,  //Hiển thị dấu chấm
					draggable:true,  //Kích hoạt tính năng kéo chuột
      });
	});
</script>

<div class="tinnoibat control_slick_doc">
<div class="tieude2"><?=_tintucnoibat?></div>
	<div class="chay_tinnoibat">
    	<?=lay_tintuc('tin-tuc','item_tnb',1)?>
    </div>
</div>
