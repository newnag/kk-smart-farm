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
    $sql =" SELECT * FROM ".TABLE_MOD_NOTI." JOIN ".TABLE_MOD_USERFARM." ON ".TABLE_MOD_USERFARM."_id = ".TABLE_MOD_NOTI."_userID  WHERE ".TABLE_MOD_NOTI."_ID=? "; $arSQLData[]=$myID;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
    $Rows=$Query->fetchAll();
    $Row=$Rows[0];
    $dataQ = array();
    $dataQ["id"] = $Row[TABLE_MOD_NOTI."_id"];
    $dataQ["fullname"] = $Row[TABLE_MOD_USERFARM."_fullname"];
    $dataQ["text"] = $Row[TABLE_MOD_NOTI."_text"];
  
    $counter++;
    
  } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Result"]=$dataQ;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>