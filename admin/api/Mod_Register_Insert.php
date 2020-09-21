<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputProjectID = trim(urldecode($SendRequest['inputProjectID']));
$inputFirstName = trim(urldecode($SendRequest['inputFirstName']));
$inputLastName = trim(urldecode($SendRequest['inputLastName']));
$inputEmail = trim(urldecode($SendRequest['inputEmail']));
$inputPhone = trim(urldecode($SendRequest['inputPhone']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$DataField=array(); $arSQLData=array();
	$sqla =" INSERT INTO ".TABLE_MOD_REGISTER."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
	$sqla.=" ".TABLE_MOD_REGISTER."_FirstName ";     $sqlb.=" ? ";         $arSQLData[]=$inputFirstName;
	$sqla.=",".TABLE_MOD_REGISTER."_LastName ";      $sqlb.=",? ";         $arSQLData[]=$inputLastName;
	$sqla.=",".TABLE_MOD_REGISTER."_Email ";         $sqlb.=",? ";         $arSQLData[]=$inputEmail;
	$sqla.=",".TABLE_MOD_REGISTER."_Phone ";         $sqlb.=",? ";         $arSQLData[]=$inputPhone;
	$sqla.=",".TABLE_MOD_REGISTER."_ProjectID ";     $sqlb.=",? ";         $arSQLData[]=$inputProjectID;
	$sqla.=",".TABLE_MOD_REGISTER."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_REGISTER."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_REGISTER."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_REGISTER."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_REGISTER."_Status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
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