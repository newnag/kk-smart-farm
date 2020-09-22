<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-book3");
define('MODULE_COLOR',"deeporange-800");
define('MODULE_TABLE',"Mod_Article");
define('MODULE_NAME',"บทความ");
define('MODULE_MAIN_KEY',2000);
define('MODULE_SUB_KEY',2001);

define('MODULE_FIX_WIDTH',402);
define('MODULE_FIX_HEIGHT',402);

?>