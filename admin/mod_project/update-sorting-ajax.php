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
# Save Data to API
#-------------------------------------------------------------------
$SendRequest=array("act"=>MODULE_TABLE."_UpdateSorting");
$SendRequest["inputData"]=$_REQUEST["inputData"];
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
$Row=$Result["Result"];

#-------------------------------------------------------------------
# Clear cache folder
#-------------------------------------------------------------------
$arClearCache=array("system_staff_group","system_staff");
System_Clear_Cache($arClearCache);

?>OK