<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputCateName = trim(urldecode($SendRequest['inputCateName']));
$inputSubName = trim(urldecode($SendRequest['inputSubName']));
$inputChoice = trim(urldecode($SendRequest['inputChoice']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));
#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
$str1 = explode("/",$inputCateName);
$str2 = explode("/",$inputSubName);

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
    $DataField=array(); $arSQLData=array();
    $sqla =" INSERT INTO ".TABLE_MOD_CHOICE."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
    $sqla.=" ".TABLE_MOD_CHOICE."_name ";          $sqlb.=" ? ";         $arSQLData[]=$inputChoice;
    $sqla.=",".TABLE_MOD_CHOICE."_cateID ";          $sqlb.=",? ";         $arSQLData[]=$str1[0];
    $sqla.=",".TABLE_MOD_CHOICE."_cateName ";          $sqlb.=",? ";         $arSQLData[]=$str1[1];
    $sqla.=",".TABLE_MOD_CHOICE."_subID ";          $sqlb.=",? ";         $arSQLData[]=$str2[0];
    $sqla.=",".TABLE_MOD_CHOICE."_subName ";          $sqlb.=",? ";         $arSQLData[]=$str2[1];
    $sqla.=",".TABLE_MOD_CHOICE."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
    $sqla.=",".TABLE_MOD_CHOICE."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
    $sqla.=",".TABLE_MOD_CHOICE."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
    $sqla.=",".TABLE_MOD_CHOICE."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
    $sqla.=",".TABLE_MOD_CHOICE."_status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
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