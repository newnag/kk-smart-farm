<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-users4");
define('MODULE_COLOR',"deeppurple-A700");
define('MODULE_TABLE',"System_Staff_Group");
define('MODULE_NAME',"กลุ่มของผู้ดูแล");
define('MODULE_MAIN_KEY',2001);
define('MODULE_SUB_KEY',3);

?>