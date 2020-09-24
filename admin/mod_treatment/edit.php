<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Show Page Header Panel
#-------------------------------------------------------------------
$Config_ShowButton=array("back");
include_once("../inc/inc_page_header.php");

include("add-cate.php");
include("add-sub.php");

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$SendRequest=array("act"=>MODULE_TABLE."_ListOne");
foreach ($_REQUEST as $key => $value) { $SendRequest[$key]=trim(urldecode($value)); }
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
$Row=$Result["Result"];

?>
<div class="content">
	<!-- Form ------------------------------------------------------- -->
	<form id="myBackForm" name="myBackForm" method="get" action="?">
		<input type="hidden" id="doaction" name="doaction" value="list" />
		<!-- Remember Current List State ---------------------------- -->
		<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
		<input type="hidden" id="inputShowStaffLevel" name="inputShowStaffLevel" value="<?php echo $_REQUEST["inputShowStaffLevel"]; ?>" />
		<input type="hidden" id="inputShowStaffGroup" name="inputShowStaffGroup" value="<?php echo $_REQUEST["inputShowStaffGroup"]; ?>" />
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
	</form>
	<form id="myForm" name="myForm" method="post" action="?" class="form-validate-jquery" enctype="multipart/form-data">
		<input type="hidden" id="doaction" name="doaction" value="update" />
		<input type="hidden" id="inputID"  name="inputID"  value="<?php echo $_REQUEST["inputID"]; ?>" />
		<!-- Remember Current List State ---------------------------- -->
		<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
		<input type="hidden" id="inputShowStaffLevel" name="inputShowStaffLevel" value="<?php echo $_REQUEST["inputShowStaffLevel"]; ?>" />
		<input type="hidden" id="inputShowStaffGroup" name="inputShowStaffGroup" value="<?php echo $_REQUEST["inputShowStaffGroup"]; ?>" />
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
		<h1>แก้ไข<?php echo MODULE_NAME; ?></h1>
		<div class="content" style=" max-width: 550px; margin:auto; ">
			<!-- ---------------------------------------------------------- -->
			<?php $box=1; ?>
			<div class="card">
				<div class="card-header <?php echo $System_ThemeClass; ?> header-elements-inline cursor" onclick=" System_ToggleBox(<?php echo $box; ?>); ">
					<h4 class="card-title">ข้อมูลที่จำเป็น</h4>
					<div class="header-elements"><div class="list-icons"><a class="list-icons-item" id="idBoxIcon<?php echo $box; ?>" data-action="collapse"></a></div></div>
				</div>
				<div class="card-body" id="idBoxBody<?php echo $box; ?>">
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อการรักษา : </label>
						<input id="inputName" name="inputName" type="text" class="form-control" value="<?php echo $Row["name"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
				</div>
			</div>
			<!-- ---------------------------------------------------------- -->
		</div>
		<div class="card card-body text-center d-flex justify-content-between align-items-center  <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?>">
			<table style=" width:100% "><tr>
			<td class="text-left"><button type="button" class="btn bg-transparent text-white" onclick=" doBack(); "> <i class="icon-backward2 mr-2"></i> ย้อนกลับ </button></td>
			<td class="text-right"><button type="submit" class="btn bg-success" style=" width:160px; "> บันทึก <i class="icon-checkmark4 ml-2"></i></button></td>
			</tr></table>
		</div>
	</form>
</div>
<script src="edit.js"></script>