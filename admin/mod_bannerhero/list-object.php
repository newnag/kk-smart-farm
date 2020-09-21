<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>
<div class="card card-interactive" style=" max-width: 600px; margin: auto; ">
	<div class="card-header bg-light d-flex justify-content-between">
		<div class="font-weight-bold" style=" height: 20px; overflow: hidden; ">
			<?php
			if($_REQUEST["inputShowASCDESC"]=="DESC") {
				echo (($_REQUEST["inputShowPage"]-1)*$_REQUEST["inputShowPageSize"])+$i+1;
			} else { 
				echo $Result["Header"]["TotalRecord"]-((($_REQUEST["inputShowPage"]-1)*$_REQUEST["inputShowPageSize"])+$i);
			}
			?>. <?php echo $Row["Name"]; ?>
		</div>
		<span class="text-muted font-size-sm">
			<span class="badge bg-success">
			<?php
			if($Row["Status"]=="Enable") { echo 'เปิดใช้งาน'; }
			if($Row["Status"]=="Disable") { echo 'ปิดใช้งาน'; }
			if($Row["Status"]=="Deleted") { echo 'ลบไปแล้ว'; }
			?>
			</span>
		</span>
	</div>
	<div class="card-img-actions" style=" min-height: 50px; text-align: center; ">
		<img class="img-fluid" src="<?php echo $Row["Picture-Thumb"]; ?>" >
		<div class="card-img-actions-overlay">
				<?php if($Config_ViewOnly) { } else { ?>
				<?php if(0) { ?><a href="#" class="btn btn-outline bg-info text-info border-info border-2"> ดู </a><?php } ?>
				<a href="javascript:void(0)" class="btn btn-outline bg-success text-success border-success border-2 ml-2" onclick=" doEdit('<?php echo $Row["ID"]; ?>'); "> แก้ไข </a>
				<a href="javascript:void(0)" class="btn btn-outline bg-danger text-danger border-danger border-2 ml-2" onclick=" doDelete('<?php echo $Row["ID"]; ?>'); "> ลบ </a>
				<?php } ?>
		</div>
	</div>
</div>