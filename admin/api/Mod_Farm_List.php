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
$arCheck=array("ID","LastLoginDate","User");
if(!in_array($SendRequest["inputShowOrderBy"],$arCheck)) { $SendRequest["inputShowOrderBy"]="ID"; }
$arCheck=array("ASC","DESC");
if(!in_array($SendRequest["inputShowASCDESC"],$arCheck)) { $SendRequest["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
  $sql =" SELECT * FROM ".TABLE_MOD_FARM." WHERE ".TABLE_MOD_FARM."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataQ = array();
    $dataQ["id"] = $Row[TABLE_MOD_FARM."_id"];
    $dataQ["name"]=$Row[TABLE_MOD_FARM."_name"] ;
    $dataQ["ownerID"]=$Row[TABLE_MOD_FARM."_ownerID"] ;
    $dataQ["owner"]=$Row[TABLE_MOD_FARM."_owner"] ;
    $dataQ["tel"]=$Row[TABLE_MOD_FARM."_tel"] ;
    $dataQ["pinlat"]=$Row[TABLE_MOD_FARM."_pinlat"] ;
    $dataQ["pinlon"]=$Row[TABLE_MOD_FARM."_pinlon"] ;
    $dataQ["qty"]=$Row[TABLE_MOD_FARM."_qtyLivestock"] ;
    $dataQ["address"]=$Row[TABLE_MOD_FARM."_address"] ;
    $dataQ["province"]=$Row[TABLE_MOD_FARM."_province"] ;
    $dataQ["district"]=$Row[TABLE_MOD_FARM."_district"] ;
    $dataQ["subdistrict"]=$Row[TABLE_MOD_FARM."_subdistrict"] ;
    $dataQ["postcode"]=$Row[TABLE_MOD_FARM."_postcode"]  ;
    if($Row[TABLE_MOD_FARM."_thumbnail"]<>"") {
      $dataQ["thumbnail"]=SYSTEM_FULLPATH_UPLOAD."mod_farm/".$Row[TABLE_MOD_FARM."_thumbnail"];
    } else {
      $dataQ["thumbnail"]=CONFIG_DEFAULT_THUMB_USER;
    }

    $arrdataQ[] = $dataQ;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


$DataHeader["Total"] = count($arrdataQ) ;

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Header"]=$DataHeader;
	$Result["Result"]=$arrdataQ;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>