<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Predefine
#-------------------------------------------------------------------
if($SendRequest["inputShowOrderBy"]=="") { $SendRequest["inputShowOrderBy"]="ID"; }
if($SendRequest["inputShowPage"]>0) { } else { $SendRequest["inputShowPage"]=1; }
if($SendRequest["inputShowPageSize"]>0) { } else { $SendRequest["inputShowPageSize"]=CONFIG_DEFAULT_PAGESIZE; }
$recstart=($SendRequest["inputShowPage"]-1)*$SendRequest["inputShowPageSize"];
$arDataList=array(); $DataRow=array(); $DataHeader=array();

$inputUserID = $SendRequest["inputUserID"];

#-------------------------------------------------------------------
# SQL Injection Protect 
#-------------------------------------------------------------------
$arCheck=array("Enable","Disable","Deleted");
if(!in_array($SendRequest["inputShowStatus"],$arCheck)) { $SendRequest["inputShowStatus"]="Enable"; }
$arCheck=array("ID","LastLoginDate","User");
if(!in_array($SendRequest["inputShowOrderBy"],$arCheck)) { $SendRequest["inputShowOrderBy"]="ID"; }
$arCheck=array("ASC","DESC");
if(!in_array($SendRequest["inputShowASCDESC"],$arCheck)) { $SendRequest["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
  $sql =" SELECT * FROM ".TABLE_MOD_CHAT." JOIN ".TABLE_MOD_USERFARM." ON ".TABLE_MOD_USERFARM."_id = ".TABLE_MOD_CHAT."_userID JOIN ".TABLE_SYSTEM_STAFF." ON ".TABLE_SYSTEM_STAFF."_ID = ".TABLE_MOD_CHAT."_adminID WHERE ".TABLE_MOD_CHAT."_roomID = ".$inputUserID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataQ = array();
    $dataQ["id"] = $Row[TABLE_MOD_CHAT."_id"];
    $dataQ["userID"]=$Row[TABLE_MOD_CHAT."_userID"] ;
    $dataQ["username"]=$Row[TABLE_MOD_USERFARM."_fullname"] ;
    $dataQ["adminID"] = $Row[TABLE_MOD_CHAT."_adminID"];
    $dataQ["adminName"] = $Row[TABLE_SYSTEM_STAFF."_User"];
    $dataQ["text"]=$Row[TABLE_MOD_CHAT."_text"] ;
    $dataQ["date"]=$Row[TABLE_MOD_CHAT."_date"] ;
    $dataQ["status"]=$Row[TABLE_MOD_CHAT."_status"] ;

    $arrdataQ[] = $dataQ;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


$DataHeader["Total"] = count($arrdataQ) ;

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Header"]=$DataHeader;
	$Result["Result"]=$arrdataQ;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>