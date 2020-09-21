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
# Predefine Variable
#-------------------------------------------------------------------
if($_REQUEST["inputShowPage"]>0) { } else { $_REQUEST["inputShowPage"]="1"; } 
if($_REQUEST["inputShowPageSize"]>0) { } else { $_REQUEST["inputShowPageSize"]=12; }
if($_REQUEST["inputShowStatus"]=="") { $_REQUEST["inputShowStatus"]="Enable"; }
if($_REQUEST["inputShowOrderBy"]=="") { $_REQUEST["inputShowOrderBy"]="ID"; }
if($_REQUEST["inputShowASCDESC"]=="") { $_REQUEST["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# Create SendRequest Data and Create PageKey
#-------------------------------------------------------------------
$SendRequest=array("act"=>MODULE_TABLE."_List");
foreach ($_REQUEST as $key => $value) { $SendRequest[$key]=trim(urldecode($value)); }
$Config_PageKey=http_build_query($SendRequest);

####################################################################
####################################################################
# Caching Start
#
#
$Config_Cache_Folder=strtolower(MODULE_TABLE);
$Config_Cache_Name=$Config_PageKey;
include("../inc/inc_cache_start.php");
if(!$Config_Cache_Skip) { ob_start('System_Minify_HTML');
#
#

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);

#-------------------------------------------------------------------
# Show Data List
#-------------------------------------------------------------------
	$arData=$Result["Result"];
	for($i=0;$i<sizeof($arData);$i++) {
		$Row=$arData[$i];
		?><div class="col-sm-12 col-md-6 col-lg-3"><?php
		#-------------------------------------------------------------------
		# Show Object
		#-------------------------------------------------------------------
		$Config_ViewOnly=false;
		include("list-object.php");
		?></div><?php
	}
	
	#
	#
	include("../inc/inc_cache_end.php");
}
#
# Caching End <====
####################################################################
####################################################################
?>