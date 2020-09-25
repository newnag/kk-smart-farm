<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------

//$inputUser = trim(urldecode($SendRequest['inputUser']));
$inputEmail = trim(urldecode($SendRequest['inputEmail']));
$inputPass = trim(urldecode($SendRequest['inputPass']));
$inputPhone = trim(urldecode($SendRequest['inputTel']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputFullname = trim(urldecode($SendRequest['inputFullname']));
$inputLastname = trim(urldecode($SendRequest['inputLastname']));
$inputSexSum = trim(urldecode($SendRequest['inputSexSum']));
$inputIdNo = trim(urldecode($SendRequest['inputIdNo']));
$inputDOB = trim(urldecode($SendRequest['inputDOB']));
$inputAddress = trim(urldecode($SendRequest['inputAddress']));
$inputProvince = trim(urldecode($SendRequest['inputProvince']));
$inputDistrict = trim(urldecode($SendRequest['inputDistrict']));
$inputSubdistrict = trim(urldecode($SendRequest['inputSubdistrict']));
$inputPost = trim(urldecode($SendRequest['inputPost']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

$inputPass=hash('sha256',SYSTEM_AUTHEN_KEY.$inputPass.SYSTEM_AUTHEN_KEY);

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT ".TABLE_MOD_USERFARM."_id FROM ".TABLE_MOD_USERFARM." WHERE ".TABLE_MOD_USERFARM."_email LIKE ? LIMIT 0,1 "; $arSQLData[]=$inputEmail;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$myID=$Rows[0][TABLE_MOD_USERFARM."_id"];
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
if($myID>0) { // error existed!
	$ErrorMessage="ไม่สามารถสร้างใหม่ได้ มีผู้ใช้งาน ".$inputUser." อยู่ในระบบแล้ว";
} else { // insert
	try {
		$DataField=array(); $arSQLData=array();
		$sqla =" INSERT INTO ".TABLE_MOD_USERFARM."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
		//$sqla.=" ".TABLE_MOD_USERFARM."_user ";          $sqlb.=" ? ";         $arSQLData[]=$inputUser;
		$sqla.=" ".TABLE_MOD_USERFARM."_email ";         $sqlb.=" ? ";         $arSQLData[]=$inputEmail;
		$sqla.=",".TABLE_MOD_USERFARM."_tel ";         $sqlb.=",? ";         $arSQLData[]=$inputPhone;
		$sqla.=",".TABLE_MOD_USERFARM."_password ";          $sqlb.=",? ";         $arSQLData[]=$inputPass;
		$sqla.=",".TABLE_MOD_USERFARM."_thumbnail ";       $sqlb.=",? ";         $arSQLData[]=$inputPicture;
		$sqla.=",".TABLE_MOD_USERFARM."_fullname ";       $sqlb.=",? ";         $arSQLData[]=$inputFullname;
		$sqla.=",".TABLE_MOD_USERFARM."_lastname ";       $sqlb.=",? ";         $arSQLData[]=$inputLastname;
		$sqla.=",".TABLE_MOD_USERFARM."_sex ";       $sqlb.=",? ";         $arSQLData[]=$inputSexSum;
		$sqla.=",".TABLE_MOD_USERFARM."_id_no ";       $sqlb.=",? ";         $arSQLData[]=$inputIdNo;
		$sqla.=",".TABLE_MOD_USERFARM."_DOB ";       $sqlb.=",? ";         $arSQLData[]=$inputDOB;
		$sqla.=",".TABLE_MOD_USERFARM."_address ";       $sqlb.=",? ";         $arSQLData[]=$inputAddress;
		$sqla.=",".TABLE_MOD_USERFARM."_province ";       $sqlb.=",? ";         $arSQLData[]=$inputProvince;
		$sqla.=",".TABLE_MOD_USERFARM."_district ";       $sqlb.=",? ";         $arSQLData[]=$inputDistrict;
		$sqla.=",".TABLE_MOD_USERFARM."_subdistrict ";       $sqlb.=",? ";         $arSQLData[]=$inputSubdistrict;
		$sqla.=",".TABLE_MOD_USERFARM."_postcode ";       $sqlb.=",? ";         $arSQLData[]=$inputPost;
		//$sqla.=",".TABLE_MOD_USERFARM."_Level ";         $sqlb.=",? ";         $arSQLData[]=$inputLevel;
		//$sqla.=",".TABLE_MOD_USERFARM."_StaffGroupID ";  $sqlb.=",? ";         $arSQLData[]=$inputStaffGroupID;
		$sqla.=",".TABLE_MOD_USERFARM."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_USERFARM."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_USERFARM."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_USERFARM."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_USERFARM."_status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
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