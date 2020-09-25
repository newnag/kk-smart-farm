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
	$sql =" SELECT * FROM ".TABLE_MOD_USERFARM." WHERE ".TABLE_MOD_USERFARM."_ID=? "; $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
  $dataQ = array();
  $dataQ["id"] = $Row[TABLE_MOD_USERFARM."_id"];
  $dataQ["fullname"]=$Row[TABLE_MOD_USERFARM."_fullname"] ;
  $dataQ["lastname"]=$Row[TABLE_MOD_USERFARM."_lastname"] ;
  $dataQ["tel"]=$Row[TABLE_MOD_USERFARM."_tel"] ;
  $dataQ["email"]=$Row[TABLE_MOD_USERFARM."_email"] ;
  $dataQ["sex"]=$Row[TABLE_MOD_USERFARM."_sex"] ;
  $dataQ["DOB"]=$Row[TABLE_MOD_USERFARM."_DOB"] ;
  $dataQ["idNo"]=$Row[TABLE_MOD_USERFARM."_id_No"] ;
  $dataQ["address"]=$Row[TABLE_MOD_USERFARM."_address"] ;
  $dataQ["province"]=$Row[TABLE_MOD_USERFARM."_province"] ;
  $dataQ["district"]=$Row[TABLE_MOD_USERFARM."_district"] ;
  $dataQ["subdistrict"]=$Row[TABLE_MOD_USERFARM."_subdistrict"] ;
  $dataQ["postcode"]=$Row[TABLE_MOD_USERFARM."_postcode"]  ;
  if($Row[TABLE_MOD_USERFARM."_thumbnail"]<>"") {
		$dataQ["thumbnail"]=SYSTEM_FULLPATH_UPLOAD."mod_userfarm/".$Row[TABLE_MOD_USERFARM."_thumbnail"];
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