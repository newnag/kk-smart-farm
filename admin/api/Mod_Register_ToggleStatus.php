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
	$sql =" SELECT * FROM ".TABLE_MOD_REGISTER." WHERE ".TABLE_MOD_REGISTER."_ID=? "; $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
	if($Row[TABLE_MOD_REGISTER."_Status"]=="Enable") {
		$NewStatus="Disable";
	} else {
		$NewStatus="Enable";
	}
	##----------------------------------------
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_REGISTER." SET "; 
	$sql.=" ".TABLE_MOD_REGISTER."_Status=? ";          $arSQLData[]=$NewStatus;
	$sql.=" WHERE ".TABLE_MOD_REGISTER."_ID=? ";        $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	##----------------------------------------
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	if($NewStatus=="Enable") {
		$Result["Result"]='<span class="badge bg-success"> เปิดใช้งาน </span>';
	}
	if($NewStatus=="Disable") {
		$Result["Result"]='<span class="badge bg-warning"> ปิดใช้งาน </span>';
	}
} else {
	$Result["Status"] = "Error";
}

?>