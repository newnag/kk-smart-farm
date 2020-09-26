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

if($myID == ""){
  $ErrorMessage = "กรุณากรอก User";
}

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

try {
  $counter=0; $arSQLData=array();
  $sql =" SELECT * FROM ".TABLE_MOD_USERFARM." WHERE ".TABLE_MOD_USERFARM."_ID=? "; $arSQLData[]=$myID;
  $Query=$System_Connection->prepare($sql);
  if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
  $Rows=$Query->fetchAll();
  $Row=$Rows[0];
  if($Row[TABLE_MOD_USERFARM."_id"] == $myID){
    $dataQ = array();
    $dataQ["id"] = $Row[TABLE_MOD_USERFARM."_id"];
    $dataQ["email"]="ส่งรหัสผ่านชั่วคราวไปที่ ".$Row[TABLE_MOD_USERFARM."_email"]." เรียบร้อยแล้ว" ;
    $dataQ["pass"]= generateRandomString();
    $counter++;
  }
  else{
    $ErrorMessage = "ไม่มี User นี้";
  }
  
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