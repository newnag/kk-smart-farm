<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Predefine Variable
#-------------------------------------------------------------------
$arThemeColor=array("red"   ,"pink","purple","deeppurple","indigo","blue","lightblue","cyan","teal","green","lightgreen","lime" ,"yellow","amber" ,"orange","deeporange","brown","grey","slate");
$arThemeBase =array("danger","pink","violet","purple"    ,"indigo","blue","blue"     ,"teal","teal","green","green"     ,"green","orange","orange","orange","orange"    ,"brown","grey","slate");
$arThemeRow=array("","200","300","400","500","600","700","800","900","A100","A200","A400","A700");

#-------------------------------------------------------------------
# Show Page Header Panel
#-------------------------------------------------------------------
$Config_ShowButton=array("");
include_once("../inc/inc_page_header.php");
//-------------------------------------------------------------------

?>
<style>
.colorBox1 { width: 65px; height: 45px; overflow: hidden; padding: 0; margin: 0; }
.colorBox  { width: 64px; height: 43px; overflow: hidden; padding: 0; margin: 0; text-align: center; vertical-align: middle; font-size: 10px; cursor: pointer; padding-top: 15px; margin-left: 1px; }
.borderOne { color: #000000!important; font-weight: bold; font-size: 16px; padding-top: 10px; }
</style>
<div class="content">
	<form id="myForm" name="myForm" method="get" action="?">
	<input type="hidden" id="inputThemeBG" name="inputThemeBG" value="<?php echo $SystemConfig_Setting["ThemeBG"]; ?>" />
	<input type="hidden" id="inputThemeLevel" name="inputThemeLevel" value="<?php echo $SystemConfig_Setting["ThemeLevel"]; ?>" />
	</form>
	<h1 class="text-center">สีพื้น ( คลิ๊กเลือก เพื่อเปลี่ยนสีพื้นใหม่ )</h1>
	<table style=" margin: auto; ">
		<?php
		#-------------------------------------------------------------------
		# Show Data List
		#-------------------------------------------------------------------
		for($i=0;$i<sizeof($arThemeRow);$i++) {
			$myRow=$arThemeRow[$i];
			?><tr><?php
			for($x=0;$x<sizeof($arThemeColor);$x++) {
				$myColor=$arThemeColor[$x];
				if(($myColor=="brown" || $myColor=="grey"  || $myColor=="slate") && ($myRow=="A100" || $myRow=="A200" || $myRow=="A400" || $myRow=="A700")) {
					?><td class="colorBox1">&nbsp;</td><?php
				} else {
					if($myRow<>"") {
						$myBGColor="theme-bgcolor-".$myColor."-".$myRow;
					} else {
						$myBGColor="theme-bgcolor-".$myColor;
					}
					?>
					<td class="colorBox1 <?php echo $myBGColor." ".$myTextColor; ?>">
						<div class="colorBox text-white"
						onmouseover=" doChangeTheme('<?php echo $myColor; ?>','<?php echo $myRow; ?>'); "
						onmouseout=" doChangeTheme('<?php echo $SystemConfig_Setting["ThemeBG"]; ?>','<?php echo $SystemConfig_Setting["ThemeLevel"]; ?>'); "
						onclick=" doSaveTheme('<?php echo $myColor; ?>','<?php echo $myRow; ?>'); "
						id="id<?php echo $myColor; echo $myRow; ?>">
							<?php if($myRow<>"") { echo $myRow; } else { echo $myColor; } ?>
						</div>
					</td>
					<?php
				}
			}
			?></tr><?php
		}
		?>
	</table>
	<br>
	<br>
	<?php if(0) { ?>
	<h1 class="text-center">สีของข้อความ ( คลิ๊กเลือก เพื่อเปลี่ยนสีพื้นใหม่ )</h1>
	<table style=" margin: auto; ">
		<tr>
			<td class="colorBox1">
				<div class="colorBox navbar-dark text-white" onclick=" doSaveDarkOrLight('dark'); "
				style=" border: <?php if($SystemSession_Theme_DarkOrLight=="dark") { echo "1"; } else { echo "0"; } ?>px solid #FF0000; color: #FF0000; ">สว่าง</div>
			</td>
			<td class="colorBox1">
				<div class="colorBox bg-white navlight-dark text-dark" onclick=" doSaveDarkOrLight('light'); "
				style=" border: <?php if($SystemSession_Theme_DarkOrLight=="light") { echo "1"; } else { echo "0"; } ?>px solid #FF0000; ">เข้ม</div>
			</td>
		</tr>
	</table>
	<?php } ?>
</div>
<script src="edit.js"></script>