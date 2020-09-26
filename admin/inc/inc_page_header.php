<?php
//-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
//-------------------------------------------------------------------
?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4>
			<a href="javascript:void(0)" class="btn <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?> text-white rounded-round btn-icon legitRipple mr-2"><i class="<?php echo MODULE_ICON; ?>" style=" font-size: 26px; margin: 1px; "></i></a>
			<span class="font-weight-bold"><?php echo MODULE_NAME; ?></span> 
			</h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
		<div class="header-elements d-none">
			<?php
			if(in_array("add",$Config_ShowButton) && MODULE_TABLE != "Mod_Chat") {
				?> &nbsp; <a href="#" class="btn btn-success btn-labeled btn-labeled-right bg-success-400" style=" width: 120px; " onclick=" doAdd(); ">เพิ่ม <b><i class="icon-plus22"></i></b></a> <?php
			}
			if(in_array("sorting",$Config_ShowButton)) {
				?> &nbsp; <a href="#" class="btn btn-info btn-labeled btn-labeled-right bg-info-400" style=" width: 120px; " onclick=" doSort(); ">จัดเรียง <b><i class="icon-move-down2"></i></b></a> <?php
			}
			if(in_array("back",$Config_ShowButton)) {
				?> &nbsp; <a href="#" class="btn btn-grey btn-labeled btn-labeled-right bg-grey-400" style=" width: 120px; " onclick=" doBack(); ">ย้อนกลับ <b><i class="icon-undo2"></i></b></a> <?php
			}
			if(MODULE_TABLE == "Mod_Chat"){
				?> &nbsp; <a href="#" class="btn btn-success btn-labeled btn-labeled-right bg-success-400" style=" width: 120px; " onclick=" doAdd(); ">ตอบกลับ <b><i class="icon-plus22"></i></b></a> <?php
			}
			?>
		</div>
	</div>
</div>