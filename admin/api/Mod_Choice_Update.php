<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputChoice = trim(urldecode($SendRequest['inputChoice']));
$inputCateName = trim(urldecode($SendRequest['inputCateName']));
$inputSubName = trim(urldecode($SendRequest['inputSubName']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
$arrList1 = explode("/",$inputCateName);
$arrList2 = explode("/",$inputSubName);
//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_CHOICE." SET "; 
	$sql.=" ".TABLE_MOD_CHOICE."_name=? ";           $arSQLData[]=$inputChoice;
	if($inputCateName<>"") {
        $sql.=",".TABLE_MOD_CHOICE."_cateID=? ";           $arSQLData[]=$arrList1[0];
        $sql.=",".TABLE_MOD_CHOICE."_cateName=? ";           $arSQLData[]=$arrList1[1];
    }
    if($inputSubName<>""){
        $sql.=",".TABLE_MOD_CHOICE."_subID=? ";           $arSQLData[]=$arrList2[0];
        $sql.=",".TABLE_MOD_CHOICE."_subName=? ";           $arSQLData[]=$arrList2[1];
    }
	$sql.=",".TABLE_MOD_CHOICE."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_CHOICE."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=" WHERE ".TABLE_MOD_CHOICE."_id=? ";        $arSQLData[]=$myID;
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