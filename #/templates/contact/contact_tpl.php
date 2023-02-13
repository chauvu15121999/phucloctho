<div class="title-main"><span><?=$title_crumb?></span></div>
<div class="content-main">
    <div class="contact-article row">
        <div class="contact-text col-lg-6"><?=htmlspecialchars_decode($lienhe['noidung'.$lang])?></div>
        <form class="contact-form validation-contact col-lg-6" novalidate method="post" action="" enctype="multipart/form-data">
            <div class="form-row">
                <div class="contact-input col-sm-6">
                    <input type="text" class="form-control" id="ten-contact" name="dataContact[ten]" placeholder="<?=hoten?>" required />
                    <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
                </div>
                <div class="contact-input col-sm-6">
                    <input type="number" class="form-control" id="dienthoai-contact" name="dataContact[dienthoai]" placeholder="<?=sodienthoai?>" required />
                    <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
                </div>         
            </div>
            <div class="form-row">
                <div class="contact-input col-sm-6">
                    <input type="text" class="form-control" id="diachi-contact" name="dataContact[diachi]" placeholder="<?=diachi?>" required />
                    <div class="invalid-feedback"><?=vuilongnhapdiachi?></div>
                </div>
                <div class="contact-input col-sm-6">
                    <input type="email" class="form-control" id="email-contact" name="dataContact[email]" placeholder="Email" required />
                    <div class="invalid-feedback"><?=vuilongnhapdiachiemail?></div>
                </div>
            </div>
            <div class="contact-input">
                <input type="text" class="form-control" id="tieude-contact" name="dataContact[tieude]" placeholder="<?=chude?>" required />
                <div class="invalid-feedback"><?=vuilongnhapchude?></div>
            </div>
            <div class="contact-input">
                <textarea class="form-control" id="noidung-contact" name="dataContact[noidung]" placeholder="<?=noidung?>" required /></textarea>
                <div class="invalid-feedback"><?=vuilongnhapnoidung?></div>
            </div>
            <div class="contact-input">
                <input type="file" class="custom-file-input" name="file">
                <label class="custom-file-label" for="file" title="<?=chon?>"><?=dinhkemtaptin?></label>
            </div>
            <input type="submit" class="btn btn-primary" name="submit-contact" value="<?=gui?>" disabled />
            <input type="reset" class="btn btn-secondary" value="<?=nhaplai?>" />
            <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
        </form>
    </div>
    <div class="contact-map"><?=htmlspecialchars_decode($optsetting['toado_iframe'])?></div>
</div>