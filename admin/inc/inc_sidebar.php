<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
?>
<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
    <!-------------------------------------------------------------->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle"> <i class="icon-arrow-left8"></i> </a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand"><i class="icon-screen-full"></i><i class="icon-screen-normal"></i></a>
    </div>
    <!-------------------------------------------------------------->
    <div class="sidebar-content">
        <!-------------------------------------------------------------->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?>">
                <div class="card-body text-center"> 
                    <a href="#"> <img src="<?php echo $SystemSession_Staff_Picture; ?>" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="<?php echo $SystemSession_Staff_User; ?>"> </a>
                    <h6 class="mb-0 text-white text-shadow-dark"><?php echo $SystemSession_Staff_User; ?></h6>
                    <span class="font-size-sm text-white text-shadow-dark"><?php echo $SystemSession_Staff_Email; ?></span>
                </div>
                <div class="sidebar-user-material-footer"> <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span> เมนูส่วนตัว </span></a> </div>
            </div>
            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar theme-bgcolor-slate-300 text-white">
                    <li class="nav-item"> <a href="http://kk.getdev.top/smartfarm/admin/system_staff/?doaction=edit&inputID=<?php echo $_COOKIE['MS-SystemSession_Staff_ID'] ?>" class="nav-link"> <i class="icon-user-plus"></i> <span> ข้อมูลส่วนตัว </span> </a> </li>
                    <li class="nav-item"> <a href="#" class="nav-link" id="idLogoutLink2"> <i class="icon-switch2"></i> <span>ออกจากระบบ</span> </a> </li>
                </ul>
            </div>
        </div>
        <!-------------------------------------------------------------->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-------------------------------------------------------------->
                <!-- Website Content -->
                <!-------------------------------------------------------------->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Website Management</div> <i class="icon-menu" title="Website Management"></i></li>
                <?php
                foreach ($System_MenuMain_Name as $myMenuMain_ID => $myMenuMain_Name) {
                    ?>
                    <li class="nav-item nav-item-submenu <?php if(MODULE_MAIN_KEY==$myMenuMain_ID) { echo " nav-item-open ";  } ?>" id="idSideBarMain<?php echo $myMenuMain_ID; ?>">
                        <a href="javascript:void(0)" class="nav-link"> <i class="<?php echo $System_MenuMain_Icons[$myMenuMain_ID]; ?>"></i> <span> <?php echo $myMenuMain_Name; ?> </span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="<?php echo $myMenuMain_Name; ?>">
                            <?php
                            foreach ($System_MenuSub_Name as $myMenuSub_ID => $myMenuSub_Name) {
                                if($myMenuSub_ID>$myMenuMain_ID && $myMenuSub_ID<$myMenuMain_ID+1000) {
                                    ?><li class="nav-item"><a id="idSideBarSub<?php echo $myMenuMain_ID; ?>_<?php echo $myMenuSub_ID; ?>" href="<?php echo $System_MenuSub_Link[$myMenuSub_ID]; ?>" class="nav-link">
                                    <?php
                                    if(MODULE_MAIN_KEY==$myMenuMain_ID && MODULE_SUB_KEY==$myMenuSub_ID) {
                                        ?><span style=" font-weight:bold; color: #AA0000; "><?php echo $System_MenuSub_Name[$myMenuSub_ID]; ?></span><?php
                                    } else {
                                        echo $System_MenuSub_Name[$myMenuSub_ID];
                                    } ?>
                                    </a></li><?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <!-------------------------------------------------------------->
                <!-- Admin Setting -->
                <!-------------------------------------------------------------->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Admin Setting</div> <i class="icon-menu" title="Admin Setting"></i></li>
                <li class="nav-item nav-item-submenu" id="idSideBarMain2001">
                    <a href="javascript:void(0)" class="nav-link"> <i class="icon-cog"></i> <span> จัดการระบบ </span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="จัดการระบบ">
                        <li class="nav-item"><a id="idSideBarSub2001_1" href="../system_staff/" class="nav-link legitRipple"> ผู้ดูแลระบบ </a></li>
                        <?php if(0) { ?>
                        <li class="nav-item"><a id="idSideBarSub2001_3" href="../system_staff_group/" class="nav-link legitRipple"> กลุ่มของผู้ดูแล </a></li>
                        <?php } ?>
                        <li class="nav-item"><a id="idSideBarSub2001_2" href="../system_setting_theme/" class="nav-link legitRipple"> เปลี่ยน Theme สี </a></li>
                    </ul>
                </li>
                <!-------------------------------------------------------------->
            </ul>
        </div>
    </div>
    <!-------------------------------------------------------------->
</div>
<script>
<?php
if($SystemSession_Theme_MenuHideOrShow=='show') { echo " var System_SideBarHideOrShow=false; "; }
if($SystemSession_Theme_MenuHideOrShow=='hide') { echo " var System_SideBarHideOrShow=true; "; }
?>
function doSetSideBarMenu(myMainID,mySubID) {
    $('#idSideBarMain'+myMainID).addClass('nav-item-expanded nav-item-open');
    $('#idSideBarSub'+myMainID+'_'+mySubID).addClass('active');
}
doSetSideBarMenu('<?php echo MODULE_MAIN_KEY; ?>','<?php echo MODULE_SUB_KEY; ?>');
$('#idWelcomeMessage').html("ยินดีต้อนรับคุณ <?php echo $SystemSession_Staff_User; ?> - ขณะนี้เวลา <?php echo System_ShowDateTime(SYSTEM_DATETIMENOW); ?>");
</script>