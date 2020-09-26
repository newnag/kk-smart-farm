<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputPass = trim(urldecode($SendRequest['inputPass']));


if($myID == ""){
  $ErrorMessage = "กรุณาใส่ ID User";
}
if($inputPass == ""){
  $ErrorMessage = "กรุณาใส่ Password";
}

//PROCESS:----------------------------------------
###################################################

$arSQLDataA=array();
$sql =" SELECT * FROM ".TABLE_MOD_USERFARM." WHERE ".TABLE_MOD_USERFARM."_ID=? "; $arSQLDataA[]=$myID;
$Query=$System_Connection->prepare($sql);
if(sizeof($arSQLDataA)>0) { $Query->execute($arSQLDataA);  } else { $Query->execute(); }	
$Rows=$Query->fetchAll();
$Row=$Rows[0];

if($Row[TABLE_MOD_USERFARM."_id"] != $myID){
	$ErrorMessage = "ไม่มี User นี้";
}

//PROCESS:----------------------------------------
###################################################
$inputPass=hash('sha256',SYSTEM_AUTHEN_KEY.$inputPass.SYSTEM_AUTHEN_KEY);

try {
  $arSQLData=array();
  $sql =" UPDATE ".TABLE_MOD_USERFARM." SET "; 
  $sql.=" ".TABLE_MOD_USERFARM."_password=? ";        $arSQLData[]=$inputPass;
  $sql.=" WHERE ".TABLE_MOD_USERFARM."_id=? ";        $arSQLData[]=$myID;
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