<div class="login-wrap">
<div class="wrap-user">
    <div class="title-user d-flex align-items-end justify-content-between">
        <span><?=dangnhap?></span>
        <a href="account/forgot" title="<?=quenmatkhau?>"><?=quenmatkhau?></a>
    </div>
    <form class="form-user validation-user"  method="post" enctype="multipart/form-data">
        <div class="input-group input-user mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input type="text" class="form-control" id="username" name="username" placeholder="<?=taikhoan?>" required>
            <div class="invalid-feedback"><?=vuilongnhaptaikhoan?></div>
        </div>
        <div class="input-group input-user mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock"></i></div>
            </div>
            <input type="password" class="form-control" id="password" name="password" placeholder="<?=matkhau?>" required>
            <div class="invalid-feedback"><?=vuilongnhapmatkhau?></div>
        </div>
        <div class="button-user d-flex align-items-center justify-content-between">
            <input type="submit" class="btn btn-dark" name="dangnhap" value="<?=dangnhap?>" >
            <div class="checkbox-user custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember-user" id="remember-user" value="1">
                <label class="custom-control-label" for="remember-user"><?=nhomatkhau?></label>
            </div>
        </div>
        <div class="note-user mt-2">
            <span><?=banchuacotaikhoan?> ! </span>
            <a href="account/register" title="<?=dangkytaiday?>"><?=dangkytaiday?></a>
        </div>
    </form>
</div>
</div>