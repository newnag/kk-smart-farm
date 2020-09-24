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

include("add-select.php");

$dataL = $ResultA["ResultL"];
$dataR = $ResultA["ResultR"];
$dataT = $ResultA["ResultT"];

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
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อสัตว์ : </label>
						<select class="form-control select select2-hidden-accessible" id="inputname" name="inputname" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $Row["livestockID"] ?>"><?php echo $Row["name"] ?></option>
							<?php 
								for($i=0;$i<sizeof($dataL);$i++){
									$dataLive = $dataL[$i];
									echo '<option value="'.$dataLive["id"].'">'.$dataLive["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							วันที่คลอด/แท้ง ล่าสุด :
						</label>
						<input id="inputDateGive" name="inputDateGive" type="text" class="form-control" value="<?php echo $Row["giveBirth"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ประวัติการคลอด / แท้ง :
						</label>
						<input id="inputHistoryGive" name="inputHistoryGive" type="text" class="form-control" value="<?php echo $Row["giveBirthDetail"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รอบการให้นม :
						</label>
						<input id="inputBreastFeed" name="inputBreastFeed" type="number" class="form-control" value="<?php echo $Row["breastFeed"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							วันที่เป็นสัดครั้งแรก :
						</label>
						<input id="inputDateRut" name="inputDateRut" type="text" class="form-control" value="<?php echo $Row["dateRut"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							อาการ :
						</label>
						<input id="inputSymtom" name="inputSymtom" type="text" class="form-control" value="<?php echo $Row["symtom"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ลักษณะเมือก : </label>
						<select class="form-control select select2-hidden-accessible" id="inputRutChoice" name="inputRutChoice" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $Row["rut"]; ?>"><?php echo $Row["rut"]; ?></option>
							<?php 
								for($i=0;$i<sizeof($dataR);$i++){
									$dataL = $dataR[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ระบุลักษณะเมือก :
						</label>
						<input id="inputRutDetail" name="inputRutDetail" type="text" class="form-control" value="<?php echo $Row["rutDetail"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							อาการผิดปกติที่ตรวจพบ :
						</label>
						<input id="inputAbSymtom" name="inputAbSymtom" type="text" class="form-control" value="<?php echo $Row["abnormalSymtom"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">การรักษา : </label>
						<select class="form-control select select2-hidden-accessible" id="inputTreatment" name="inputTreatment" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $Row["treatment"]; ?>"><?php echo $Row["treatment"]; ?></option>
							<?php 
								for($i=0;$i<sizeof($dataT);$i++){
									$dataL = $dataT[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รายละเอียดการรักษา :
						</label>
						<input id="inputTreatmentDetail" name="inputTreatmentDetail" type="text" class="form-control" value="<?php echo $Row["treatmentDetail"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำแนะนำ : </label>
						<select class="form-control select select2-hidden-accessible" id="inputRecomment" name="inputRecomment" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $Row["recomment"]; ?>"><?php echo $Row["recomment"]; ?></option>
							<option value="ปกติ">ปกติ</option>
							<option value="ไม่ปกติ">ไม่ปกติ</option>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">สถานะสัตว์ : </label>
						<select class="form-control select select2-hidden-accessible" id="inputHistoryStatus" name="inputHistoryStatus" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $Row["historyStatus"]; ?>"><?php echo $Row["historyStatus"]; ?></option>
							<option value="ตรวจแล้ว">ตรวจแล้ว</option>
							<option value="ยังไม่ตรวจ">ยังไม่ตรวจ</option>
						</select>
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
<script>
	const selectSex = (that)=>{
			let choice = that.value
			document.querySelector('#inputSexSum').value = choice
	}
</script>