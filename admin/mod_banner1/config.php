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
define('MODULE_TABLE',"Mod_Banner1");
define('MODULE_NAME',"Banner Home ค้นหา");
define('MODULE_MAIN_KEY',1003);
define('MODULE_SUB_KEY',6);

define('MODULE_FIX_WIDTH',1270);
define('MODULE_FIX_HEIGHT',153);

?>