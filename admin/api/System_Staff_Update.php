<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputEmail = trim(urldecode($SendRequest['inputEmail']));
$inputPhone = trim(urldecode($SendRequest['inputPhone']));
$inputPass = trim(urldecode($SendRequest['inputPass']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputStatus = trim(urldecode($SendRequest['inputStatus']));
$inputLevel = trim(urldecode($SendRequest['inputLevel']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_SYSTEM_STAFF." SET "; 
	$sql.=" ".TABLE_SYSTEM_STAFF."_Email=? ";           $arSQLData[]=$inputEmail;
	$sql.=",".TABLE_SYSTEM_STAFF."_Level=? ";           $arSQLData[]=$inputLevel;
	$sql.=",".TABLE_SYSTEM_STAFF."_Phone=? ";           $arSQLData[]=$inputPhone;
	if($inputPass<>"") {
		$sql.=",".TABLE_SYSTEM_STAFF."_Pass=? ";        $arSQLData[]=$inputPass;
	}
	if($inputPicture<>"") {
		$sql.=",".TABLE_SYSTEM_STAFF."_Picture=? ";     $arSQLData[]=$inputPicture;
	}
	$sql.=",".TABLE_SYSTEM_STAFF."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_SYSTEM_STAFF."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=",".TABLE_SYSTEM_STAFF."_Status=? ";          $arSQLData[]=$inputStatus;
	$sql.=" WHERE ".TABLE_SYSTEM_STAFF."_ID=? ";        $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
###################################################

//RESULT:---------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "แก้ไขข้อมูลสำเร็จ";
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>