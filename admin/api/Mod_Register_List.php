<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Predefine
#-------------------------------------------------------------------
if($SendRequest["inputProjectID"]=="") { $SendRequest["inputProjectID"]=0; }
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
$arCheck=array("ID","LastUpdate");
if(!in_array($SendRequest["inputShowOrderBy"],$arCheck)) { $SendRequest["inputShowOrderBy"]="ID"; }
$arCheck=array("ASC","DESC");
if(!in_array($SendRequest["inputShowASCDESC"],$arCheck)) { $SendRequest["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arProjectNameByID=array();
	$sql =" SELECT * FROM ".TABLE_MOD_PROJECT." WHERE ".TABLE_MOD_PROJECT."_Status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); };
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$arProjectNameByID[$Row[TABLE_MOD_PROJECT."_ID"]]=$Row[TABLE_MOD_PROJECT."_Name"];
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT COUNT(*) AS Counter FROM ".TABLE_MOD_REGISTER." WHERE ".TABLE_MOD_REGISTER."_Status='Enable' ";
	if($SendRequest["inputProjectID"]>0) {
		$sql.=" AND ".TABLE_MOD_REGISTER."_ProjectID = ? "; $arSQLData[] = $SendRequest["inputProjectID"];
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
	$sql =" SELECT * FROM ".TABLE_MOD_REGISTER." WHERE ".TABLE_MOD_REGISTER."_Status='Enable' ";
	if($SendRequest["inputProjectID"]>0) {
		$sql.=" AND ".TABLE_MOD_REGISTER."_ProjectID = ? "; $arSQLData[] = $SendRequest["inputProjectID"];
	}
	$sql.=" ORDER BY ".TABLE_MOD_REGISTER."_".$SendRequest["inputShowOrderBy"]." ".$SendRequest["inputShowASCDESC"];
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$DataField=array();
		$DataField["ID"]=$Row[TABLE_MOD_REGISTER."_ID"];
		$DataField["ProjectID"]=$Row[TABLE_MOD_REGISTER."_ProjectID"];
		$DataField["ProjectName"]=$arProjectNameByID[$Row[TABLE_MOD_REGISTER."_ProjectID"]];
		$DataField["FirstName"]=$Row[TABLE_MOD_REGISTER."_FirstName"];
		$DataField["LastName"]=$Row[TABLE_MOD_REGISTER."_LastName"];
		$DataField["Email"]=$Row[TABLE_MOD_REGISTER."_Email"];
		$DataField["Phone"]=$Row[TABLE_MOD_REGISTER."_Phone"];
		$DataField["CreateDate"]=$Row[TABLE_MOD_REGISTER."_CreateDate"];
		$DataField["Status"]=$Row[TABLE_MOD_REGISTER."_Status"];
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
	$Result["Project"]=$arProjectNameByID;
	$Result["Header"]=$DataHeader;
	$Result["Result"]=$DataRow;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>