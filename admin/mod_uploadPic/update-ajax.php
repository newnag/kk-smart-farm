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
$SendRequest=array("act"=>MODULE_TABLE."_ListOne");
$SendRequest["inputID"]=$_REQUEST["inputID"];
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
$Row=$Result["Result"];

#-------------------------------------------------------------------
# Clear old cookies 
#-------------------------------------------------------------------
setcookie(SS.'-SystemSession_Staff_Picture', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
setcookie(SS.'-SystemSession_Staff_Email', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);

#-------------------------------------------------------------------
# Create new cookies 
#-------------------------------------------------------------------
$SystemSession_Staff_Picture=$Row["Picture"]; setcookie(SS.'-SystemSession_Staff_Picture', $SystemSession_Staff_Picture, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
$SystemSession_Staff_Email=$Row["Email"];     setcookie(SS.'-SystemSession_Staff_Email', $SystemSession_Staff_Email, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);

?>OK