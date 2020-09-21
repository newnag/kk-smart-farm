<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>
<div class="card border-left-pink-400 <?php echo "theme-bordercolor-".$SystemSession_Theme_BGClassName; ?> rounded-1 card-interactive border-left-4" style=" border-left-width: 4px; height: 115px; margin-bottom:0px!important; ">
	<div class="card-header header-elements-inline" style=" padding-bottom: 5px; ">
		<h6 class="card-title">
			<?php
			if($_REQUEST["inputShowASCDESC"]=="DESC") {
				echo (($_REQUEST["inputShowPage"]-1)*$_REQUEST["inputShowPageSize"])+$i+1;
			} else { 
				echo $Result["Header"]["TotalRecord"]-((($_REQUEST["inputShowPage"]-1)*$_REQUEST["inputShowPageSize"])+$i);
			}
			?>. <?php echo $Row["FirstName"]." ".$Row["LastName"]; ?>
		</h6>
		<?php if($Config_ViewOnly) { } else { ?>
		<div class="header-elements">
			<span class="text-muted font-size-sm mr-2" id="idSetStatus<?php echo $Row["ID"]; ?>" style=" cursor: pointer; " onclick=" doToggleStatus(<?php echo $Row["ID"]; ?>); ">
				<?php
				if($Row["Status"]=="Enable") { echo '<span class="badge bg-success"> เปิดใช้งาน </span>'; }
				if($Row["Status"]=="Disable") { echo '<span class="badge bg-warning"> ปิดใช้งาน </span>'; }
				if($Row["Status"]=="Deleted") { echo '<span class="badge bg-danger"> ลบไปแล้ว </span>'; }
				?>
			</span>
		</div>
		<?php } ?>
	</div>
	<div class="card-body">
		<?php echo $Row["Email"]; ?><br>
		<?php echo $Row["Phone"]; ?><br>
		<b><small><?php echo $Row["ProjectName"]; ?></b></small>
	</div>
</div>