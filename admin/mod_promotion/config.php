<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-coin-dollar");
define('MODULE_COLOR',"deeporange-800");
define('MODULE_TABLE',"Mod_Promotion");
define('MODULE_NAME',"โปรโมชั่น");
define('MODULE_MAIN_KEY',2000);
define('MODULE_SUB_KEY',2002);

define('MODULE_FIX_WIDTH',402);
define('MODULE_FIX_HEIGHT',402);

?>