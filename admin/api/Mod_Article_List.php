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
	$sql =" SELECT COUNT(*) AS Counter FROM ".TABLE_MOD_ARTICLE." WHERE ".TABLE_MOD_ARTICLE."_Status='Enable' ";
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
	$sql =" SELECT * FROM ".TABLE_MOD_ARTICLE." WHERE ".TABLE_MOD_ARTICLE."_Status='Enable' ";
	$sql.=" ORDER BY ".TABLE_MOD_ARTICLE."_".$SendRequest["inputShowOrderBy"]." ".$SendRequest["inputShowASCDESC"];
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$DataField=array();
		$DataField["ID"]=$Row[TABLE_MOD_ARTICLE."_ID"];
		$DataField["Name"]=$Row[TABLE_MOD_ARTICLE."_Name"];
		$DataField["HTML"]=$Row[TABLE_MOD_ARTICLE."_HTML"];
		if($Row[TABLE_MOD_ARTICLE."_Picture"]<>"") {
			$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_article/".$Row[TABLE_MOD_ARTICLE."_Picture"];
			$DataField["Picture-Thumb"]=SYSTEM_FULLPATH_UPLOAD."mod_article/thumb-".$Row[TABLE_MOD_ARTICLE."_Picture"];
		} else {
			$DataField["Picture"]=CONFIG_DEFAULT_THUMB_PICTURE;
			$DataField["Picture-Thumb"]=CONFIG_DEFAULT_THUMB_PICTURE;
		}
		$DataField["CreateDate"]=$Row[TABLE_MOD_ARTICLE."_CreateDate"];
		$DataField["CreateByID"]=$Row[TABLE_MOD_ARTICLE."_CreateByID"];
		$DataField["CreateByName"]=$arUserNameByID[$Row[TABLE_MOD_ARTICLE."_CreateByID"]];
		$DataField["LastUpdate"]=$Row[TABLE_MOD_ARTICLE."_LastUpdate"];
		$DataField["LastUpdateByID"]=$Row[TABLE_MOD_ARTICLE."_LastUpdateByID"];
		$DataField["LastUpdateByName"]=$arUserNameByID[$Row[TABLE_MOD_ARTICLE."_LastUpdateByID"]];
		$DataField["Order"]=$Row[TABLE_MOD_ARTICLE."_Order"];
		$DataField["Status"]=$Row[TABLE_MOD_ARTICLE."_Status"];
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