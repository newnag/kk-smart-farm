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

?>
<link rel="stylesheet" href="chatbox.css">

<?php

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
		<!-- <input type="hidden" id="inputID"  name="inputIDs"  value="<?php echo $_REQUEST["inputID"]; ?>" /> -->
		<input type="hidden" id="inputID"  name="inputID"  value="<?php echo $_REQUEST["inputID"]; ?>" />
		<input type="hidden" id="myID"  name="myID"  value="<?php echo $_REQUEST["myID"]; ?>" />
		<!-- Remember Current List State ---------------------------- -->
		<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
		<input type="hidden" id="inputShowStaffLevel" name="inputShowStaffLevel" value="<?php echo $_REQUEST["inputShowStaffLevel"]; ?>" />
		<input type="hidden" id="inputShowStaffGroup" name="inputShowStaffGroup" value="<?php echo $_REQUEST["inputShowStaffGroup"]; ?>" />
		<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
		<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
		<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
		<!-- ---------------------------------------------------------- -->
		<div class="content" style=" ">
			<!-- ---------------------------------------------------------- -->
			<?php $box=1; ?>
			<div class="card">
				<div class="card-header" style="display:flex; align-items:center;">
					<img src="<?php echo $Row[0]["picture"]; ?>" class="img-fluid rounded-circle shadow-1" width="40" height="40" alt="newnag">
					<h4 class="card-title ml-1">
						<?php echo $Row[0]["username"]; ?>
					</h4>
				</div>
				<div class="card-body" id="idBoxBody<?php echo $box; ?>">
					<!-- ------------------------------------------------------- -->
					<!-- <div class="chatbox">
						<div class="line left-side">
							<img src="http://kk.getdev.top/smartfarm/upload/system_staff/20200921155936-picture.jpg" class="img-fluid rounded-circle shadow-1" width="40" height="50" alt="newnag">
							<div class="boxtext">
								<p>TestTestTestTestTestTestTestTestTestTestTestTestTest</p>
							</div>
							<div class="time">02:25 น.</div>
						</div>
						<div class="line left-side">
							<img src="http://kk.getdev.top/smartfarm/upload/system_staff/20200921155936-picture.jpg" class="img-fluid rounded-circle shadow-1" width="40" height="50" alt="newnag">
							<div class="boxtext">
								<p><img src="http://kk.getdev.top/smartfarm/upload/system_staff/20200921155936-picture.jpg" class="img-fluid shadow-1"></p>
							</div>
							<div class="time">02:25 น.</div>
						</div>
						<div class="line left-side">
							<img src="http://kk.getdev.top/smartfarm/upload/system_staff/20200921155936-picture.jpg" class="img-fluid rounded-circle shadow-1" width="40" height="50" alt="newnag">
							<div class="boxtext">
								<p>TestTestTestTestTestTestTestTestTestTestTestTestTest</p>
							</div>
							<div class="time">02:25 น.</div>
						</div>
						<div class="line right-side">
							<div class="boxtext">
								<p>TestTestTestTestTestTestTestTestTestTestTestTestTest</p>
							</div>
							<div class="time">02:25 น.</div>
						</div>
					</div> -->

					<div class="chatbox">
						<?php 
						for($i=0;$i<sizeof($Row);$i++){
							$Rows = $Row[$i];

							if($Rows["status"] == "user"){
								echo '<div class="line left-side">
												<img src="'.$Rows["picture"].'" class="img-fluid rounded-circle shadow-1" width="40" height="50">
												<div class="boxtext">
													<p>'.$Rows["text"].'</p>
												</div>
												<div class="time">'.$Rows["date"].' น.</div>
											</div>';
							}
							elseif($Rows["status"] == "admin"){
								echo '<div class="line right-side">
												<div class="boxtext">
													<p>'.$Rows["text"].'</p>
												</div>
												<div class="time">'.$Rows["date"].' น.</div>
											</div>';
							}
						}
							
						?>
					</div>
					<!-- ------------------------------------------------------- -->	
					<!-- <div class="form-group py-2 pl-3 bg-dark">
						<i class="icon-images2 cursor upPic" onclick="uppic()"></i>
						<input type="file" id="inputPicture" name="inputPicture" onchange="upPicNow(event)" style="display:none;">
					</div> -->
					<!-- ------------------------------------------------------- -->	
					<div class="form-group mt-3">
						<input id="inputText" name="inputText" type="text" class="form-control" placeholder="พิมพ์ข้อความที่นี่" onkeypress="doAdminSend(event)">
					</div>
					<!-- ------------------------------------------------------- -->
					<div class="form-group py-5 pl-3 bg-dark">
						<?php
						####################################################################
						$Config_Key="Picture"; // ใช้ input + ชื่อฟิลด์ เป็นมาตรฐาน
						$Config_Label="";
						$Config_OldFile=array();
						$Config_Width=500;
						$Config_Height=500;
						####################################################################
						include("../tool_cropper/inc_input_fileupload_basic.php");
						####################################################################
						?>
					</div>
				</div>
		</div>
			<!-- ---------------------------------------------------------- -->
		</div>
		<div class="card card-body text-center d-flex justify-content-between align-items-center  <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?>">
			<table style=" width:100% "><tr>
			<td class="text-left"><button type="button" class="btn bg-transparent text-white" onclick=" doBack(); "> <i class="icon-backward2 mr-2"></i> ย้อนกลับ </button></td>
			<td class="text-right"><button type="submit" class="btn bg-success" style=" width:160px; "> ส่งข้อความ <i class="icon-checkmark4 ml-2"></i></button></td>
			</tr></table>
		</div>
	</form>
</div>
<script src="edit.js"></script>