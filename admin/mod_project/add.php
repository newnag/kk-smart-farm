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
							ชื่อ :
						</label>
						<input id="inputName" name="inputName" type="text" class="form-control" required>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รายละเอียด :
						</label>
						<textarea id="inputDescription" name="inputDescription" class="form-control"  required><?php echo $Row["Description"]; ?></textarea>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ที่ตั้ง :
						</label>
						<input id="inputLocationName" name="inputLocationName" type="text" class="form-control" value="<?php echo $Row["LocationName"]; ?>" required>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ไฟล์ภาพหลัก :
						</label>
						<input id="inputPicture" name="inputPicture" type="file" class="form-control" required accept="image/x-png,image/gif,image/jpeg">
						<div style=" padding: 4px; text-align: right; ">
							กรุณาใช้ไฟล์ภาพ นามสกุล .jpg, .png ขนาด  <?php echo MODULE_FIX_WIDTH; ?>x<?php echo MODULE_FIX_HEIGHT; ?> pixel เท่านั้น &nbsp;
						</div>
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ไฟล์ภาพแผนที่ :
						</label>
						<input id="inputPictureMap" name="inputPictureMap" type="file" class="form-control" required accept="image/x-png,image/gif,image/jpeg">
						<div style=" padding: 4px; text-align: right; ">
							กรุณาใช้ไฟล์ภาพ นามสกุล .jpg, .png เท่านั้น &nbsp;
						</div>
					</div>
					<!-- ------------------------------------------------------- -->
					<?php if(0) { ?>
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							รายละเอียด :
						</label>
						<textarea name="inputHTML" id="inputHTML" rows="4" cols="4" style=" width: 100%; height: 400px; "></textarea>
					</div>
					<?php } ?>
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							สิ่งอำนวยความสะดวก :
						</label>
						<div style=" padding: 10px; ">
							<?php
							for($i=0;$i<sizeof($arFacilityKey);$i++) {
								?>
								<input type="checkbox" id="inputFacility<?php echo $arFacilityKey[$i]; ?>" name="inputFacility<?php echo $arFacilityKey[$i]; ?>" value="Yes" <?php if($Row["Facility".$arFacilityKey[$i]]=="Yes") { echo " checked "; } ?> />
								<label for="inputFacility<?php echo $arFacilityKey[$i]; ?>"> &nbsp; <?php echo $arFacilityName[$i]; ?> &nbsp;&nbsp; </label>
								<?php
							}
							?>
						</div>
					</div>
					<!-- ------------------------------------------------------- -->
				</div>
			</div>
			<!-- ---------------------------------------------------------- -->
			<?php $box++; ?>
			<div class="card">
				<div class="card-header <?php echo $System_ThemeClass; ?> header-elements-inline cursor" onclick=" System_ToggleBox(<?php echo $box; ?>); ">
					<h4 class="card-title">ข้อมูล ทรัพย์สิน </h4>
					<div class="header-elements"><div class="list-icons"><a class="list-icons-item" id="idBoxIcon<?php echo $box; ?>" data-action="collapse"></a></div></div>
				</div>
				<div class="card-body" id="idBoxBody<?php echo $box; ?>">
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							เปิดใช้ ประเภททรัพย์สิน :
						</label>
						<div style=" padding: 10px; ">
							<?php
							for($i=0;$i<sizeof($arAssetTypeKey);$i++) {
								?>
								<input type="checkbox" id="inputAssetType<?php echo $arAssetTypeKey[$i]; ?>" name="inputAssetType<?php echo $arAssetTypeKey[$i]; ?>" value="Yes" <?php if($Row["AssetType".$arAssetTypeKey[$i]]=="Yes") { echo " checked "; } ?> />
								<label for="inputAssetType<?php echo $arAssetTypeKey[$i]; ?>"><?php echo $arAssetTypeName[$i]; ?> &nbsp;&nbsp; </label>
								<?php
							}
							?>
						</div>
					</div>
					<!-- ------------------------------------------------------- -->
					<?php for($i=0;$i<sizeof($arAssetTypeKey);$i++) { ?>
					<div id="idShow<?php echo $arAssetTypeKey[$i]; ?>" class="form-group" style=" margin-top: 20px; display: none; ">
						<div class="form-group" style=" margin-top: 30px; ">
							<label class="mb-0 text-grey-800 font-weight-bold" style=" font-size: 24px; ">
								ข้อมูล <font color="#0000AA"><?php echo $arAssetTypeName[$i]; ?></font> :
							</label>
						</div>
						<div class="form-group" style=" margin-bottom:0; ">
							<div style=" padding: 10px; padding-left: 30px; ">
								<input type="text" id="input<?php echo $arAssetTypeKey[$i]; ?>_BedRoom" name="input<?php echo $arAssetTypeKey[$i]; ?>_BedRoom" value="<?php if($Row[$arAssetTypeKey[$i]."_BedRoom"]>0) { echo $Row[$arAssetTypeKey[$i]."_BedRoom"]; } else { echo "1"; } ?>" style=" width: 30px; text-align: center; " />
								<label> ห้องนอน &nbsp;&nbsp;&nbsp;&nbsp; </label>
								<input type="text" id="input<?php echo $arAssetTypeKey[$i]; ?>_BathRoom" name="input<?php echo $arAssetTypeKey[$i]; ?>_BathRoom" value="<?php if($Row[$arAssetTypeKey[$i]."_BathRoom"]>0) { echo $Row[$arAssetTypeKey[$i]."_BathRoom"]; } else { echo "1"; } ?>" style=" width: 30px; text-align: center; " />
								<label> ห้องน้ำ &nbsp;&nbsp;&nbsp;&nbsp; </label>
								<input type="text" id="input<?php echo $arAssetTypeKey[$i]; ?>_CarPark" name="input<?php echo $arAssetTypeKey[$i]; ?>_CarPark" value="<?php if($Row[$arAssetTypeKey[$i]."_CarPark"]>0) { echo $Row[$arAssetTypeKey[$i]."_CarPark"]; } else { echo "1"; } ?>" style=" width: 30px; text-align: center; "  />
								<label> ที่จอดรถ &nbsp;&nbsp;&nbsp;&nbsp; พื้นที่ใช้สอย </label>
								<input type="text" id="input<?php echo $arAssetTypeKey[$i]; ?>_LivingSpace" name="input<?php echo $arAssetTypeKey[$i]; ?>_LivingSpace" value="<?php if($Row[$arAssetTypeKey[$i]."_LivingSpace"]>0) { echo $Row[$arAssetTypeKey[$i]."_LivingSpace"]; } else { echo "1"; } ?>" style=" width: 60px; text-align: center; "  />
								<label> ตร.ม.  </label>
							</div>
						</div>
						<div class="form-group" style=" margin-bottom:0; ">
							<div style=" padding: 10px; padding-left: 30px; ">
								<table>
								<tr>
									<td style=" width: 160px; ">
										<b>ภาพทรัพย์สิน</b>
									</td>
									<td style=" padding-left: 20px; ">
										<input id="input<?php echo $arAssetTypeKey[$i]; ?>_AssetPicture" name="input<?php echo $arAssetTypeKey[$i]; ?>_AssetPicture" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" style=" width: 300px; ">
									</td>
									<td style=" padding-left: 20px; ">
										<div style=" padding: 3px; width: 50px; " class="bg-grey">
											<img class="img-fluid" src="<?php echo $Row[$arAssetTypeKey[$i]."_AssetPicture"]; ?>" >
										</div>
									</td>
								</tr>
								</table>
							</div>
						</div>
						<?php for($x=1;$x<=5;$x++) { ?>
						<div class="form-group" style=" margin-bottom:0; ">
							<div style=" padding: 10px; padding-left: 30px; ">
								<table>
								<tr>
									<td style=" width: 60px; ">
										<b>แปลน <?php echo $x; ?></b>
									</td>
									<td style=" padding-left: 20px; ">
										<input type="text" id="input<?php echo $arAssetTypeKey[$i]; ?>_Plan<?php echo $x; ?>Name" name="input<?php echo $arAssetTypeKey[$i]; ?>_Plan<?php echo $x; ?>Name" value="<?php if($Row[$arAssetTypeKey[$i]."_Plan".$x."Name"]<>"") { echo $Row[$arAssetTypeKey[$i]."_Plan".$x."Name"]; } ?>" style=" width: 80px; text-align: center; " />
									</td>
									<td style=" padding-left: 20px; ">
										<input id="input<?php echo $arAssetTypeKey[$i]; ?>_Plan<?php echo $x; ?>Picture" name="input<?php echo $arAssetTypeKey[$i]; ?>_Plan<?php echo $x; ?>Picture" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" style=" width: 300px; ">
									</td>
									<td style=" padding-left: 20px; ">
										<div style=" padding: 3px; width: 50px; " class="bg-grey">
											<img class="img-fluid" src="<?php echo $Row[$arAssetTypeKey[$i]."_Plan".$x."Picture"]; ?>" >
										</div>
									</td>
								</tr>
								</table>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
					<!-- ------------------------------------------------------- -->
				</div>
			</div>
			<!-- ---------------------------------------------------------- -->
			<?php $box++; ?>
			<div class="card">
				<div class="card-header <?php echo $System_ThemeClass; ?> header-elements-inline cursor" onclick=" System_ToggleBox(<?php echo $box; ?>); ">
					<h4 class="card-title">ข้อมูล Hero Banner </h4>
					<div class="header-elements"><div class="list-icons"><a class="list-icons-item" id="idBoxIcon<?php echo $box; ?>" data-action="collapse"></a></div></div>
				</div>
				<div class="card-body" id="idBoxBody<?php echo $box; ?>">
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							Hero Banner :
						</label>
						<div style=" padding: 10px;  padding-left: 30px; ">
							<?php for($x=1;$x<=3;$x++) { ?>
							<table>
							<tr>
								<td style=" width: 60px; ">
									<b>ภาพที่ <?php echo $x; ?></b>
								</td>
								<td style=" padding-left: 20px; ">
									<input id="inputHero<?php echo $x; ?>" name="inputHero<?php echo $x; ?>" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" style=" width: 400px; ">
								</td>
								<td style=" padding-left: 20px; ">
									<div style=" padding: 3px; width: 50px; " class="bg-grey">
										<img class="img-fluid" src="<?php echo $Row["Hero".$x]; ?>">
									</div>
								</td>
							</tr>
							</table>
							<?php } ?>
						</div>
					</div>
					<!-- ------------------------------------------------------- -->
				</div>
			</div>
			<!-- ---------------------------------------------------------- -->
			<?php $box++; ?>
			<div class="card">
				<div class="card-header <?php echo $System_ThemeClass; ?> header-elements-inline cursor" onclick=" System_ToggleBox(<?php echo $box; ?>); ">
					<h4 class="card-title">ข้อมูล แกลอรี่ </h4>
					<div class="header-elements"><div class="list-icons"><a class="list-icons-item" id="idBoxIcon<?php echo $box; ?>" data-action="collapse"></a></div></div>
				</div>
				<div class="card-body" id="idBoxBody<?php echo $box; ?>">
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							แกลอรี่ :
						</label>
						<div style=" padding: 10px;  padding-left: 30px; ">
							<?php for($x=1;$x<=16;$x++) { ?>
							<table>
							<tr>
								<td style=" width: 60px; ">
									<b>ภาพที่ <?php echo $x; ?></b>
								</td>
								<td style=" padding-left: 20px; ">
									<input id="inputGallery<?php echo $x; ?>" name="inputGallery<?php echo $x; ?>" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" style=" width: 400px; ">
								</td>
								<td style=" padding-left: 20px; ">
									<div style=" padding: 3px; width: 50px; " class="bg-grey">
										<img class="img-fluid" src="<?php echo $Row["Gallery".$x]; ?>" >
									</div>
								</td>
							</tr>
							</table>
							<?php } ?>
						</div>
					</div>
					<!-- ------------------------------------------------------- -->
				</div>
			</div>
			<!-- ---------------------------------------------------------- -->
			<?php $box++; ?>
			<div class="card">
				<div class="card-header <?php echo $System_ThemeClass; ?> header-elements-inline cursor" onclick=" System_ToggleBox(<?php echo $box; ?>); ">
					<h4 class="card-title">ข้อมูล สถานที่ใกล้เคียง </h4>
					<div class="header-elements"><div class="list-icons"><a class="list-icons-item" id="idBoxIcon<?php echo $box; ?>" data-action="collapse"></a></div></div>
				</div>
				<div class="card-body" id="idBoxBody<?php echo $box; ?>">
					<!-- ------------------------------------------------------- -->
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ภาพโลโก้ของโครงการ :
						</label>
						<div style=" padding: 10px; text-align: center; " class="bg-grey">
							<a href="<?php echo $Row["MapLogo"]; ?>" target="_blank">
							<img class="img-fluid" src="<?php echo $Row["MapLogo"]; ?>" ></a>
						</div>
						<input id="inputMapLogo" name="inputMapLogo" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg">
						<div style=" padding: 4px; text-align: right; ">
							กรุณาใช้ไฟล์ภาพ นามสกุล .jpg, .png ขนาดไม่เกิน 280x280 &nbsp;
						</div>
					</div>
					<!-- ------------------------------------------------------- -->				
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							ลิงค์ Google Map :
						</label>
						<input id="inputGoogleMapLink" name="inputGoogleMapLink" type="text" class="form-control" value="<?php echo $Row["GoogleMapLink"]; ?>">
					</div>
					<!-- ------------------------------------------------------- -->				
					<div class="form-group" style=" margin-top: 20px; ">
						<label class="mb-0 text-grey-800 font-weight-bold">
							สถานที่ใกล้เคียง :
						</label>
						<div style=" padding: 10px;  padding-left: 30px; ">
							<?php for($x=1;$x<=8;$x++) { ?>
							<table>
							<tr>
								<td style=" width: 60px; text-align: right; ">
									<b> <?php echo $x; ?>). </b>
								</td>
								<td style=" padding-right: 20px; ">
									<input id="inputLocation<?php echo $x; ?>Name" name="inputLocation<?php echo $x; ?>Name" type="text" class="form-control" style=" width: 300px; " value="<?php echo $Row["Location".$x."Name"]; ?>">
								</td>
								<td style=" width: 60px; text-align: right; ">
									เวลา
								</td>
								<td style=" padding-right: 20px; ">
									<input id="inputLocation<?php echo $x; ?>Min" name="inputLocation<?php echo $x; ?>Min" type="text" class="form-control" style=" width: 80px; text-align: center; " value="<?php echo $Row["Location".$x."Min"]; ?>">
								</td>
								<td style=" width: 40px; ">
									 นาที
								</td>
								<td style=" padding-left: 20px; "> &nbsp;% </td>
								<td style=" width: 70px; ">
									<select id="inputLocation<?php echo $x; ?>Percent" name="inputLocation<?php echo $x; ?>Percent" class="select2" style=" width: 70px; ">
									<?php for($y=0;$y<=100;$y++) { ?>
									<option value="<?php echo $y; ?>"  <?php if($Row["Location".$x."Percent"]==$y) { echo " selected "; } ?>><?php echo $y; ?></option>
									<?php } ?>
									</select>
								</td>
							</tr>
							</table>
							<?php } ?>
						</div>
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
<script>
function doShowAssetType() {
	<?php for($i=0;$i<sizeof($arAssetTypeKey);$i++) { ?>
	if($('#inputAssetType<?php echo $arAssetTypeKey[$i]; ?>').is(':checked')) {
		$('#idShow<?php echo $arAssetTypeKey[$i]; ?>').show();
	} else {
		$('#idShow<?php echo $arAssetTypeKey[$i]; ?>').hide();
	}
	<?php } ?>
}
<?php for($i=0;$i<sizeof($arAssetTypeKey);$i++) { ?>
$('#inputAssetType<?php echo $arAssetTypeKey[$i]; ?>').change(function() { doShowAssetType(); } );
<?php } ?>
$(".select2").select2();
</script>