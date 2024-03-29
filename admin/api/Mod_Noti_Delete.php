<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Input
#-------------------------------------------------------------------
$inputID = trim(urldecode($SendRequest['inputID']));
$inputIDList = trim(urldecode($SendRequest['inputIDList']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
    $arSQLData=array();
    $sql =" UPDATE ".TABLE_MOD_NOTI." SET "; 
    $sql.=" ".TABLE_MOD_NOTI."_status=? ";          $arSQLData[]="Deleted";
    $sql.=" WHERE ".TABLE_MOD_NOTI."_id=? ";        $arSQLData[]=$inputID;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "แก้ไขข้อมูลสำเร็จ";
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>