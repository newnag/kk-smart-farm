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
$inputSubject = trim(urldecode($SendRequest['inputSubject']));
$inputEmail = trim(urldecode($SendRequest['inputEmail']));
$inputPhone = trim(urldecode($SendRequest['inputPhone']));
$inputDetail = trim(urldecode($SendRequest['inputDetail']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$DataField=array(); $arSQLData=array();
	$sqla =" INSERT INTO ".TABLE_MOD_CONTACT."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
	$sqla.=" ".TABLE_MOD_CONTACT."_Name ";          $sqlb.=" ? ";         $arSQLData[]=$inputName;
	$sqla.=",".TABLE_MOD_CONTACT."_Subject ";       $sqlb.=",? ";         $arSQLData[]=$inputSubject;
	$sqla.=",".TABLE_MOD_CONTACT."_Email ";         $sqlb.=",? ";         $arSQLData[]=$inputEmail;
	$sqla.=",".TABLE_MOD_CONTACT."_Phone ";         $sqlb.=",? ";         $arSQLData[]=$inputPhone;
	$sqla.=",".TABLE_MOD_CONTACT."_Detail ";        $sqlb.=",? ";         $arSQLData[]=$inputDetail;
	$sqla.=",".TABLE_MOD_CONTACT."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_CONTACT."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_CONTACT."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_CONTACT."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_CONTACT."_Status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
	$sql=$sqla.$sqlb.$sqlc;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$myInsertID = $System_Connection->lastInsertId();
	$DataField["InsertID"]=$myInsertID;
	//-------------------------------------------------
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

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