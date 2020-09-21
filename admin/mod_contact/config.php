<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"mi-mail-outline");
define('MODULE_COLOR',"deeppurple-A700");
define('MODULE_TABLE',"Mod_Contact");
define('MODULE_NAME',"การติดต่อ");
define('MODULE_MAIN_KEY',3000);
define('MODULE_SUB_KEY',3001);

?>