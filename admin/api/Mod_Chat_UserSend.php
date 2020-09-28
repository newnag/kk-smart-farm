<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputUserID = trim(urldecode($SendRequest['inputID']));
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
    $sqla.=" ".TABLE_MOD_CHAT."_userID ";          $sqlb.=" ? ";         $arSQLData[]=$inputUserID;
    $sqla.=",".TABLE_MOD_CHAT."_subjectID ";          $sqlb.=",? ";         $arSQLData[]=$myID;
    $sqla.=",".TABLE_MOD_CHAT."_text ";          $sqlb.=",? ";         $arSQLData[]=$inputText;
    $sqla.=",".TABLE_MOD_CHAT."_status ";          $sqlb.=",? ";         $arSQLData[]="user";
    $sqla.=",".TABLE_MOD_CHAT."_date ";    $sqlb.=",? ";         $arSQLData[]=date("h:i");
    $sql=$sqla.$sqlb.$sqlc;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
    $myInsertID = $System_Connection->lastInsertId();
    $DataField["InsertID"]=$myInsertID; 
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


$arSQLDataA=array();
$sql =" SELECT * FROM ".TABLE_MOD_CHATHEAD." WHERE ".TABLE_MOD_CHATHEAD."_id=? "; $arSQLDataA[]=$myID;
$Query=$System_Connection->prepare($sql);
if(sizeof($arSQLDataA)>0) { $Query->execute($arSQLDataA);  } else { $Query->execute(); }	
$Rows=$Query->fetchAll();
$Row=$Rows[0];

$unRead = $Row[TABLE_MOD_CHATHEAD."_unread"];


try {
  $arSQLDataB=array();
  $sql =" UPDATE ".TABLE_MOD_CHATHEAD." SET "; 
  $sql.=" ".TABLE_MOD_CHATHEAD."_unread=? ";     $arSQLDataB[]= $unRead+1 ;
  $sql.=" WHERE ".TABLE_MOD_CHATHEAD."_id=? ";        $arSQLDataB[]=$myID;
  $Query=$System_Connection->prepare($sql);
  if(sizeof($arSQLDataB)>0) { $Query->execute($arSQLDataB);  } else { $Query->execute(); }	
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