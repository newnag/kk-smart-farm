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
$arCheck=array("ID","LastLoginDate","User","Order");
if(!in_array($SendRequest["inputShowOrderBy"],$arCheck)) { $SendRequest["inputShowOrderBy"]="ID"; }
$arCheck=array("ASC","DESC");
if(!in_array($SendRequest["inputShowASCDESC"],$arCheck)) { $SendRequest["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# Predefine - Staff Information
#-------------------------------------------------------------------
try {
	$arUserNameByID=array();
	$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_Status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); };
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$arUserNameByID[$Row[TABLE_SYSTEM_STAFF."_ID"]]=$Row[TABLE_SYSTEM_STAFF."_User"];
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT COUNT(*) AS Counter FROM ".TABLE_SYSTEM_STAFF_GROUP." WHERE ".TABLE_SYSTEM_STAFF_GROUP."_Status<>'Deleted' ";
	if($SendRequest["inputShowSearch"]<>"") {
		$sql.=" AND ( ".TABLE_SYSTEM_STAFF_GROUP."_CodeName LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
		$sql.=" OR ".TABLE_SYSTEM_STAFF_GROUP."_Name LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
		$sql.=" ) ";
	}
	if($SendRequest["inputShowStatus"]<>"") {
		$sql.=" AND ".TABLE_SYSTEM_STAFF_GROUP."_Status= ? "; $arSQLData[]=''.$SendRequest["inputShowStatus"].'';
	}
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$totalrecord=$Rows[0]["Counter"];
	if($totalrecord>0) { $maxpage=ceil($totalrecord/$SendRequest["inputShowPageSize"]); } else { $maxpage=1; }
	$DataHeader["Page"]=$SendRequest["inputShowPage"];
	$DataHeader["PageSize"]=$SendRequest["inputShowPageSize"];
	$DataHeader["MaxPage"]=$maxpage;
	$DataHeader["TotalRecord"]=$totalrecord;
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$counter=0; $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF_GROUP." WHERE ".TABLE_SYSTEM_STAFF_GROUP."_Status<>'Deleted' ";
	if($SendRequest["inputShowSearch"]<>"") {
		$sql.=" AND ( ".TABLE_SYSTEM_STAFF_GROUP."_CodeName LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
		$sql.=" OR ".TABLE_SYSTEM_STAFF_GROUP."_Name LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
		$sql.=" ) ";
	}
	if($SendRequest["inputShowStatus"]<>"") {
		$sql.=" AND ".TABLE_SYSTEM_STAFF_GROUP."_Status= ? "; $arSQLData[]=''.$SendRequest["inputShowStatus"].'';
	}
	$sql.=" ORDER BY ".TABLE_SYSTEM_STAFF_GROUP."_".$SendRequest["inputShowOrderBy"]." ".$SendRequest["inputShowASCDESC"];
	$sql.=" LIMIT ".$recstart.",".$SendRequest["inputShowPageSize"]." ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$DataField=array();
		$DataField["ID"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_ID"];
		$DataField["CodeName"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_CodeName"];
		$DataField["Name"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_Name"];
		$DataField["Order"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_Order"];
		$DataField["CreateDate"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_CreateDate"];
		$DataField["CreateByID"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_CreateByID"];
		$DataField["CreateByName"]=$arUserNameByID[$Row[TABLE_SYSTEM_STAFF_GROUP."_CreateByID"]];
		$DataField["LastUpdate"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_LastUpdate"];
		$DataField["LastUpdateByID"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_LastUpdateByID"];
		$DataField["LastUpdateByName"]=$arUserNameByID[$Row[TABLE_SYSTEM_STAFF_GROUP."_LastUpdateByID"]];
		$DataField["Status"]=$Row[TABLE_SYSTEM_STAFF_GROUP."_Status"];
		$DataRow[]=$DataField;
		$counter++;
	}
	$DataHeader["NoOfReturn"]=$counter;
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Header"]=$DataHeader;
	$Result["Result"]=$DataRow;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>