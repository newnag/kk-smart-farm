<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Create SendRequest Data and Create PageKey
#-------------------------------------------------------------------
$SendRequest=array("act"=>"Mod_Farm"."_List");
foreach ($_REQUEST as $key => $value) { $SendRequest[$key]=trim(urldecode($value)); }
$Config_PageKey=http_build_query($SendRequest);

// print_r($SendRequest);
// exit();

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);

// print_r($Result["Result"]);
// exit();

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
		<input type="hidden" id="inputShowStaffLevel" name="inputShowStaffLevel" value="<?php echo $_REQUEST["inputShowStaffLevel"]; ?>" />
		<input type="hidden" id="inputShowStaffGroup" name="inputShowStaffGroup" value="<?php echo $_REQUEST["inputShowStaffGroup"]; ?>" />
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
	</form>
	<form id="myForm" name="myForm" method="post" action="?" class="form-validate-jquery" enctype="multipart/form-data">
		<input type="hidden" id="doaction" name="doaction" value="insert" />
		<!-- Remember Current List State ---------------------------- -->
		<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
		<input type="hidden" id="inputShowStaffLevel" name="inputShowStaffLevel" value="<?php echo $_REQUEST["inputShowStaffLevel"]; ?>" />
		<input type="hidden" id="inputShowStaffGroup" name="inputShowStaffGroup" value="<?php echo $_REQUEST["inputShowStaffGroup"]; ?>" />
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
		<h1>เพิ่ม<?php echo MODULE_NAME; ?></h1>
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
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อปศุสัตว์ : </label>
						<input id="inputName" name="inputName" type="text" class="form-control">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อฟาร์ม : </label>
						<select class="form-control select select2-hidden-accessible" id="inputNameFarm" name="inputNameFarm" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">เลือกฟาร์ม</option>
							<?php 
								$arrData = $Result["Result"];
								for($i=0;$i<sizeof($arrData);$i++){
									$Row = $arrData[$i];
									echo '<option value="'.$Row["id"].'">'.$Row["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ประเภท : </label>
						<select class="form-control select select2-hidden-accessible" id="inputType" name="inputType" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">เลือกประเภท</option>
							<option value="โค">โค</option>
							<option value="วัว">วัว</option>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">รหัสไมโครชิพประจำตัวสัตว์ :</label>
						<input id="inputMicrochip" name="inputMicrochip" type="text" class="form-control">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">สายพันธุ์ : </label>
						<select class="form-control select select2-hidden-accessible" id="inputGene" name="inputGene" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">เลือกสายพันธุ์</option>
							
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">วันเดือนปีเกิด : </label>
						<input id="inputDOB" name="inputDOB" type="date" class="form-control">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">อายุ : </label>
						<input id="inputAge" name="inputAge" type="text" class="form-control" placeholder="เช่น 1ปี 4เดือน 5วัน">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">เพศ : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSex" name="inputSex" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">เลือกเพศ</option>
							<option value="เพศผู้">เพศผู้</option>
							<option value="เพศเมีย">เพศเมีย</option>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">น้ำหนัก : </label>
						<input id="inputWeight" name="inputWeight" type="number" class="form-control">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">สถานะสัตว์ : </label>
						<select class="form-control select select2-hidden-accessible" id="inputHealthStatus" name="inputHealthStatus" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">เลือกสถานะ</option>
							<option value="ปกติ">ปกติ</option>
							<option value="ป่วย">ป่วย</option>
							<option value="ตาย">ตาย</option>
							<option value="หาย">หาย</option>
						</select>
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
					<div class="form-group">
						<?php
						####################################################################
						$Config_Key="Picture"; // ใช้ input + ชื่อฟิลด์ เป็นมาตรฐาน
						$Config_Label="ภาพแทนตัว";
						$Config_OldFile=array();
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
		<div class="card card-body text-center d-flex justify-content-between align-items-center <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?>">
			<table style=" width:100% "><tr>
			<td class="text-left"><button type="button" class="btn bg-transparent text-white" onclick=" doBack(); "> <i class="icon-backward2 mr-2"></i> ย้อนกลับ </button></td>
			<td class="text-right"><button type="submit" class="btn bg-success" style=" width:160px; "> เพิ่ม<?php echo MODULE_NAME; ?> <i class="icon-plus-circle2 ml-2"></i></button></td>
			</tr></table>
		</div>
	</form>
</div>
<script src="add.js"></script>