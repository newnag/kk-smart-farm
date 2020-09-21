<?php
#-------------------------------------------------------------------
# Header for API Mode
#-------------------------------------------------------------------
header("Content-Type: application/json");

#-------------------------------------------------------------------
# Load Config
#-------------------------------------------------------------------
include("../config/config.php");
include("../config/function.php");

#-------------------------------------------------------------------
# Setting Up SendRequest
#-------------------------------------------------------------------
$act = $_REQUEST["act"];
foreach ($_REQUEST as $key => $value) { $SendRequest[$key]=urldecode($value); }

#-------------------------------------------------------------------
# Call to API File
#-------------------------------------------------------------------
if($act<>"" && strtolower($act)<>"index" && strtolower($act)<>"api" && strtolower($act)<>"info") {
    if(file_exists($act.".php")) {
        include_once("../config/connect.php");
        include($act.".php");
        include_once("../config/disconnect.php");
    } else {
        $Result["Status"] = "Error";
        $Result["Message"] = "API NOT FOUND";
    }
} else {
    $Result["Status"] = "Error";
    $Result["Message"] = "API NOT FOUND";
}

#-------------------------------------------------------------------
# Return as JSON
#-------------------------------------------------------------------
echo json_encode($Result);
?>