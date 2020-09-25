<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Show Page Header Panel
#-------------------------------------------------------------------
$Config_ShowButton=array("");
include_once("../inc/inc_page_header.php");

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$SendRequest=array("act"=>MODULE_TABLE."_ListOne");
$SendRequest["inputID"]=MODULE_FIX_ID;
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
$Row=$Result["Result"];

?>
<div class="content">
	<!-- Form ------------------------------------------------------- -->
	<form id="myForm" name="myForm" method="post" action="http://kk.getdev.top/smartfarm/admin/mod_backup/backup.php" class="form-validate-jquery" enctype="multipart/form-data">
		<input type="hidden" id="doaction" name="doaction" value="backup" />
		<input type="hidden" id="inputUsername" name="inputUsername" value="<? echo SYSTEM_DB_USERNAME ; ?>" />
		<input type="hidden" id="inputPassword" name="inputPassword" value="<? echo SYSTEM_DB_PASSWORD ; ?>" />
		<input type="hidden" id="inputHostname" name="inputHostname" value="<? echo SYSTEM_DB_HOSTNAME ; ?>" />
		<input type="hidden" id="inputTable" name="inputTable" value="<? echo SYSTEM_DB_NAME ; ?>" />
		<!-- ---------------------------------------------------------- -->
		<div class="container">
			<div class="row">
				<div class="col-12 text-center"><h1>ระบบสำรองข้อมูล</h1></div>
			</div>
			<div class="row">
				<div class="col-12 text-center mt-5"><button type="submit" class="btn btn-danger rounded-round legitRipple">กดปุ่มสำรองข้อมูล</button></div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="../global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
<script src="edit.js"></script>