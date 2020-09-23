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

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT ".TABLE_MOD_CATEGORY."_id FROM ".TABLE_MOD_CATEGORY." WHERE ".TABLE_MOD_CATEGORY."_name LIKE ? LIMIT 0,1 "; $arSQLData[]=$inputUser;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$myID=$Rows[0][TABLE_MOD_CATEGORY."_id"];
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
if($myID>0) { // error existed!
	$ErrorMessage="ไม่สามารถสร้างใหม่ได้ มีผู้ใช้งาน ".$inputUser." อยู่ในระบบแล้ว";
} else { // insert
	try {
		$DataField=array(); $arSQLData=array();
		$sqla =" INSERT INTO ".TABLE_MOD_CATEGORY."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
		$sqla.=" ".TABLE_MOD_CATEGORY."_name ";          $sqlb.=" ? ";         $arSQLData[]=$inputName;
		$sqla.=",".TABLE_MOD_CATEGORY."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_CATEGORY."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_CATEGORY."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_CATEGORY."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_CATEGORY."_status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
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