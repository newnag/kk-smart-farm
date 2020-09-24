<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputName = trim(urldecode($SendRequest['inputName']));
$inputNameOwner = trim(urldecode($SendRequest['inputNameOwner']));
$inputPhone = trim(urldecode($SendRequest['inputTel']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputQty = trim(urldecode($SendRequest['inputQty']));
$inputPinlat = trim(urldecode($SendRequest['inputPinlat']));
$inputPinlon = trim(urldecode($SendRequest['inputPinlon']));
$inputAddress = trim(urldecode($SendRequest['inputAddress']));
$inputProvince = trim(urldecode($SendRequest['inputProvince']));
$inputDistrict = trim(urldecode($SendRequest['inputDistrict']));
$inputSubdistrict = trim(urldecode($SendRequest['inputSubdistrict']));
$inputPost = trim(urldecode($SendRequest['inputPost']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

$ownerArr = explode("/",$inputNameOwner);

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT ".TABLE_MOD_FARM."_id FROM ".TABLE_MOD_FARM." WHERE ".TABLE_MOD_FARM."_name LIKE ? LIMIT 0,1 "; $arSQLData[]=$inputUser;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$myID=$Rows[0][TABLE_MOD_FARM."_id"];
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
if($myID>0) { // error existed!
	$ErrorMessage="ไม่สามารถสร้างใหม่ได้ มีผู้ใช้งาน ".$inputUser." อยู่ในระบบแล้ว";
} else { // insert
	try {
		$DataField=array(); $arSQLData=array();
		$sqla =" INSERT INTO ".TABLE_MOD_FARM."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
		$sqla.=" ".TABLE_MOD_FARM."_name ";          $sqlb.=" ? ";         $arSQLData[]=$inputName;
		$sqla.=",".TABLE_MOD_FARM."_ownerID ";         $sqlb.=",? ";         $arSQLData[]=$ownerArr[0];
		$sqla.=",".TABLE_MOD_FARM."_owner ";         $sqlb.=",? ";         $arSQLData[]=$ownerArr[1];
		$sqla.=",".TABLE_MOD_FARM."_tel ";         $sqlb.=",? ";         $arSQLData[]=$inputPhone;
		$sqla.=",".TABLE_MOD_FARM."_qtyLivestock ";          $sqlb.=",? ";         $arSQLData[]=$inputQty;
		$sqla.=",".TABLE_MOD_FARM."_thumbnail ";       $sqlb.=",? ";         $arSQLData[]=$inputPicture;
		$sqla.=",".TABLE_MOD_FARM."_pinlat ";       $sqlb.=",? ";         $arSQLData[]=$inputPinlat;
		$sqla.=",".TABLE_MOD_FARM."_pinlon ";       $sqlb.=",? ";         $arSQLData[]=$inputPinlon;
		$sqla.=",".TABLE_MOD_FARM."_address ";       $sqlb.=",? ";         $arSQLData[]=$inputAddress;
		$sqla.=",".TABLE_MOD_FARM."_province ";       $sqlb.=",? ";         $arSQLData[]=$inputProvince;
		$sqla.=",".TABLE_MOD_FARM."_district ";       $sqlb.=",? ";         $arSQLData[]=$inputDistrict;
		$sqla.=",".TABLE_MOD_FARM."_subdistrict ";       $sqlb.=",? ";         $arSQLData[]=$inputSubdistrict;
		$sqla.=",".TABLE_MOD_FARM."_postcode ";       $sqlb.=",? ";         $arSQLData[]=$inputPost;
		$sqla.=",".TABLE_MOD_FARM."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_FARM."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_FARM."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_FARM."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_FARM."_status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
		$sql=$sqla.$sqlb.$sqlc;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$myInsertID = $System_Connection->lastInsertId();
		$DataField["InsertID"]=$myInsertID; 
	} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "เพิ่มข้อมูลสำเร็จ";
	$Result["Result"] = $DataField;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>