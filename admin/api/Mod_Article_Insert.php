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
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputHTML = trim(urldecode($SendRequest['inputHTML']));
$inputSource = trim(urldecode($SendRequest['inputSource']));
$inputType = trim(urldecode($SendRequest['inputType']));
$inputAgeRange = trim(urldecode($SendRequest['inputAgeRange']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$DataField=array(); $arSQLData=array();
	$sqla =" INSERT INTO ".TABLE_MOD_ARTICLE."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
	$sqla.=" ".TABLE_MOD_ARTICLE."_Name ";          $sqlb.=" ? ";         $arSQLData[]=$inputName;
	$sqla.=",".TABLE_MOD_ARTICLE."_Picture ";       $sqlb.=",? ";         $arSQLData[]=$inputPicture;
	$sqla.=",".TABLE_MOD_ARTICLE."_HTML ";          $sqlb.=",? ";         $arSQLData[]=$inputHTML;
	$sqla.=",".TABLE_MOD_ARTICLE."_source ";          $sqlb.=",? ";         $arSQLData[]=$inputSource;
	$sqla.=",".TABLE_MOD_ARTICLE."_Type ";          $sqlb.=",? ";         $arSQLData[]=$inputType;
	$sqla.=",".TABLE_MOD_ARTICLE."_Title ";          $sqlb.=",? ";         $arSQLData[]=$inputAgeRange;
	$sqla.=",".TABLE_MOD_ARTICLE."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_ARTICLE."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_ARTICLE."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_ARTICLE."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_ARTICLE."_Status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
	$sql=$sqla.$sqlb.$sqlc;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$myInsertID = $System_Connection->lastInsertId();
	$DataField["InsertID"]=$myInsertID;
	//-------------------------------------------------
	if($myInsertID>0) {
		$arSQLData=array();
		$sql =" UPDATE ".TABLE_MOD_ARTICLE." SET "; 
		$sql.=" ".TABLE_MOD_ARTICLE."_Order=? ";      $arSQLData[]=$myInsertID;
		$sql.=" WHERE ".TABLE_MOD_ARTICLE."_ID=? ";   $arSQLData[]=$myInsertID;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	}
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