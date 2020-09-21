<?php
//-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
//-------------------------------------------------------------------
?>
<div class="content-wrapper">
    <div class="content d-flex justify-content-center align-items-center">
        <form class="login-form form-validate" method="post" target="_top" action="?">
            <input type="hidden" name="act" value="SignIn" />
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="icon-lock icon-2x text-primary-400 border-primary-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">หน้าจัดการระบบ</h5>
                        <span class="d-block text-muted">เฉพาะผู้ดูแลระบบเท่านั้น</span>
                        <?php if($Result["Status"]=="Error") { ?>
                            <h5 class="mb-0" style=" color: #FF0000; "><br><?php echo $Result["Message"]; ?></h5>
                        <?php } ?>
                    </div>
                    <div class="form-group form-group-feedback form-group-feedback-left" style=" height: 66px; overflow: hidden; ">
                        <input type="text" class="form-control" name="inputUser" id="inputUser" placeholder="Username" value="<?php echo $_POST["inputUser"]; ?>" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>
                    <div class="form-group form-group-feedback form-group-feedback-left" style=" height: 66px; overflow: hidden; ">
                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" >
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <a href="forgot.php" class="ml-auto">ลืมรหัสผ่าน?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-labeled btn-labeled-right btn-lg legitRipple"> เข้าสู่ระบบ&nbsp;&nbsp;&nbsp; <b><i class="icon-key"></i></b>  </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>