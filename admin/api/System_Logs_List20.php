<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Predefine
#-------------------------------------------------------------------
$arDataList=array(); $DataRow=array(); $DataHeader=array();

#-------------------------------------------------------------------
# Predefine - Staff Information
#-------------------------------------------------------------------
try {
	$arUserNameByID=array();
	$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_Status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$arUserNameByID[$Row[TABLE_SYSTEM_STAFF."_ID"]]=$Row[TABLE_SYSTEM_STAFF."_User"];
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$counter=0; $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_SYSTEM_LOGS." WHERE 1 ";
	$sql.=" ORDER BY ".TABLE_SYSTEM_LOGS."_ID DESC ";
	$sql.=" LIMIT 0 , 20 ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$DataField=array();
		$DataField["ID"]=$Row[TABLE_SYSTEM_LOGS."_ID"];
		$DataField["Icon"]=$Row[TABLE_SYSTEM_LOGS."_Icon"];
		$DataField["Color"]=$Row[TABLE_SYSTEM_LOGS."_Color"];
		$DataField["Action"]=$Row[TABLE_SYSTEM_LOGS."_Action"];
		$DataField["KeyMain"]=$Row[TABLE_SYSTEM_LOGS."_KeyMain"];
		$DataField["KeySub"]=$Row[TABLE_SYSTEM_LOGS."_KeySub"];
		$DataField["CreateDate"]=$Row[TABLE_SYSTEM_LOGS."_CreateDate"];
		$DataField["CreateByID"]=$Row[TABLE_SYSTEM_LOGS."_CreateByID"];
		$DataField["CreateByName"]=$arUserNameByID[$Row[TABLE_SYSTEM_LOGS."_CreateByID"]];
		$DataRow[]=$DataField;
		$counter++;
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Result"]=$DataRow;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>