<?php if($edit_noidung_email==false){ ?>
<style type="text/css">
	.icon_edit_mail{display: none !important;}
</style>
<?php } ?>
		 <div class="aa" style="width:100%; max-width:850px; font-family:arial; margin:auto; background:#fff;">
			<div style="width:100%; max-width:850px; border-bottom:1px solid #b3b8bc; margin:auto; padding-top:30px; padding-bottom:15px;">
				<div style="max-width:670px; width:100%;  margin:auto; color:#1972e8; font-size:18px; font-family:arial; text-align:center; line-height:1.3; margin-bottom:15px; position:relative;">
					<b><?=$tieude1['ten']?></b>
					
					
					<a href="index.php?com=about&act=capnhat&type=tieude1" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 5px 5px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
					
				</div>
				<div style="max-width:600px; width:100%; display:flex; margin:auto; position:relative;">
					<div style="float:left; align-self:center; width:40%;"><img src="<?=layhinh_adim('photo','banner')?>" style=" height:48px; width:auto; box-sizing:border-box;"/></div>
					<div style=" float:right; width:60%;text-align:right; align-self:center; font-size:12px;"><b><?=$tieude2['ten']?></b></div>
					<div style="clear:both;"></div>
					
					<a href="index.php?com=about&act=capnhat&type=tieude2" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 5px 5px; display: inline-block; position:absolute; top:8px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
					
				</div>
			</div>
			<div style="width:100%; max-width:850px; margin:auto; padding:40px 0;">
				<div style="max-width:670px; width:100%; margin:auto; position:relative;">
					<div style=" color:#666666; font-size:35px; font-family:arial; text-align:center; line-height:1.1; margin:auto; margin-bottom:15px; max-width:580px;">
						<?=$noidung1['ten']?>
					</div>
					<div style="height:1px; width:165px; background:#b3b8bc; margin:auto; margin-bottom:30px;"></div>
					<div style=" color:#666666; font-size:17px; text-align:justify; margin-bottom:25px; line-height:1.6;">
						<?=$noidung1['noidung']?>
						
					</div>
					<div style="text-align:center;">
						<a style="display:inline-block; padding:10px 30px; padding-top:13px; background:#7d1315; border-radius:5px; color:#fff; font-weight:bold; text-decoration:none; font-size:16px;" href="<?=$noidung1['link']?>">ĐI ĐẾN WEBSITE</a>
					</div>
					
					<a href="index.php?com=about&act=capnhat&type=noidung1" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 5px 5px; display: inline-block; position:absolute; top:8px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
					
				</div>
			</div>
			<div style="max-width:750px; width:100%;  border:1px solid #b3b8bc; border-top:4px solid #7d1315; margin:auto; margin-bottom:40px; position:relative; ">
				<div style="background:#e5e5e5; color:#666666; font-family:arial; margin:auto; font-size:20px; padding:15px 10px 15px 65px; box-sizing:border-box;">
					<b><?=$noidung2['ten']?></b>
				</div>
				<div style="width:100%; box-sizing:border-box; padding:10px 10px 10px 65px;">
					<div style="width: calc( 100% - 374px ); margin-bottom:10px; float:left; color:#666666; font-size:17px; text-align:justify; margin-bottom:25px; line-height:1.6; padding-top:25px;">
						<div style="line-height:1.6; margin-bottom:30px;"><?=$noidung2['noidung']?></div>
						<div style="text-align:center;">
							<a style="display:inline-block; width:260px; text-align:center; padding:8px 25px; padding-top:10px; background:#1972e8; border-radius:5px; color:#fff; font-weight:bold; text-decoration:none; font-size:16px; box-sizing:border-box;" href="<?=$noidung2['link']?>">Xem Chi Tiết</a>
						</div>
					</div>
					<div style="width:354px; float:right;">
						<img src="<?=_upload_hinhanh.$noidung2['photo']?>" style="margin-bottom:10px; width:100%; box-sizing:border-box; display:block;"/>
						<img src="<?=_upload_hinhanh.$noidung2['photo2']?>" style="display:block; width:100%; box-sizing:border-box;"/>
					</div>
					<div style="clear:both;"></div>
				 </div>
				 
				 <a href="index.php?com=about&act=capnhat&type=noidung2" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 5px 5px; display: inline-block; position:absolute; top:8px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
				 
			 </div>
			 
			<div style="max-width:750px; width:100%;  border:1px solid #b3b8bc; border-top:4px solid #7d1315; margin:auto; margin-bottom:40px; position:relative; ">
				<div style="background:#e5e5e5; color:#666666; font-family:arial; margin:auto; font-size:20px; padding:15px 10px 15px 65px; box-sizing:border-box;">
					<b><?=$noidung3['ten']?></b>
				</div>
 				 
				 <div style="width:100%; box-sizing:border-box; padding:10px 10px 10px 65px;">
					<div style="width: calc( 100% - 374px );; margin-bottom:10px; float:left; color:#666666; font-size:17px; text-align:justify; margin-bottom:25px; line-height:1.6; padding-top:25px;">
						<p style="line-height:1.6; margin-bottom:30px;"><?=$noidung3['noidung']?></p>
						<div style="text-align:center;">
							<a style="display:inline-block; width:260px; text-align:center; padding:8px 25px; padding-top:10px; background:#1972e8; border-radius:5px; color:#fff; font-weight:bold; text-decoration:none; font-size:16px; box-sizing:border-box;" href="<?=$noidung3['link']?>">Báo Giá</a>
						</div>
					</div>
					<div style="width:354px; float:right;">
						<img src="<?=_upload_hinhanh.$noidung3['photo']?>" style="display:block; width:100%; box-sizing:border-box;"/>
					</div>
					<div style="clear:both;"></div>
				 </div>
				 
				 <a href="index.php?com=about&act=capnhat&type=noidung3" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 5px 5px; display: inline-block; position:absolute; top:8px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
			 </div>
			<div style=" border-bottom:1px solid #b3b8bc; padding-bottom:20px;">
				 <div style="font-size:12px; color:#666666; max-width:750px; width:100%;  margin:auto;">
					 <div style="margin-bottom:5px;">Hẹn gặp lại !</div>
					 <div style="position:relative;">
						<b><?=$tieude3['ten']?></b>
						<a href="index.php?com=about&act=capnhat&type=tieude3" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 5px 5px; display: inline-block; position:absolute; top:8px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
					 </div>
				 </div>
			 </div>
			 <div style=" padding:20px 0;">
				 <div style="font-size:12px; text-align:center; color:#666666; width:750px; margin:auto;">
					 <div style="margin-bottom:5px;">Kết nối với chúng tôi !</div>
					 <div style="position:relative;">
						<?php for($i=0;$i<count($ketnoi);$i++){ ?>
						<a href="<?=$ketnoi[$i]['link']?>"><img src="<?=_upload_hinhanh.$ketnoi[$i]['photo']?>" style="height:22px;"/></a>
						<?php }?>
						
						<a href="index.php?com=slider&act=man_photo&type=ketnoi" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 5px 5px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
					 </div>
				 </div>
			 </div>
			 <div style=" background:#222222; padding:25px 0;">
				 <div style="color:#666666;max-width:750px; width:100%;  margin:auto; font-size:10px; color:#fff; ">
					<div style="width:100%;display:flex; margin:auto; margin-bottom:8px;">
						<div style="float:left; align-self:center; box-sizing:border-box; border-right:1px #bbbbbb solid; padding: 28px 10px; padding-left:0px; width:155px; text-align: center;"><img src="<?=layhinh_adim('photo','banner')?>" style="box-sizing:border-box; max-height:48px;border-radius: 50%;border:1px solid #bab6b6; display:inline-block; max-width:100%; "/></div>
						
						<div style="float:right; width:calc( 100% - 155px ); box-sizing:border-box; padding-left:10px; align-self:center;">
							<div style="position:relative;">
								<?=$tieude4['ten']?>&nbsp;
								<a href="index.php?com=about&act=capnhat&type=tieude4" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding:  3px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
							</div>
							<div style="position:relative;">
								<?=$tieude5['ten']?>&nbsp;
								<a href="index.php?com=about&act=capnhat&type=tieude5" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding:  3px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
							</div>
							<div style="position:relative;">
								<?=$tieude6['ten']?>&nbsp;
								<a href="index.php?com=about&act=capnhat&type=tieude6" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 3px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
							</div>
							<div style="position:relative;">
								<?=$tieude9['ten']?>&nbsp;
								<a href="index.php?com=about&act=capnhat&type=tieude9" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 3px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
							</div>
							<div style="position:relative;">
								<?=$tieude10['ten']?>&nbsp;
								<a href="index.php?com=about&act=capnhat&type=tieude10" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding: 3px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
							</div>
						</div>
						<div style="clear:both;"></div>
						
					</div>
					<div style="position:relative;">
						<?=$tieude7['ten']?>&nbsp;
						<a href="index.php?com=about&act=capnhat&type=tieude7" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding:  3px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
					</div>
					<div style="position:relative;">
						<?=$tieude8['ten']?>&nbsp;
						<a href="index.php?com=about&act=capnhat&type=tieude8" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding:  3px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
					</div>

					<div style="position:relative; margin-top: 10px;">
						<?=$tieude11['ten']?> <a href="javascript:void(0)" style="color: #0d0abd; text-decoration: underline;">hủy đăng ký</a>.

						<a href="index.php?com=about&act=capnhat&type=tieude11" class="icon_edit_mail" original-title="Edit" style="border: 1px solid #cdcdcd; padding:  3px; display: inline-block; position:absolute; top:0px; right:-30px; background:#f2f2f2;"><img src="./images/icons/dark/pencil.png" style="display:block;" alt=""></a>
					</div>

				 </div>
			 </div>
		 </div>
	 