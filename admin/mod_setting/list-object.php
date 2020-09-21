<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>
<div class="card border-left-pink-400 <?php echo "theme-bordercolor-".$SystemSession_Theme_BGClassName; ?> rounded-1 card-interactive border-left-4" style=" border-left-width: 4px; height: 115px; margin-bottom:0px!important; ">
	<div class="card-header header-elements-inline">
		<h6 class="card-title"><b>
			<?php
			if($_REQUEST["inputShowASCDESC"]=="DESC") {
				echo (($_REQUEST["inputShowPage"]-1)*$_REQUEST["inputShowPageSize"])+$i+1;
			} else { 
				echo $Result["Header"]["TotalRecord"]-((($_REQUEST["inputShowPage"]-1)*$_REQUEST["inputShowPageSize"])+$i);
			}
			?>. <?php echo $Row["Key"]; ?> </b>
		</h6>
		<?php if($Config_ViewOnly) { } else { ?>
		<div class="header-elements">
			<span class="text-muted font-size-sm mr-2">
				<?php
				if($Row["Status"]=="Enable") { echo '<span class="badge bg-success"> เปิดใช้งาน </span>'; }
				if($Row["Status"]=="Disable") { echo '<span class="badge bg-warning"> ปิดใช้งาน </span>'; }
				if($Row["Status"]=="Deleted") { echo '<span class="badge bg-danger"> ลบไปแล้ว </span>'; }
				?>
			</span>
			<div class="list-icons">
				<a href="javascript:void(0)" class="list-icons-item" onclick=" doEdit('<?php echo $Row["ID"]; ?>'); "><i class="icon-pencil7"></i></a>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="card-body" style=" overflow: hidden; margin-bottom: 10px; ">
		<?php echo $Row["Value"]; ?>
	</div>
</div>