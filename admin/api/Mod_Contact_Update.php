<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputName = trim(urldecode($SendRequest['inputName']));
$inputTel = trim(urldecode($SendRequest['inputTel']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));

$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_CONTACT." SET "; 
	$sql.=" ".TABLE_MOD_CONTACT."_name=? ";            $arSQLData[]=$inputName;
	if($inputPicture<>"") {
		$sql.=",".TABLE_MOD_CONTACT."_picture=? ";     $arSQLData[]=$inputPicture;
	}
	$sql.=",".TABLE_MOD_CONTACT."_tel=? ";            $arSQLData[]=$inputTel;
	$sql.=",".TABLE_MOD_CONTACT."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_CONTACT."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=",".TABLE_MOD_CONTACT."_Status=? ";          $arSQLData[]=$inputStatus;
	$sql.=" WHERE ".TABLE_MOD_CONTACT."_ID=? ";        $arSQLData[]=$myID;
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