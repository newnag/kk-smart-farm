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
define('MODULE_TABLE',"Mod_Rut");
define('MODULE_NAME',"ลักษณะเมือก");
define('MODULE_MAIN_KEY',2000);
define('MODULE_SUB_KEY',2002);

?>