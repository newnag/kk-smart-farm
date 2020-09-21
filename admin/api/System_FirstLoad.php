<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Predefine
#-------------------------------------------------------------------
	$DataFieldSetting=array(); $arSQLData=array();

#-------------------------------------------------------------------
# PROCESS - Load Setting
#-------------------------------------------------------------------
try {
	$sql =" SELECT * FROM ".TABLE_SYSTEM_SETTING." WHERE 1 ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$DataField=array();
		$DataField["Key"]=$Row[TABLE_SYSTEM_SETTING."_Key"];
		$DataField["Value"]=$Row[TABLE_SYSTEM_SETTING."_Value"];
		$DataFieldSetting[]=$DataField;
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["ResultSetting"]=$DataFieldSetting;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>