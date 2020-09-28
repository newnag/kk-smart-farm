<?php
#-------------------------------------------------------------------
# Config
#-------------------------------------------------------------------
include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("../inc/inc_head.php"); ?>
</head>

<body class="<?php echo $System_BodyClass; ?>">
<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Password recovery form -->
				<form class="login-form" action="<?php echo SYSTEM_FULLPATH_API; ?>Forget_Pass_Admin.php">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">ลืมรหัสผ่าน</h5>
								<span class="d-block text-muted">กรอกอีเมล์ของท่าน</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-right">
								<input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="อีเมล์">
								<div class="form-control-feedback">
									<i class="icon-mail5 text-muted"></i>
								</div>
							</div>

							<button type="submit" class="btn bg-blue btn-block legitRipple"><i class="icon-spinner11 mr-2"></i> Reset password</button>
						</div>
					</div>
				</form>
				<!-- /password recovery form -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>

</body>
</html>