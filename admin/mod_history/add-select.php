<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Create SendRequest Data and Create PageKey
#-------------------------------------------------------------------
$SendRequest=array("act"=>"Mod_Select"."_Choice");
foreach ($_REQUEST as $key => $value) { $SendRequest[$key]=trim(urldecode($value)); }
$Config_PageKey=http_build_query($SendRequest);

//print_r($SendRequestPre);
// exit();

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$ResultA=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);