<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Input
#-------------------------------------------------------------------
$inputID = trim(urldecode($SendRequest['inputID']));
$inputIDList = trim(urldecode($SendRequest['inputIDList']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
$arID=array();
if($inputID>0) {
	$arID[]=$inputID;
} else {
	$arID=explode(",",$inputIDList);
}
for($i=0;$i<=sizeof($arID);$i++) {
	$myID=$arID[$i];
	if($myID>0) {
		try {
			$arSQLData=array();
			$sql =" UPDATE ".TABLE_MOD_BANNERHERO." SET "; 
			$sql.=" ".TABLE_MOD_BANNERHERO."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
			$sql.=",".TABLE_MOD_BANNERHERO."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
			$sql.=",".TABLE_MOD_BANNERHERO."_Status=? ";          $arSQLData[]="Deleted";
			$sql.=" WHERE ".TABLE_MOD_BANNERHERO."_ID=? ";        $arSQLData[]=$myID;
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
	}
}

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "แก้ไขข้อมูลสำเร็จ";
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>