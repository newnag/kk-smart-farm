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
define('MODULE_TABLE',"Mod_BannerHero");
define('MODULE_NAME',"Hero Banner");
define('MODULE_MAIN_KEY',4000);
define('MODULE_SUB_KEY',4001);

define('MODULE_FIX_WIDTH',1920);
define('MODULE_FIX_HEIGHT',790);
define('MODULE_FIX_WIDTH_THUMB',960);
define('MODULE_FIX_HEIGHT_THUMB',395);

?>