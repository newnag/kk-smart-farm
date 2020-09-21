<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Module Config
#-------------------------------------------------------------------
define('MODULE_ICON',"icon-office");
define('MODULE_COLOR',"deeporange-800");
define('MODULE_TABLE',"Mod_Project");
define('MODULE_NAME',"โครงการ");
define('MODULE_MAIN_KEY',1000);
define('MODULE_SUB_KEY',1001);

define('MODULE_FIX_WIDTH',402);
define('MODULE_FIX_HEIGHT',402);

$arGalleryThumbWidth  = array("",574,382,382,192,192,382,382,574,574,382,382,192,192,382,382,574);
$arGalleryThumbHeight = array("",380,190,190,380,380,190,190,380,380,190,190,380,380,190,190,380);

?>