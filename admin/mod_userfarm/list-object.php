<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>
<div class="card card-interactive">
	<div class="card-header bg-light d-flex justify-content-between">
		<span class="font-weight-bold">
			<?php
			if($_REQUEST["inputShowASCDESC"]=="DESC") {
				echo (($_REQUEST["inputShowPage"]-1)*$_REQUEST["inputShowPageSize"])+$i+1;
			} else { 
				echo $Result["Header"]["TotalRecord"]-((($_REQUEST["inputShowPage"]-1)*$_REQUEST["inputShowPageSize"])+$i);
			}
			?>. <?php echo $Row["User"]; ?>
		</span>
		
	</div>
	<div class="card-img-actions" style=" min-height: 50px; text-align: center; ">
		<img class="img-fluid" src="<?php echo $Row["Picture"]; ?>" >
		<div class="card-img-actions-overlay">
				<?php if($Config_ViewOnly) { } else { ?>
				<?php if(0) { ?><a href="#" class="btn btn-outline bg-info text-info border-info border-2"> ดู </a><?php } ?>
				<a href="javascript:void(0)" class="btn btn-outline bg-success text-success border-success border-2 ml-2" onclick=" doEdit('<?php echo $Row["ID"]; ?>'); "> แก้ไข </a>
				<a href="javascript:void(0)" class="btn btn-outline bg-danger text-danger border-danger border-2 ml-2" onclick=" doDelete('<?php echo $Row["ID"]; ?>'); "> ลบ </a>
				<?php } ?>
		</div>
	</div>
	<div class="card-footer text-center border-top-0 <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?>">
		<ul class="list-inline mb-0">
			<li class="list-inline-item">
				<a href="javascript:void(0)" class="btn btn-outline btn-icon text-white btn-lg border-white rounded-round" data-popup="tooltip-custom" data-original-title="<?php echo $Row["Phone"]; ?>">
					<i class="icon-phone"></i>
				</a>
			</li>
			<li class="list-inline-item">
				<a href="javascript:void(0)" class="btn btn-outline btn-icon text-white btn-lg border-white rounded-round" data-popup="tooltip-custom" data-original-title="<?php echo $Row["Email"]; ?>">
					<i class="icon-envelop4"></i>
				</a>
			</li>
		</ul>
	</div>
</div>