<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$myID = trim(urldecode($SendRequest['inputID']))*1;

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
  $counter=0; $arSQLData=array();
    $sql =" SELECT * FROM ".TABLE_MOD_THUMBNAIL." JOIN ".TABLE_MOD_SUBCATEGORY." ON ".TABLE_MOD_SUBCATEGORY."_id = ".TABLE_MOD_THUMBNAIL."_subID  WHERE ".TABLE_MOD_THUMBNAIL."_ID=? "; $arSQLData[]=$myID ;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
    $dataQ = array();
    $dataQ["id"] = $Row[TABLE_MOD_THUMBNAIL."_id"] ;
    $dataQ["subID"]=$Row[TABLE_MOD_THUMBNAIL."_subID"] ;
    $dataQ["subName"]=$Row[TABLE_MOD_SUBCATEGORY."_name"] ;
    if($Row[TABLE_MOD_THUMBNAIL."_picture"]<>"") {
        $dataQ["thumbnail"]=SYSTEM_FULLPATH_UPLOAD."mod_thumbnail/".$Row[TABLE_MOD_THUMBNAIL."_picture"];
    } else {
        $dataQ["thumbnail"]=CONFIG_DEFAULT_THUMB_USER;
    }
    $counter++;
  
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

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