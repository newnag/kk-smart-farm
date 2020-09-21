<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-hammer-wrench");
define('MODULE_COLOR',"deeppurple-A700");
define('MODULE_TABLE',"Mod_Setting");
define('MODULE_NAME',"Website Setting");
define('MODULE_MAIN_KEY',5000);
define('MODULE_SUB_KEY',5001);

?>