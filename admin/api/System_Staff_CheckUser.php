<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Input
#-------------------------------------------------------------------
$inputUser = trim(urldecode($SendRequest['inputUser']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT ".TABLE_SYSTEM_STAFF."_ID FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_User = ? LIMIT 0,1 "; $arSQLData[]=$inputUser;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$myID=$Rows[0][TABLE_SYSTEM_STAFF."_ID"]*1;
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($myID>0) { // error existed!
	$Result["Status"] = "NO";
} else { // ok
	$Result["Status"] = "OK";
}

?>