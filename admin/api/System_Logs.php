<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Input
#-------------------------------------------------------------------
$inputIcon = trim(urldecode($SendRequest['inputIcon']));
$inputColor = trim(urldecode($SendRequest['inputColor']));
$inputAction = trim(urldecode($SendRequest['inputAction']));
$inputKeyMain = trim(urldecode($SendRequest['inputKeyMain']));
$inputKeySub = trim(urldecode($SendRequest['inputKeySub']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$DataField=array(); $arSQLData=array();
	$sqla =" INSERT INTO ".TABLE_SYSTEM_LOGS."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
	$sqla.=" ".TABLE_SYSTEM_LOGS."_Icon ";          $sqlb.=" ? ";         $arSQLData[]=$inputIcon;
	$sqla.=",".TABLE_SYSTEM_LOGS."_Color ";         $sqlb.=",? ";         $arSQLData[]=$inputColor;
	$sqla.=",".TABLE_SYSTEM_LOGS."_Action ";        $sqlb.=",? ";         $arSQLData[]=$inputAction;
	$sqla.=",".TABLE_SYSTEM_LOGS."_KeyMain ";       $sqlb.=",? ";         $arSQLData[]=$inputKeyMain;
	$sqla.=",".TABLE_SYSTEM_LOGS."_KeySub ";        $sqlb.=",? ";         $arSQLData[]=$inputKeySub;
	$sqla.=",".TABLE_SYSTEM_LOGS."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_SYSTEM_LOGS."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sql=$sqla.$sqlb.$sqlc;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "เพิ่มข้อมูลสำเร็จ";
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>