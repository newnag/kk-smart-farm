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
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							User :
						</label>
						<div style=" padding: 4px; padding-left: 10px; " class=" text-success font-weight-bold ">
							<?php echo $Row["User"]; ?>
							<input type="hidden" id="inputUser" name="inputUser" value="<?php echo $Row["User"]; ?>" />
						</div>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">แก้ไขรหัสผ่าน :</label>
						<input id="inputPass" name="inputPass" type="password" class="form-control" onblur=" doShowPassConfirm(this); ">
						<div style=" padding: 4px; "><span class=" text-warning font-size-xs"> ให้เว้นว่างไว้ หากไม่ต้องการแก้ไขรหัสผ่านเดิม </span></div>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" id="idPassConfirm" style=" display: none; ">
						<label class="mb-0 text-grey-800 font-weight-bold">ยืนยันรหัสผ่าน :</label>
						<input id="inputPassConfirm" name="inputPassConfirm" type="password" class="form-control">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">E-mail : </label>
						<input id="inputEmail" name="inputEmail" type="text" class="form-control" required value="<?php echo $Row["Email"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="d-block text-grey-800 font-weight-bold mb-1">กำหนดสิทธิ์ :</label> 
						<div class="form-check form-check-inline mr-4"></div>
						<div class="form-check form-check-inline mr-4">
							<label class="form-check-label" style=" line-height: 25px; ">
								<div class="uniform-choice">
									<span class="checked" style=" border-color: transparent!important; ">
									<input type="radio" class="form-input-styled" name="inputLevel" data-fouc="" <?php if($Row["Level"]=="Administrator") { echo " checked "; } ?> value="Administrator" >
									</span>
								</div>
								Administrator
							</label>
						</div>
						<div class="form-check form-check-inline mr-4">
							<label class="form-check-label" style=" line-height: 25px; ">
								<div class="uniform-choice">
									<span class="" style=" border-color: transparent!important; ">
									<input type="radio" class="form-input-styled" name="inputLevel" data-fouc="" <?php if($Row["Level"]=="Staff") { echo " checked "; } ?> value="Staff" >
									</span>
								</div>
								Staff
							</label>
						</div>
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
			<?php $box++; ?>
			<div class="card <?php echo CONFIG_DEFAULT_DESIGN_CLASS2; ?>">
				<div class="card-header <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?> header-elements-inline cursor" onclick=" System_ToggleBox(<?php echo $box; ?>); ">
					<h4 class="card-title">อื่นๆ</h4>
					<div class="header-elements"><div class="list-icons"><a class="list-icons-item rotate-180" id="idBoxIcon<?php echo $box; ?>" data-action="collapse"></a></div></div>
				</div>
				<div class="card-body" id="idBoxBody<?php echo $box; ?>" style=" display: none; ">
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 10px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">เบอร์โทรศัพท์: </label>
						<input id="inputPhone" name="inputPhone" type="text" class="form-control text-white" value="<?php echo $Row["Phone"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<?php
						####################################################################
						$Config_Key="Picture"; // ใช้ input + ชื่อฟิลด์ เป็นมาตรฐาน
						$Config_Label="ภาพแทนตัว";
						$Config_OldFile=$Row["Picture"];
						$Config_Width=500;
						$Config_Height=500;
						####################################################################
						include("../tool_cropper/inc_input_fileupload_basic.php");
						####################################################################
						?>
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