<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputName = trim(urldecode($SendRequest['inputName']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
    $DataField=array(); $arSQLData=array();
    $sqla =" INSERT INTO ".TABLE_MOD_TREATMENT."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
    $sqla.=" ".TABLE_MOD_TREATMENT."_name ";          $sqlb.=" ? ";         $arSQLData[]=$inputName;
    $sqla.=",".TABLE_MOD_TREATMENT."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
    $sqla.=",".TABLE_MOD_TREATMENT."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
    $sqla.=",".TABLE_MOD_TREATMENT."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
    $sqla.=",".TABLE_MOD_TREATMENT."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
    $sqla.=",".TABLE_MOD_TREATMENT."_status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
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