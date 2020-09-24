<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$SendRequest=array("act"=>MODULE_TABLE."_ListOne");
foreach ($_REQUEST as $key => $value) { $SendRequest[$key]=trim(urldecode($value)); }
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
$Row=$Result["Result"];

#-------------------------------------------------------------------
# Show Page Header Panel
#-------------------------------------------------------------------
$Config_ShowButton=array("back");
include_once("../inc/inc_page_header.php");

?>
<div class="content">
	<!-- Form ------------------------------------------------------- -->
	<form id="myBackForm" name="myBackForm" method="get" action="?">
		<input type="hidden" id="doaction" name="doaction" value="list" />
		<!-- Remember Current List State ---------------------------- -->
		<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
	</form>
	<form id="myForm" name="myForm" method="post" action="?" class="form-validate-jquery" enctype="multipart/form-data">
		<input type="hidden" id="doaction" name="doaction" value="delete" />
		<input type="hidden" id="inputID"  name="inputID"  value="<?php echo $Row["id"]; ?>" />
		<input type="hidden" id="inputName" name="inputName" value="<?php echo $Row["name"]; ?>" />
		<!-- Remember Current List State ---------------------------- -->
		<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
		<h1>คุณต้องการลบ <span class="text-warning"><?php echo $Row["Name"]; ?></span> แน่ใจหรือไม่? </h1>
		<div class="content" style=" max-width: 500px; margin:auto; ">
			<?php
			#------------------------------
			$Config_ViewOnly=true;
			include("list-delete.php");
			#------------------------------
			?>
		</div>
		<div class="card card-body text-center d-flex justify-content-between align-items-center bg-grey-800 text-white">
			<table style=" width:100% "><tr>
			<td class="text-left"><button type="button" class="btn bg-transparent text-white" onclick=" doBack(); "> <i class="icon-backward2 mr-2"></i> ย้อนกลับ </button></td>
			<td class="text-right"><button type="submit" class="btn bg-danger" style=" width:160px; "> ตกลง​ ลบเลย <i class="icon-bin ml-2"></i></button></td>
			</tr></table>
		</div>
	</form>
</div>
<script>
//----------------------------------------
function doBack() {
//----------------------------------------
	$('#myBackForm').submit();
}
</script>