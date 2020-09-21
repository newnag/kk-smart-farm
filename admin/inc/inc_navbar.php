<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

####################################################################
####################################################################
# Caching Start
#
$Config_Cache_Folder="navbar";
$Config_Cache_Name="navbar-1st-part";
	?>
	<div class="navbar navbar-expand-md
		<?php
		#-------------------------------------------------------------------
		# Show NavBar Theme
		#-------------------------------------------------------------------
		echo $SystemConfig_Theme_BGClass;
		
		?> navbar-dark navbar-static fixed-top" id="idNavBar">
		<div class="navbar-brand"><a href="../home/home.php" class="d-inline-block"><img src="../global_assets/images/logo_light.png" alt=""></a></div>
		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button"><i class="icon-paragraph-justify3"></i></button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav"><li class="nav-item"><a href="javascript:void(0)" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block" onclick=" System_doSideBarHideOrShow(); "><i class="icon-paragraph-justify3"></i></a></li></ul>
			<span class="navbar-text ml-md-3" id="idWelcomeMessage"> .. </span>
			<ul class="navbar-nav ml-md-auto">
				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> <i class="icon-pulse2 mr-2"></i> กิจกรรมล่าสุด </a>
					<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
						<div class="dropdown-content-header">
							<span class="font-size-sm line-height-sm text-uppercase font-weight-semibold"> กิจกรรมล่าสุด </span>
							<a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>
						</div>
						<div class="dropdown-content-body dropdown-scrollable">
							<?php
							#-------------------------------------------------------------------
							# Load Last Logs from API
							#-------------------------------------------------------------------
							$SendRequest=array();
							$SendRequest["act"]="System_Logs_List20";
							$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
							?><ul class="media-list"><?php
							#-------------------------------------------------------------------
							# Show Logs List
							#-------------------------------------------------------------------
							$arData=$Result["Result"];
							for($i=0;$i<sizeof($arData);$i++) {
								$Row=$arData[$i];
								?>
								<li class="media">
									<div class="mr-3"><a href="javascript:void(0)" class="btn theme-bgcolor-<?php echo $Row["Color"]; ?> text-white rounded-round btn-icon"><i class="<?php echo $Row["Icon"]; ?>"></i></a></div>
									<div class="media-body font-size-sm"> <a href="javascript:void(0)"><?php echo $Row["CreateByName"]; ?></a> <?php echo $Row["Action"]; ?>
										<div class="font-size-sm text-muted mt-1"> <?php echo System_ShowDateTimeEasy($Row["CreateDate"]); ?> </div>
									</div>
								</li>
								<?php
							}
							?>
							</ul>
						</div>
						<?php if(0) { ?>
						<div class="dropdown-content-footer bg-light">
							<a href="#" class="font-size-sm line-height-sm text-uppercase font-weight-semibold text-grey mr-auto">แสดงกิจกรรมทั้งหมด</a>
							<div><a href="#" class="text-grey ml-2" data-popup="tooltip" title="ตั้งค่า"><i class="icon-gear"></i></a></div>
						</div>
						<?php } ?>
					</div>
				</li>
				<li class="nav-item">
					<a href="#" class="navbar-nav-link" id="idLogoutLink">
						<i class="icon-switch2"></i>
						<span class="d-md-none ml-2">ออกจากระบบ</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
