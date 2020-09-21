<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputUser = trim(urldecode($SendRequest['inputUser']));
$inputEmail = trim(urldecode($SendRequest['inputEmail']));
$inputPass = trim(urldecode($SendRequest['inputPass']));
$inputPhone = trim(urldecode($SendRequest['inputPhone']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputLevel = trim(urldecode($SendRequest['inputLevel']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT ".TABLE_SYSTEM_STAFF."_ID FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_User LIKE ? LIMIT 0,1 "; $arSQLData[]=$inputUser;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$myID=$Rows[0][TABLE_SYSTEM_STAFF."_ID"];
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
if($myID>0) { // error existed!
	$ErrorMessage="ไม่สามารถสร้างใหม่ได้ มีผู้ใช้งาน ".$inputUser." อยู่ในระบบแล้ว";
} else { // insert
	try {
		$DataField=array(); $arSQLData=array();
		$sqla =" INSERT INTO ".TABLE_SYSTEM_STAFF."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
		$sqla.=" ".TABLE_SYSTEM_STAFF."_User ";          $sqlb.=" ? ";         $arSQLData[]=$inputUser;
		$sqla.=",".TABLE_SYSTEM_STAFF."_Email ";         $sqlb.=",? ";         $arSQLData[]=$inputEmail;
		$sqla.=",".TABLE_SYSTEM_STAFF."_Phone ";         $sqlb.=",? ";         $arSQLData[]=$inputPhone;
		$sqla.=",".TABLE_SYSTEM_STAFF."_Pass ";          $sqlb.=",? ";         $arSQLData[]=$inputPass;
		$sqla.=",".TABLE_SYSTEM_STAFF."_Picture ";       $sqlb.=",? ";         $arSQLData[]=$inputPicture;
		$sqla.=",".TABLE_SYSTEM_STAFF."_Level ";         $sqlb.=",? ";         $arSQLData[]=$inputLevel;
		//$sqla.=",".TABLE_SYSTEM_STAFF."_StaffGroupID ";  $sqlb.=",? ";         $arSQLData[]=$inputStaffGroupID;
		$sqla.=",".TABLE_SYSTEM_STAFF."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_SYSTEM_STAFF."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_SYSTEM_STAFF."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_SYSTEM_STAFF."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_SYSTEM_STAFF."_Status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
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