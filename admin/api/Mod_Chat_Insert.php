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
$inputSubject = trim(urldecode($SendRequest['inputSubject']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

if($inputSubject == ""){
    $ErrorMessage = "กรุณาใส่ข้อความ";
}

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

try {
    $DataField=array(); $arSQLData=array();
    $sqla =" INSERT INTO ".TABLE_MOD_CHATHEAD."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
    $sqla.=" ".TABLE_MOD_CHATHEAD."_userID ";          $sqlb.=" ? ";         $arSQLData[]=$inputUserID;
    $sqla.=",".TABLE_MOD_CHATHEAD."_subject ";          $sqlb.=",? ";         $arSQLData[]=$inputSubject;
    $sqla.=",".TABLE_MOD_CHATHEAD."_unread ";          $sqlb.=",? ";         $arSQLData[]= 0 ;
    $sqla.=",".TABLE_MOD_CHATHEAD."_Status ";          $sqlb.=",? ";         $arSQLData[]="Enable";
    $sqla.=",".TABLE_MOD_CHATHEAD."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
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
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>