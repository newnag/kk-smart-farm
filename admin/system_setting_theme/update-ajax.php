<?php
#-------------------------------------------------------------------
# Config
#-------------------------------------------------------------------
include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");
include_once("../config/loader.php");
include_once("config.php");

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$SendRequest=array("act"=>MODULE_TABLE."_Theme_Update");
foreach ($_REQUEST as $key => $value) {
    if($value=="") {
        $SendRequest[$key]="-";
    } else {
        $SendRequest[$key]=$value;
    }
}
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);

#-------------------------------------------------------------------
# Save action to system logs
#-------------------------------------------------------------------
$SendRequest=array(); $SendRequest["inputAction"]="เปลี่ยน Theme สี ของระบบจัดการ";
include("../inc/inc_save_logs.php");

#-------------------------------------------------------------------
# Clear cache folder
#-------------------------------------------------------------------
$arClearCache=array("system_setting","navbar");
System_Clear_Cache($arClearCache);

?>OK