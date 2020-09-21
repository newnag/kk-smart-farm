<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputCodeName = trim(urldecode($SendRequest['inputCodeName']));
$inputName = trim(urldecode($SendRequest['inputName']));
$inputStatus = trim(urldecode($SendRequest['inputStatus']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_SYSTEM_STAFF_GROUP." SET "; 
	$sql.=" ".TABLE_SYSTEM_STAFF_GROUP."_CodeName=? ";        $arSQLData[]=$inputCodeName;
	$sql.=",".TABLE_SYSTEM_STAFF_GROUP."_Name=? ";           $arSQLData[]=$inputName;
	$sql.=",".TABLE_SYSTEM_STAFF_GROUP."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_SYSTEM_STAFF_GROUP."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=",".TABLE_SYSTEM_STAFF_GROUP."_Status=? ";          $arSQLData[]=$inputStatus;
	$sql.=" WHERE ".TABLE_SYSTEM_STAFF_GROUP."_ID=? ";        $arSQLData[]=$myID;
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