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

$dataCate = $ResultA["ResultCate"];
$dataSub = $ResultA["ResultSub"];
$dataChoice = $ResultA["ResultChoice"];
$dataLivestock = $ResultA["ResultLivestock"];

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
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อสัตว์ : </label>
						<select class="form-control select select2-hidden-accessible" id="inputname" name="inputname" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">เลือกชื่อสัตว์</option>
							<?php 
								for($i=0;$i<sizeof($dataLivestock);$i++){
									$dataL = $dataLivestock[$i];
									echo '<option value="'.$dataL["id"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ที่ 1 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputCate1" name="inputCate1" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่</option>
							<?php 
								for($i=0;$i<sizeof($dataCate);$i++){
									$dataL = $dataCate[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ย่อยที่ 1-1 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSub1-1" name="inputSub1-1" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่ย่อย</option>
							<?php 
								for($i=0;$i<sizeof($dataSub);$i++){
									$dataL = $dataSub[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำตอบที่ 1-1 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputchoice1-1" name="inputchoice1-1" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">คำตอบ</option>
							<?php 
								for($i=0;$i<sizeof($dataChoice);$i++){
									$dataL = $dataChoice[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ย่อยที่ 1-2 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSub1-2" name="inputSub1-2" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่ย่อย</option>
							<?php 
								for($i=0;$i<sizeof($dataSub);$i++){
									$dataL = $dataSub[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำตอบที่ 1-2 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputchoice1-2" name="inputchoice1-2" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">คำตอบ</option>
							<?php 
								for($i=0;$i<sizeof($dataChoice);$i++){
									$dataL = $dataChoice[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ย่อยที่ 1-3 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSub1-3" name="inputSub1-3" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่ย่อย</option>
							<?php 
								for($i=0;$i<sizeof($dataSub);$i++){
									$dataL = $dataSub[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำตอบที่ 1-3 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputchoice1-3" name="inputchoice1-3" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">คำตอบ</option>
							<?php 
								for($i=0;$i<sizeof($dataChoice);$i++){
									$dataL = $dataChoice[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ย่อยที่ 1-4 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSub1-4" name="inputSub1-4" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่ย่อย</option>
							<?php 
								for($i=0;$i<sizeof($dataSub);$i++){
									$dataL = $dataSub[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำตอบที่ 1-4 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputchoice1-4" name="inputchoice1-4" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">คำตอบ</option>
							<?php 
								for($i=0;$i<sizeof($dataChoice);$i++){
									$dataL = $dataChoice[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ที่ 2 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputCate2" name="inputCate2" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่</option>
							<?php 
								for($i=0;$i<sizeof($dataCate);$i++){
									$dataL = $dataCate[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ย่อยที่ 2 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSub2" name="inputSub2" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่ย่อย</option>
							<?php 
								for($i=0;$i<sizeof($dataSub);$i++){
									$dataL = $dataSub[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำตอบที่ 2 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputchoice2" name="inputchoice2" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">คำตอบ</option>
							<?php 
								for($i=0;$i<sizeof($dataChoice);$i++){
									$dataL = $dataChoice[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ที่ 3 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputCate3" name="inputCate3" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่</option>
							<?php 
								for($i=0;$i<sizeof($dataCate);$i++){
									$dataL = $dataCate[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ย่อยที่ 3 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSub3" name="inputSub3" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่ย่อย</option>
							<?php 
								for($i=0;$i<sizeof($dataSub);$i++){
									$dataL = $dataSub[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำตอบที่ 3 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputchoice3" name="inputchoice3" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">คำตอบ</option>
							<?php 
								for($i=0;$i<sizeof($dataChoice);$i++){
									$dataL = $dataChoice[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ที่ 4 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputCate4" name="inputCate4" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่</option>
							<?php 
								for($i=0;$i<sizeof($dataCate);$i++){
									$dataL = $dataCate[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ย่อยที่ 4 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSub4" name="inputSub4" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่ย่อย</option>
							<?php 
								for($i=0;$i<sizeof($dataSub);$i++){
									$dataL = $dataSub[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำตอบที่ 4 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputchoice4" name="inputchoice4" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">คำตอบ</option>
							<?php 
								for($i=0;$i<sizeof($dataChoice);$i++){
									$dataL = $dataChoice[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ที่ 5 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputCate5" name="inputCate5" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่</option>
							<?php 
								for($i=0;$i<sizeof($dataCate);$i++){
									$dataL = $dataCate[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">ชื่อหมวดหมู่ย่อยที่ 5 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputSub5" name="inputSub5" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ชื่อหมวดหมู่ย่อย</option>
							<?php 
								for($i=0;$i<sizeof($dataSub);$i++){
									$dataL = $dataSub[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">คำตอบที่ 5 : </label>
						<select class="form-control select select2-hidden-accessible" id="inputchoice5" name="inputchoice5" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">คำตอบ</option>
							<?php 
								for($i=0;$i<sizeof($dataChoice);$i++){
									$dataL = $dataChoice[$i];
									echo '<option value="'.$dataL["name"].'">'.$dataL["name"].'</option>';
								}
							?>
						</select>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group">
						<label class="mb-0 text-grey-800 font-weight-bold">สถานะสัตว์ : </label>
						<select class="form-control select select2-hidden-accessible" id="inputHistoryStatus" name="inputHistoryStatus" data-fouc="" tabindex="-1" aria-hidden="true">
							<option value="">ใส่สถานะสัตว์</option>
							<option value="ตรวจแล้ว">ตรวจแล้ว</option>
							<option value="ยังไม่ตรวจ">ยังไม่ตรวจ</option>
						</select>
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
<script>
	const selectSex = (that)=>{
			let choice = that.value
			document.querySelector('#inputSexSum').value = choice
	}
</script>