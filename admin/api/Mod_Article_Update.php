<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputName = trim(urldecode($SendRequest['inputName']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputHTML = trim(urldecode($SendRequest['inputHTML']));
$inputSource = trim(urldecode($SendRequest['inputSource']));
$inputType = trim(urldecode($SendRequest['inputType']));
$inputStatus = trim(urldecode($SendRequest['inputStatus']));
$inputAgeRange = trim(urldecode($SendRequest['inputAgeRange']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_ARTICLE." SET "; 
	$sql.=" ".TABLE_MOD_ARTICLE."_Name=? ";            $arSQLData[]=$inputName;
	if($inputPicture<>"") {
		$sql.=",".TABLE_MOD_ARTICLE."_Picture=? ";     $arSQLData[]=$inputPicture;
	}
	$sql.=",".TABLE_MOD_ARTICLE."_HTML=? ";            $arSQLData[]=$inputHTML;
	if($inputSource<>""){
		$sql.=",".TABLE_MOD_ARTICLE."_source=? ";            $arSQLData[]=$inputSource;
	}
	if($inputType<>""){
		$sql.=",".TABLE_MOD_ARTICLE."_Type=? ";            $arSQLData[]=$inputType;
	}
	if($inputAgeRange<>""){
		$sql.=",".TABLE_MOD_ARTICLE."_Title=? ";            $arSQLData[]=$inputAgeRange;
	}
	$sql.=",".TABLE_MOD_ARTICLE."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_ARTICLE."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=",".TABLE_MOD_ARTICLE."_Status=? ";          $arSQLData[]=$inputStatus;
	$sql.=" WHERE ".TABLE_MOD_ARTICLE."_ID=? ";        $arSQLData[]=$myID;
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