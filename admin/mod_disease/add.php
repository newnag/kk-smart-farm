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
		<input type="hidden" id="doaction" name="doaction" value="insert" />
		<!-- Remember Current List State ---------------------------- -->
		<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
		<h1>เพิ่ม <?php echo MODULE_NAME; ?></h1>
		<div class="content" style=" max-width: 900px; margin:auto; ">
			<!-- ---------------------------------------------------------- -->
			<?php $box=1; ?>
			<div class="card">
				<div class="card-header <?php echo $System_ThemeClass; ?> header-elements-inline cursor" onclick=" System_ToggleBox(<?php echo $box; ?>); ">
					<h4 class="card-title">ข้อมูล <?php echo MODULE_NAME; ?></h4>
					<div class="header-elements"><div class="list-icons"><a class="list-icons-item" id="idBoxIcon<?php echo $box; ?>" data-action="collapse"></a></div></div>
				</div>
				<div class="card-body" id="idBoxBody<?php echo $box; ?>">
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ชื่อโรค :
						</label>
						<input id="inputName" name="inputName" type="text" class="form-control" required>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ชื่อหัวข้อที่ 1 :
						</label>
						<input id="inputTitle1" name="inputTitle1" type="text" class="form-control" required>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รายละเอียดที่ 1 :
						</label>
						<textarea name="inputHTML1" id="inputHTML1" class="inputHTML" rows="4" cols="4" style=" width: 100%; height: 400px; "></textarea>
						
					</div>
					<!-- ------------------------------------------------------- -->
					<hr>
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ชื่อหัวข้อที่ 2 :
						</label>
						<input id="inputTitle2" name="inputTitle2" type="text" class="form-control" required>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รายละเอียดที่ 2 :
						</label>
						<textarea name="inputHTML2" id="inputHTML2" class="inputHTML" rows="4" cols="4" style=" width: 100%; height: 400px; "></textarea>
					</div>
					<!-- ------------------------------------------------------- -->
					<hr>
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ชื่อหัวข้อที่ 3 :
						</label>
						<input id="inputTitle3" name="inputTitle3" type="text" class="form-control" required>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รายละเอียดที่ 3 :
						</label>
						<textarea name="inputHTML3" id="inputHTML3" class="inputHTML" rows="4" cols="4" style=" width: 100%; height: 400px; "></textarea>
					</div>
					<!-- ------------------------------------------------------- -->
					<hr>
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ชื่อหัวข้อที่ 4 :
						</label>
						<input id="inputTitle4" name="inputTitle4" type="text" class="form-control" required>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รายละเอียดที่ 4 :
						</label>
						<textarea name="inputHTML4" id="inputHTML4" class="inputHTML" rows="4" cols="4" style=" width: 100%; height: 400px; "></textarea>
					</div>
					<!-- ------------------------------------------------------- -->
				</div>
			</div>
			<!-- ---------------------------------------------------------- -->
		</div>
		<div class="card card-body text-center d-flex justify-content-between align-items-center <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?>">
			<table style=" width:100% "><tr>
			<td class="text-left"><button type="button" class="btn bg-transparent text-white" onclick=" doBack(); "> <i class="icon-backward2 mr-2"></i> ย้อนกลับ </button></td>
			<td class="text-right"><button type="submit" class="btn bg-success" style=" width:200px; "> เพิ่ม <?php echo MODULE_NAME; ?> <i class="icon-plus-circle2 ml-2"></i></button></td>
			</tr></table>
		</div>
	</form>
</div>
<script type="text/javascript" src="../global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
<script src="add.js"></script>