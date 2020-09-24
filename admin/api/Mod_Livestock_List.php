<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Predefine
#-------------------------------------------------------------------
if($SendRequest["inputShowOrderBy"]=="") { $SendRequest["inputShowOrderBy"]="ID"; }
if($SendRequest["inputShowPage"]>0) { } else { $SendRequest["inputShowPage"]=1; }
if($SendRequest["inputShowPageSize"]>0) { } else { $SendRequest["inputShowPageSize"]=CONFIG_DEFAULT_PAGESIZE; }
$recstart=($SendRequest["inputShowPage"]-1)*$SendRequest["inputShowPageSize"];
$arDataList=array(); $DataRow=array(); $DataHeader=array();


#-------------------------------------------------------------------
# SQL Injection Protect 
#-------------------------------------------------------------------
$arCheck=array("Enable","Disable","Deleted");
if(!in_array($SendRequest["inputShowStatus"],$arCheck)) { $SendRequest["inputShowStatus"]="Enable"; }
$arCheck=array("ID","LastLoginDate","farmname");
if(!in_array($SendRequest["inputShowOrderBy"],$arCheck)) { $SendRequest["inputShowOrderBy"]="ID"; }
$arCheck=array("ASC","DESC");
if(!in_array($SendRequest["inputShowASCDESC"],$arCheck)) { $SendRequest["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

  $filterFarm = $SendRequest["inputFamrSelect"];
  
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


//print_r($arrdataF);
//exit();


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
if($SendRequest["inputFamrSelect"]==""){
  try {
    $arSQLData=array();
    $sql =" SELECT * FROM ".TABLE_MOD_LIVESTOCK." JOIN ".TABLE_MOD_FARM." ON ".TABLE_MOD_FARM."_id = ".TABLE_MOD_LIVESTOCK."_farmID   WHERE ".TABLE_MOD_LIVESTOCK."_Status<>'Deleted'" ;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
    while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
      $dataQ = array();
      $dataQ["id"] = $Row[TABLE_MOD_LIVESTOCK."_id"];
      $dataQ["name"]=$Row[TABLE_MOD_LIVESTOCK."_name"] ;
      $dataQ["type"]=$Row[TABLE_MOD_LIVESTOCK."_type"] ;
      $dataQ["gene"]=$Row[TABLE_MOD_LIVESTOCK."_gene"] ;
      $dataQ["microchip"]=$Row[TABLE_MOD_LIVESTOCK."_microchipNo"] ;
      $dataQ["farmID"]=$Row[TABLE_MOD_LIVESTOCK."_farmID"] ;
      $dataQ["farmName"]=$Row[TABLE_MOD_FARM."_name"] ;
      $dataQ["DOB"]=$Row[TABLE_MOD_LIVESTOCK."_DOB"] ;
      $dataQ["age"]=$Row[TABLE_MOD_LIVESTOCK."_age"] ;
      $dataQ["sex"]=$Row[TABLE_MOD_LIVESTOCK."_sex"] ;
      $dataQ["weight"]=$Row[TABLE_MOD_LIVESTOCK."_weight"] ;
      $dataQ["healthStatus"]=$Row[TABLE_MOD_LIVESTOCK."_healthStatus"] ;
      if($Row[TABLE_MOD_LIVESTOCK."_thumbnail"]<>"") {
        $dataQ["thumbnail"]=SYSTEM_FULLPATH_UPLOAD."mod_livestock/".$Row[TABLE_MOD_LIVESTOCK."_thumbnail"];
      } else {
        $dataQ["thumbnail"]=CONFIG_DEFAULT_THUMB_USER;
      }
  
      $arrdataQ[] = $dataQ;
    }
  } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}
else{
  try {
    $arSQLData=array();
    $sql =" SELECT * FROM ".TABLE_MOD_LIVESTOCK." WHERE ".TABLE_MOD_LIVESTOCK."_farmID=? AND ".TABLE_MOD_LIVESTOCK."_Status<>'Deleted'" ; $arSQLData[]=$filterFarm;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
    while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
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
      $dataQ["thumbnail"]=$Row[TABLE_MOD_LIVESTOCK."_thumbnail"] ;
  
      $arrdataQ[] = $dataQ;
    }
  } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}



$DataHeader["Total"] = count($arrdataQ) ;

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Header"]=$DataHeader;
  $Result["Result"]=$arrdataQ;
  $Result["ResultF"]=$arrdataF;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>