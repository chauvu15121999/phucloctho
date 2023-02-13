<script type="text/javascript">
	$(document).ready(function(e) {
		$('.click_ajax').click(function(){
			if(isEmpty($('#ten_lienhe').val(), "<?=_nhaphoten?>"))
			{
				$('#ten_lienhe').focus();
				return false;
			}
			if(isEmpty($('#diachi_lienhe').val(), "<?=_nhapdiachi?>"))
			{
				$('#diachi_lienhe').focus();
				return false;
			}
			if(isEmpty($('#dienthoai_lienhe').val(), "<?=_nhapsodienthoai?>"))
			{
				$('#dienthoai_lienhe').focus();
				return false;
			}
			if(isEmpty($('#email_lienhe').val(), "<?=_emailkhonghople?>"))
			{
				$('#email_lienhe').focus();
				return false;
			}
			if(isEmail($('#email_lienhe').val(), "<?=_emailkhonghople?>"))
			{
				$('#email_lienhe').focus();
				return false;
			}
			if(isEmpty($('#noidung_lienhe').val(), "<?=_nhapnoidung?>"))
			{
				$('#noidung_lienhe').focus();
				return false;
			}
			if(isEmpty($('#capcha').val(), "<?=_nhapmabaove?>"))
			{
				$('#capcha').focus();
				return false;
			}
			$.ajax({
				type:'post',
				url:$(".frm").attr('action'),
				data:$(".frm").serialize(),
				dataType:'json',
				beforeSend: function() {
					$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');
				},
				error: function(){
					add_popup('<?=_hethongloi?>');
					$(".frm")[0].reset();
				},
				success:function(kq){
					add_popup(kq.thongbao);
					$('#capcha').val('');
					if(kq.nhaplai=='nhaplai')
					{
						$(".frm")[0].reset();
					}
				}
			});
		});
    });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#reset_capcha").click(function() {
			$("#hinh_captcha").attr("src", "sources/captcha.php?"+Math.random());
			return false;
		});
	});
</script>

<div class="tieude_giua"><div><?=$title_cat?></div></div>
<div class="box_container">
   <div class="content">
   		<div class="tt_lh">
        <?=lay_text('lienhe');?>
		<div class="frm_lienhe">
        	<form method="post" name="frm" class="frm" action="ajax/contact.php" enctype="multipart/form-data">
            	<div class="loicapcha thongbao"></div>
            	<div class="item_lienhe"><input name="ten_lienhe" type="text" id="ten_lienhe" placeholder="<?=_hovaten?>" /></div>

                <div class="item_lienhe"><input name="diachi_lienhe" type="text" id="diachi_lienhe" placeholder="<?=_diachi?>" /></div>

                <div class="item_lienhe"><input name="dienthoai_lienhe" type="text" id="dienthoai_lienhe" placeholder="<?=_dienthoai?>" /></div>

                <div class="item_lienhe"><input name="email_lienhe" type="text" id="email_lienhe" placeholder="Email" /></div>

                <div class="item_lienhe"><textarea name="noidung_lienhe" id="noidung_lienhe" rows="5" placeholder="<?=_noidung?>"></textarea></div>

                <div class="item_lienhe"><p><?=_mabaove?>:<span>*</span></p>
                <img src="sources/captcha.php" id="hinh_captcha">
                       	<a href="#reset_capcha" id="reset_capcha" title="<?=_doimakhac?>"><img src="images/refresh.png" alt="reset_capcha" /></a></div>

                <div class="item_lienhe"><input name="capcha" type="text" id="capcha" placeholder="<?=_mabaove?>" /></div>

                <div class="item_lienhe" >
                	<input type="button" value="<?=_gui?>" class="click_ajax" />
                    <input type="button" value="<?=_nhaplai?>" onclick="document.frm.reset();" />
                </div>
            </form>
        </div><!--.frm_lienhe-->
        </div>

        <div class="bando">
			<?=$company['bando']?>          
        </div><!--.bando-->
   </div><!--.content-->
</div><!--.box_container-->
