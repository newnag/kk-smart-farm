<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputName = trim(urldecode($SendRequest['inputName']));
$inputNameOwner = trim(urldecode($SendRequest['inputNameOwner']));
$inputQty = trim(urldecode($SendRequest['inputQty']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputTel = trim(urldecode($SendRequest['inputTel']));
$inputAddress = trim(urldecode($SendRequest['inputAddress']));
$inputSubdistrict = trim(urldecode($SendRequest['inputSubdistrict']));
$inputDistrict = trim(urldecode($SendRequest['inputDistrict']));
$inputProvince = trim(urldecode($SendRequest['inputProvince']));
$inputPost = trim(urldecode($SendRequest['inputPost']));
$inputPinlat = trim(urldecode($SendRequest['inputPinlat']));
$inputPinlon = trim(urldecode($SendRequest['inputPinlon']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

$ownerArr = explode("/",$inputNameOwner);

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_FARM." SET "; 
		$sql.=" ".TABLE_MOD_FARM."_name=? ";           $arSQLData[]=$inputName;
		$sql.=",".TABLE_MOD_FARM."_ownerID=? ";           $arSQLData[]=$ownerArr[0];
    $sql.=",".TABLE_MOD_FARM."_owner=? ";           $arSQLData[]=$ownerArr[1];
    $sql.=",".TABLE_MOD_FARM."_tel=? ";           $arSQLData[]=$inputTel;
    $sql.=",".TABLE_MOD_FARM."_qtyLivestock=? ";           $arSQLData[]=$inputQty;
	$sql.=",".TABLE_MOD_FARM."_thumbnail=? ";     $arSQLData[]=$inputPicture;
    $sql.=",".TABLE_MOD_FARM."_pinlat=? ";           $arSQLData[]=$inputPinlat;
    $sql.=",".TABLE_MOD_FARM."_pinlon=? ";           $arSQLData[]=$inputPinlon;
    $sql.=",".TABLE_MOD_FARM."_address=? ";           $arSQLData[]=$inputAddress;
    $sql.=",".TABLE_MOD_FARM."_subdistrict=? ";           $arSQLData[]=$inputSubdistrict;
    $sql.=",".TABLE_MOD_FARM."_district=? ";           $arSQLData[]=$inputDistrict;
    $sql.=",".TABLE_MOD_FARM."_province=? ";           $arSQLData[]=$inputProvince;
    $sql.=",".TABLE_MOD_FARM."_postcode=? ";           $arSQLData[]=$inputPost;
	$sql.=",".TABLE_MOD_FARM."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_FARM."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=" WHERE ".TABLE_MOD_FARM."_id=? ";        $arSQLData[]=$myID;
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