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
define('MODULE_TABLE',"Mod_Backup");
define('MODULE_NAME',"ระบบสำรองข้อมูล");
define('MODULE_MAIN_KEY',8000);
define('MODULE_SUB_KEY',8001);

define('MODULE_FIX_ID',1);

?>