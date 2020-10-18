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
# PROCESS Email Send
#-------------------------------------------------------------------

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/mailer/Exception.php';
require '../lib/mailer/PHPMailer.php';
require '../lib/mailer/SMTP.php';

$fm = "smartfarm@mg.gramickhouse.com"; // *** ต้องใช้อีเมล์ @yourdomain.com เท่านั้น  ***
$to = $Row[TABLE_MOD_USERFARM."_email"]; // อีเมล์ที่ใช้รับข้อมูลจากแบบฟอร์ม
 
$mail = new PHPMailer();
$mail->CharSet = "utf-8"; 
 
/* ------------------------------------------------------------------------------------------------------------- */
/* ตั้งค่าการส่งอีเมล์ โดยใช้ SMTP ของ โฮสต์ */
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;
//$mail->SMTPSecure = 'ssl'; // บรรทัดนี้ ให้ Uncomment ไว้ เพราะ Mail Server ของโฮสต์ ไม่รองรับ SSL.
$mail->Host = "smtp.mailgun.org"; //ใส่ SMTP Mail Server ของท่าน
$mail->Port = "25"; // หมายเลข Port สำหรับส่งอีเมล์
$mail->Username = "smartfarm@mg.gramickhouse.com"; //ใส่ Email Username ของท่าน (ที่ Add ไว้แล้วใน Plesk Control Panel)
$mail->Password = "90ced6272a317273471c7911a5cafe1e-2fbe671d-e2bcf2e3"; //ใส่ Password ของอีเมล์ (รหัสผ่านของอีเมล์ที่ท่านตั้งไว้) 
/* ------------------------------------------------------------------------------------------------------------- */
 
$mail->From = $fm;
$mail->AddAddress($to);
$mail->Subject = 'รหัสผ่านชั่วคราวของคุณ จากแอพ SmartFarm';
$mail->Body     = 'รหัสผ่านชั่วคราวของคุณคือ '.$dataQ["pass"];
$mail->WordWrap = 50;  
//
if(!$mail->Send()) {
  $ErrorMessage = 'ยังไม่สามารถส่งเมลล์ได้ในขณะนี้';
}

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

$transPass = hash('sha256',SYSTEM_AUTHEN_KEY.$dataQ["pass"].SYSTEM_AUTHEN_KEY);

try {
  $arSQLData=array();
  $sql =" UPDATE ".TABLE_MOD_USERFARM." SET "; 
  $sql.=" ".TABLE_MOD_USERFARM."_password=? ";        $arSQLData[]=$transPass;
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