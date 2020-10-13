<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$Email = trim(urldecode($SendRequest['inputEmail']));

if($Email == ""){
  $ErrorMessage = "กรุณากรอก Email";
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
  $sql =" SELECT * FROM ".TABLE_MOD_USERFARM." WHERE ".TABLE_MOD_USERFARM."_email=? "; $arSQLData[]=$Email;
  $Query=$System_Connection->prepare($sql);
  if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
  $Rows=$Query->fetchAll();
  $Row=$Rows[0];
  if($Row[TABLE_MOD_USERFARM."_email"] == $Email){
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
# PROCESS
#-------------------------------------------------------------------

try {
  $arSQLData=array();
  $sql =" UPDATE ".TABLE_MOD_USERFARM." SET "; 
  $sql.=" ".TABLE_MOD_USERFARM."_password=? ";        $arSQLData[]=$dataQ["pass"];
  $sql.=" WHERE ".TABLE_MOD_USERFARM."_email=? ";        $arSQLData[]=$Row[TABLE_MOD_USERFARM."_email"];
  $Query=$System_Connection->prepare($sql);
  if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); echo 'ผิดพลาดดึงข้อมูลไม่ได้'; }


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