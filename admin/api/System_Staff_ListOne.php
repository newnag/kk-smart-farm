<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$myID = trim(urldecode($SendRequest['inputID']))*1;

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$counter=0; $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_ID=? "; $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
	$DataField=array();
	$DataField["ID"]=$Row[TABLE_SYSTEM_STAFF."_ID"];
	$DataField["User"]=$Row[TABLE_SYSTEM_STAFF."_User"];
	$DataField["Phone"]=$Row[TABLE_SYSTEM_STAFF."_Phone"];
	if($Row[TABLE_SYSTEM_STAFF."_Picture"]<>"") {
		$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."system_staff/".$Row[TABLE_SYSTEM_STAFF."_Picture"];
	} else {
		$DataField["Picture"]=CONFIG_DEFAULT_THUMB_USER;
	}
	$DataField["Email"]=$Row[TABLE_SYSTEM_STAFF."_Email"];
	$DataField["Level"]=$Row[TABLE_SYSTEM_STAFF."_Level"];
	//$DataField["StaffGroupID"]=$Row[TABLE_SYSTEM_STAFF."_StaffGroupID"];
	$DataField["Status"]=$Row[TABLE_SYSTEM_STAFF."_Status"];
	$counter++;
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Result"]=$DataField;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>