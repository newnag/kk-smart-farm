<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputChoice = trim(urldecode($SendRequest['inputChoice']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_RUTCHOICE." SET "; 
	$sql.=" ".TABLE_MOD_RUTCHOICE."_name=? ";           $arSQLData[]=$inputChoice;
	$sql.=",".TABLE_MOD_RUTCHOICE."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_RUTCHOICE."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=" WHERE ".TABLE_MOD_RUTCHOICE."_id=? ";        $arSQLData[]=$myID;
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