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
define('MODULE_TABLE',"Mod_ReproHistory");
define('MODULE_NAME',"ประวัติระบบสืบพันธุ์");
define('MODULE_MAIN_KEY',4000);
define('MODULE_SUB_KEY',4002);

?>