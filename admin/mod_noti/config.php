<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-user");
define('MODULE_COLOR',"deeppurple-A400");
define('MODULE_TABLE',"Mod_Chat");
define('MODULE_NAME',"การแจ้งเตือน");
define('MODULE_MAIN_KEY',6000);
define('MODULE_SUB_KEY',6001);

?>