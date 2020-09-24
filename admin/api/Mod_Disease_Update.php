<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
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

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_DISEASE." SET "; 
  $sql.=" ".TABLE_MOD_DISEASE."_name=? ";           $arSQLData[]=$inputName;
  $sql.=",".TABLE_MOD_DISEASE."_title1=? ";           $arSQLData[]=$inputTitle1;
  $sql.=",".TABLE_MOD_DISEASE."_content1=? ";           $arSQLData[]=$inputHTML1;
  $sql.=",".TABLE_MOD_DISEASE."_title2=? ";           $arSQLData[]=$inputTitle2;
  $sql.=",".TABLE_MOD_DISEASE."_content2=? ";           $arSQLData[]=$inputHTML2;
  $sql.=",".TABLE_MOD_DISEASE."_title3=? ";           $arSQLData[]=$inputTitle3;
  $sql.=",".TABLE_MOD_DISEASE."_content3=? ";           $arSQLData[]=$inputHTML3;
  $sql.=",".TABLE_MOD_DISEASE."_title4=? ";           $arSQLData[]=$inputTitle4;
  $sql.=",".TABLE_MOD_DISEASE."_content4=? ";           $arSQLData[]=$inputHTML4;
	$sql.=",".TABLE_MOD_DISEASE."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_DISEASE."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=" WHERE ".TABLE_MOD_DISEASE."_id=? ";        $arSQLData[]=$myID;
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