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
$inputTel = trim(urldecode($SendRequest['inputTel']));
$inputSexSum = trim(urldecode($SendRequest['inputSexSum']));
$inputDOB = trim(urldecode($SendRequest['inputDOB']));
$inputaddress = trim(urldecode($SendRequest['inputaddress']));
$inputSubdistrict = trim(urldecode($SendRequest['inputSubdistrict']));
$inputDistrict = trim(urldecode($SendRequest['inputDistrict']));
$inputProvince = trim(urldecode($SendRequest['inputProvince']));
$inputPost = trim(urldecode($SendRequest['inputPost']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_USERFARM." SET "; 
	$sql.=" ".TABLE_MOD_USERFARM."_email=? ";           $arSQLData[]=$inputEmail;
	$sql.=",".TABLE_MOD_USERFARM."_tel=? ";           $arSQLData[]=$inputPhone;
	if($inputPass<>"") {
		$sql.=",".TABLE_MOD_USERFARM."_password=? ";        $arSQLData[]=$inputPass;
	}
	if($inputPicture<>"") {
		$sql.=",".TABLE_MOD_USERFARM."_thumbnail=? ";     $arSQLData[]=$inputPicture;
    }
    $sql.=",".TABLE_MOD_USERFARM."_sex=? ";           $arSQLData[]=$inputSexSum;
    $sql.=",".TABLE_MOD_USERFARM."_DOB=? ";           $arSQLData[]=$inputDOB;
    $sql.=",".TABLE_MOD_USERFARM."_address=? ";           $arSQLData[]=$inputaddress;
    $sql.=",".TABLE_MOD_USERFARM."_subdistrict=? ";           $arSQLData[]=$inputSubdistrict;
    $sql.=",".TABLE_MOD_USERFARM."_district=? ";           $arSQLData[]=$inputDistrict;
    $sql.=",".TABLE_MOD_USERFARM."_province=? ";           $arSQLData[]=$inputProvince;
    $sql.=",".TABLE_MOD_USERFARM."_postcode=? ";           $arSQLData[]=$inputPost;
	$sql.=",".TABLE_MOD_USERFARM."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_USERFARM."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=" WHERE ".TABLE_MOD_USERFARM."_id=? ";        $arSQLData[]=$myID;
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