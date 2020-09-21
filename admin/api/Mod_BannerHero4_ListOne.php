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
	$sql =" SELECT * FROM ".TABLE_MOD_BANNERHERO4." WHERE ".TABLE_MOD_BANNERHERO4."_ID=? "; $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
	$DataField=array();
	$DataField["ID"]=$Row[TABLE_MOD_BANNERHERO4."_ID"];
	$DataField["Name"]=$Row[TABLE_MOD_BANNERHERO4."_Name"];
	if($Row[TABLE_MOD_BANNERHERO4."_Picture"]<>"") {
		$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_bannerhero4/".$Row[TABLE_MOD_BANNERHERO4."_Picture"];
		$DataField["Picture-Thumb"]=SYSTEM_FULLPATH_UPLOAD."mod_bannerhero4/thumb-".$Row[TABLE_MOD_BANNERHERO4."_Picture"];
	} else {
		$DataField["Picture"]=CONFIG_DEFAULT_THUMB_PICTURE;
		$DataField["Picture-Thumb"]=CONFIG_DEFAULT_THUMB_PICTURE;
	}
	$DataField["Status"]=$Row[TABLE_MOD_BANNERHERO4."_Status"];
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