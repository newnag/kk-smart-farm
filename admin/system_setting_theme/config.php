<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"mi-format-color-fill");
define('MODULE_COLOR',"pink-400");
define('MODULE_TABLE',"System_Setting");
define('MODULE_NAME',"เปลี่ยน Theme");
define('MODULE_MAIN_KEY',2001);
define('MODULE_SUB_KEY',2);

?>