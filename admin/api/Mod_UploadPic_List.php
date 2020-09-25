<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Pre
#-------------------------------------------------------------------
$inputUser = trim(urldecode($SendRequest['inputUser']));


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$sql =" SELECT * FROM ".TABLE_MOD_UPLOADPIC." WHERE ".TABLE_MOD_UPLOADPIC."_userID = ".$inputUser ;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataC = array();
    $dataC["id"] = $Row[TABLE_MOD_UPLOADPIC."_id"];
    $dataC["image"]=$Row[TABLE_MOD_UPLOADPIC."_image"] ;
    $dataQ["image"]=SYSTEM_FULLPATH_UPLOAD."mod_upload/".$Row[TABLE_MOD_UPLOADPIC."_image"];
    $dataC["date"]=$Row[TABLE_MOD_UPLOADPIC."_date"] ;
    $dataC["user"]=$Row[TABLE_MOD_UPLOADPIC."_userID"] ;

    $arrC[] = $dataC;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
    $Result["Result"]=$arrC;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>