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

$filterFarm = $SendRequest["inputFARM"];
  
try{
  $counter=0; $arSQLData=array();
  $sql =" SELECT * FROM ".TABLE_MOD_FARM." WHERE ".TABLE_MOD_FARM."_ID=? "; $arSQLData[]=$filterFarm;
  $Query=$System_Connection->prepare($sql);
  if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
  $Rows=$Query->fetchAll();
  $Row=$Rows[0];
  $arrdataF = array();
  $arrdataF["id"] = $Row[TABLE_MOD_FARM."_id"];
  $arrdataF["name"]=$Row[TABLE_MOD_FARM."_name"] ;
  $counter++;
}catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
  $counter=0; $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_MOD_LIVESTOCK." WHERE ".TABLE_MOD_LIVESTOCK."_ID=? "; $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
  $dataQ = array();
  $dataQ["id"] = $Row[TABLE_MOD_LIVESTOCK."_id"];
  $dataQ["name"]=$Row[TABLE_MOD_LIVESTOCK."_name"] ;
  $dataQ["type"]=$Row[TABLE_MOD_LIVESTOCK."_type"] ;
  $dataQ["gene"]=$Row[TABLE_MOD_LIVESTOCK."_gene"] ;
  $dataQ["microchip"]=$Row[TABLE_MOD_LIVESTOCK."_microchipNo"] ;
  $dataQ["farmID"]=$Row[TABLE_MOD_LIVESTOCK."_farmID"] ;
  $dataQ["farmName"]=$arrdataF["name"];
  $dataQ["DOB"]=$Row[TABLE_MOD_LIVESTOCK."_DOB"] ;
  $dataQ["age"]=$Row[TABLE_MOD_LIVESTOCK."_age"] ;
  $dataQ["sex"]=$Row[TABLE_MOD_LIVESTOCK."_sex"] ;
  $dataQ["weight"]=$Row[TABLE_MOD_LIVESTOCK."_weight"] ;
  $dataQ["healthStatus"]=$Row[TABLE_MOD_LIVESTOCK."_healthStatus"] ;
  if($Row[TABLE_MOD_LIVESTOCK."_thumbnail"]<>"") {
		$dataQ["thumbnail"]=SYSTEM_FULLPATH_UPLOAD."mod_userfarm/".$Row[TABLE_MOD_LIVESTOCK."_thumbnail"];
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