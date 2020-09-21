<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-stack-picture");
define('MODULE_COLOR',"deeporange-800");
define('MODULE_TABLE',"Mod_BannerHero4");
define('MODULE_NAME',"Hero Banner ติดต่อเรา");
define('MODULE_MAIN_KEY',1003);
define('MODULE_SUB_KEY',5);

define('MODULE_FIX_WIDTH',1920);
define('MODULE_FIX_HEIGHT',790);
define('MODULE_FIX_WIDTH_THUMB',960);
define('MODULE_FIX_HEIGHT_THUMB',395);

?>