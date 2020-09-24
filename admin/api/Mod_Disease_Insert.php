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
$inputTitle1 = trim(urldecode($SendRequest['inputTitle1']));
$inputHTML1 = trim(urldecode($SendRequest['inputHTML1']));
$inputTitle2 = trim(urldecode($SendRequest['inputTitle2']));
$inputHTML2 = trim(urldecode($SendRequest['inputHTML2']));
$inputTitle3 = trim(urldecode($SendRequest['inputTitle3']));
$inputHTML3 = trim(urldecode($SendRequest['inputHTML3']));
$inputTitle4 = trim(urldecode($SendRequest['inputTitle4']));
$inputHTML4 = trim(urldecode($SendRequest['inputHTML4']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$DataField=array(); $arSQLData=array();
	$sqla =" INSERT INTO ".TABLE_MOD_DISEASE."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
	$sqla.=" ".TABLE_MOD_DISEASE."_name ";          $sqlb.=" ? ";         $arSQLData[]=$inputName;
	$sqla.=",".TABLE_MOD_DISEASE."_title1 ";       $sqlb.=",? ";         $arSQLData[]=$inputTitle1;
	$sqla.=",".TABLE_MOD_DISEASE."_content1 ";          $sqlb.=",? ";         $arSQLData[]=$inputHTML1;
	$sqla.=",".TABLE_MOD_DISEASE."_title2 ";          $sqlb.=",? ";         $arSQLData[]=$inputTitle2;
	$sqla.=",".TABLE_MOD_DISEASE."_content2 ";          $sqlb.=",? ";         $arSQLData[]=$inputHTML2;
  $sqla.=",".TABLE_MOD_DISEASE."_title3 ";          $sqlb.=",? ";         $arSQLData[]=$inputTitle3;
  $sqla.=",".TABLE_MOD_DISEASE."_content3 ";          $sqlb.=",? ";         $arSQLData[]=$inputHTML3;
  $sqla.=",".TABLE_MOD_DISEASE."_title4 ";          $sqlb.=",? ";         $arSQLData[]=$inputTitle4;
  $sqla.=",".TABLE_MOD_DISEASE."_content4 ";          $sqlb.=",? ";         $arSQLData[]=$inputHTML4;
	$sqla.=",".TABLE_MOD_DISEASE."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_DISEASE."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_DISEASE."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_DISEASE."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_DISEASE."_Status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
	$sql=$sqla.$sqlb.$sqlc;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$myInsertID = $System_Connection->lastInsertId();
	$DataField["InsertID"]=$myInsertID;
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