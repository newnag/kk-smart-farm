<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-stack-text");
define('MODULE_COLOR',"deeporange-800");
define('MODULE_TABLE',"Mod_Page");
define('MODULE_NAME',"Privacy Policy");
define('MODULE_MAIN_KEY',5000);
define('MODULE_SUB_KEY',5003);

define('MODULE_FIX_ID',2);

?>