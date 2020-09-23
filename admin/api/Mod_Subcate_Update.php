<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputName = trim(urldecode($SendRequest['inputName']));
$inputChoice = trim(urldecode($SendRequest['inputChoice']));
$inputCateName = trim(urldecode($SendRequest['inputCateName']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
$arrLisr = explode("/",$inputCateName);

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_SUBCATEGORY." SET "; 
	$sql.=" ".TABLE_MOD_SUBCATEGORY."_name=? ";           $arSQLData[]=$inputName;
	if($inputPicture<>"") {
		$sql.=",".TABLE_MOD_SUBCATEGORY."_thumbnail=? ";     $arSQLData[]=$inputPicture;
    }
    if($inputCateName<>""){
        $sql.=",".TABLE_MOD_SUBCATEGORY."_cateID=? ";           $arSQLData[]=$arrLisr[0];
        $sql.=",".TABLE_MOD_SUBCATEGORY."_cateName=? ";           $arSQLData[]=$arrLisr[1];
    }
	$sql.=",".TABLE_MOD_SUBCATEGORY."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_SUBCATEGORY."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=" WHERE ".TABLE_MOD_SUBCATEGORY."_id=? ";        $arSQLData[]=$myID;
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