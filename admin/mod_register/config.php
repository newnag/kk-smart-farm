<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-clipboard3");
define('MODULE_COLOR',"deeppurple-A700");
define('MODULE_TABLE',"Mod_Register");
define('MODULE_NAME',"ลงทะเบียน");
define('MODULE_MAIN_KEY',1000);
define('MODULE_SUB_KEY',1002);

?>