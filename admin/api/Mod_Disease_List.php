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

$inputType = trim(urldecode($SendRequest["inputType"]));

#-------------------------------------------------------------------
# SQL Injection Protect 
#-------------------------------------------------------------------
$arCheck=array("Enable","Disable","Deleted");
if(!in_array($SendRequest["inputShowStatus"],$arCheck)) { $SendRequest["inputShowStatus"]="Enable"; }
$arCheck=array("ID","LastUpdate","Order");
if(!in_array($SendRequest["inputShowOrderBy"],$arCheck)) { $SendRequest["inputShowOrderBy"]="Order"; }
$arCheck=array("ASC","DESC");
if(!in_array($SendRequest["inputShowASCDESC"],$arCheck)) { $SendRequest["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# PROCESS
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
try {
	$arSQLData=array();
	$sql =" SELECT COUNT(*) AS Counter FROM ".TABLE_MOD_DISEASE." WHERE ".TABLE_MOD_DISEASE."_Status='Enable' ";
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
	$sql =" SELECT * FROM ".TABLE_MOD_DISEASE." WHERE ".TABLE_MOD_DISEASE."_Status='Enable'";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$DataField=array();
		$DataField["id"]=$Row[TABLE_MOD_DISEASE."_id"];
		$DataField["name"]=$Row[TABLE_MOD_DISEASE."_name"];
		$DataField["title1"]=$Row[TABLE_MOD_DISEASE."_title1"];
		$DataField["content1"]=$Row[TABLE_MOD_DISEASE."_content1"];
		$DataField["title2"]=$Row[TABLE_MOD_DISEASE."_title2"];
		$DataField["content2"]=$Row[TABLE_MOD_DISEASE."_content2"];
		$DataField["title3"]=$Row[TABLE_MOD_DISEASE."_title3"];
		$DataField["content3"]=$Row[TABLE_MOD_DISEASE."_content3"];
		$DataField["title4"]=$Row[TABLE_MOD_DISEASE."_title4"];
		$DataField["content4"]=$Row[TABLE_MOD_DISEASE."_content4"];
		$DataRow[]=$DataField;
		$counter++;
	}
	$DataHeader[]=$counter;
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