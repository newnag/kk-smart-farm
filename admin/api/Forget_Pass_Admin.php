<?php

include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");

#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputEmail = ($_GET["inputEmail"]);

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------


$arSQLDataA=array();
$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_Email=? "; $arSQLDataA[]=$inputEmail;
$Query=$System_Connection->prepare($sql);
if(sizeof($arSQLDataA)>0) { $Query->execute($arSQLDataA);  } else { $Query->execute(); }	
$Rows=$Query->fetchAll();
$Row=$Rows[0];

if($Row[TABLE_SYSTEM_STAFF."_Email"] != $inputEmail){
  echo 'ไม่มี User นี้';
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

$randomPass = generateRandomString();


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

$inputPass = hash('sha256',SYSTEM_AUTHEN_KEY.$randomPass.SYSTEM_AUTHEN_KEY);



try {
  $arSQLData=array();
  $sql =" UPDATE ".TABLE_SYSTEM_STAFF." SET "; 
  $sql.=" ".TABLE_SYSTEM_STAFF."_Pass=? ";        $arSQLData[]=$inputPass;
  $sql.=" WHERE ".TABLE_SYSTEM_STAFF."_Email=? ";        $arSQLData[]=$inputEmail;
  $Query=$System_Connection->prepare($sql);
  if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); echo 'ผิดพลาดดึงข้อมูลไม่ได้'; }


###################################################

//RESULT:---------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
  $Result["Message"] = "แก้ไขข้อมูลสำเร็จ";
  echo '<p style="text-align:center">รหัสผ่านชั่วคราวของคุณคือ '.$randomPass.'</p>';
  echo '<br>';
  echo '<div style="text-align:center">';
  echo '<button onclick="redirect()">ย้อนกลับหน้าแรก</button>';
  echo '</div>';

} else {
	$Result["Status"] = "Error";
  $Result["Message"] = $ErrorMessage;
  echo 'ผิดพลาด';
}

?>

<script>
  function redirect(){
    window.location.href = `http://kk.getdev.top/smartfarm/admin`;
  }
</script>