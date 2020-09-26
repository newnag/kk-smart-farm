<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputUserID = trim(urldecode($SendRequest['inputuserID']));
$inputAdminID = trim(urldecode($SendRequest['inputAdminID']));
$inputText = trim(urldecode($SendRequest['inputText']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

if($inputText == ""){
    $ErrorMessage = "กรุณาใส่ข้อความ";
}

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
    $DataField=array(); $arSQLData=array();
    $sqla =" INSERT INTO ".TABLE_MOD_CHAT."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
    $sqla.=" ".TABLE_MOD_CHAT."_userID ";          $sqlb.=" ? ";         $arSQLData[]=$inputUserID;
    $sqla.=",".TABLE_MOD_CHAT."_adminID ";          $sqlb.=",? ";         $arSQLData[]=$inputAdminID;
    $sqla.=",".TABLE_MOD_CHAT."_text ";          $sqlb.=",? ";         $arSQLData[]=$inputText;
    $sqla.=",".TABLE_MOD_CHAT."_status ";          $sqlb.=",? ";         $arSQLData[]="ผู้ส่ง:เกษตรกร";
    $sqla.=",".TABLE_MOD_CHAT."_date ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
    $sql=$sqla.$sqlb.$sqlc;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
    $myInsertID = $System_Connection->lastInsertId();
    $DataField["InsertID"]=$myInsertID; 
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "เพิ่มข้อมูลสำเร็จ";
	$Result["Result"] = $DataField;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>