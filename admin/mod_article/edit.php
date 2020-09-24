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

#-------------------------------------------------------------------
# PreLoadInput
#-------------------------------------------------------------------
if($_REQUEST["inputType"]=="") { $_REQUEST["inputType"]="News"; }

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
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
		<h1>แก้ไข <?php echo MODULE_NAME; ?></h1>
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
							ชื่อ :
						</label>
						<input id="inputName" name="inputName" type="text" class="form-control" value="<?php echo $Row["Name"]; ?>" required>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ไฟล์ภาพ ( ใช้ภาพเดิม ให้เว้นว่างไว้ ) :
						</label>
						<div style=" padding: 10px; text-align: center; " class="bg-grey">
							<a href="<?php echo $Row["Picture"]; ?>" target="_blank">
								<img class="img-fluid" src="<?php echo $Row["Picture-Thumb"]; ?>" >
							</a>
						</div>
						<input id="inputPicture" name="inputPicture" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg">
						<div style=" padding: 4px; text-align: right; ">
							กรุณาใช้ไฟล์ภาพ นามสกุล .jpg, .png ขนาด  <?php echo MODULE_FIX_WIDTH; ?>x<?php echo MODULE_FIX_HEIGHT; ?> pixel เท่านั้น &nbsp;
						</div>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รายละเอียด :
						</label>
						<textarea name="inputHTML" id="inputHTML" rows="4" cols="4" style=" width: 100%; height: 400px; "><?php echo $Row["HTML"]; ?></textarea>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							แหล่งข่าว :
						</label>
						<input id="inputSource" name="inputSource" type="text" class="form-control" value="<?php echo $Row["source"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label>ประเภทบทความ</label>
						<select class="form-control select select2-hidden-accessible" id="inputType" name="inputType" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $Row["Type"]; ?>"><?php echo $Row["Type"]; ?></option>
							<option value="News">ข่าวประชาสัมพันธ์</option>
							<option value="BodyCondition">เกณฑ์วัดความสมบูรณ์</option>
							<option value="Nutrition">โปรแกรมโภชนาการ</option>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="d-block text-grey-800 font-weight-bold mb-1">สถานะ :</label> 
						<div class="form-check form-check-inline mr-4"></div>
						<div class="form-check form-check-inline mr-4">
							<label class="form-check-label text-success" style=" line-height: 25px; ">
								<div class="uniform-choice border-success text-success">
									<span class="checked" style=" border-color: transparent!important; ">
									<input type="radio" class="form-input-styled" name="inputStatus" checked data-fouc="" <?php if($Row["Status"]=="Enable") { echo " checked "; } ?> value="Enable" >
									</span>
								</div>
								เปิดใช้งาน
							</label>
						</div>
						<div class="form-check form-check-inline mr-4">
							<label class="form-check-label text-warning" style=" line-height: 25px; ">
								<div class="uniform-choice border-warning text-warning">
									<span class="" style=" border-color: transparent!important; ">
									<input type="radio" class="form-input-styled" name="inputStatus" data-fouc=""  <?php if($Row["Status"]=="Disable") { echo " checked "; } ?> value="Disable" >
									</span>
								</div>
								ปิดใช้งาน
							</label>
						</div>
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
<script type="text/javascript" src="../global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
<script src="edit.js"></script>