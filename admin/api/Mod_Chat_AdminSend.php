<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputID = trim(urldecode($SendRequest['inputID']));
$inputText = trim(urldecode($SendRequest['inputText']));
if($SendRequest['inputText'] == ""){
    $inputText = '<img src="'.SYSTEM_FULLPATH_UPLOAD."mod_chat/".$SendRequest['inputPicture'].'">';
}
$myID = trim(urldecode($SendRequest['myID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
    $DataField=array(); $arSQLData=array();
    $sqla =" INSERT INTO ".TABLE_MOD_CHAT."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
    $sqla.=" ".TABLE_MOD_CHAT."_userID ";          $sqlb.=" ? ";         $arSQLData[]=$myID;
    $sqla.=",".TABLE_MOD_CHAT."_subjectID ";          $sqlb.=",? ";         $arSQLData[]=$inputID;
    $sqla.=",".TABLE_MOD_CHAT."_text ";          $sqlb.=",? ";         $arSQLData[]=$inputText;
    $sqla.=",".TABLE_MOD_CHAT."_status ";          $sqlb.=",? ";         $arSQLData[]="admin";
    $sqla.=",".TABLE_MOD_CHAT."_date ";    $sqlb.=",? ";         $arSQLData[]=date("h:i");
    $sql=$sqla.$sqlb.$sqlc;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
    $myInsertID = $System_Connection->lastInsertId();
    $DataField["InsertID"]=$myInsertID; 
    $DataField["userID"]=$myID; 
    $DataField["subject"]=$inputID; 
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