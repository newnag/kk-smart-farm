<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputSubName = trim(urldecode($SendRequest['inputSubName']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
$arrLisr = explode("/",$inputCateName);

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
  $sql =" UPDATE ".TABLE_MOD_THUMBNAIL." SET "; 
	$sql.=" ".TABLE_MOD_THUMBNAIL."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
  $sql.=",".TABLE_MOD_THUMBNAIL."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
  if($inputSubName<>""){
    $sql.=",".TABLE_MOD_THUMBNAIL."_subID=? ";           $arSQLData[]=$inputSubName;
  }
	if($inputPicture<>""){
		$sql.=",".TABLE_MOD_THUMBNAIL."_picture=? ";     $arSQLData[]=$inputPicture;
  }
	$sql.=" WHERE ".TABLE_MOD_THUMBNAIL."_id=? ";        $arSQLData[]=$myID;
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