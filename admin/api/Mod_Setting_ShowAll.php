<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$DataRow=array(); $DataRowUse=array(); $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_MOD_SETTING." WHERE 1 ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$DataRow[$Row[TABLE_MOD_SETTING."_Key"]]=$Row[TABLE_MOD_SETTING."_Value"];
		$DataRowUse[$Row[TABLE_MOD_SETTING."_Key"]]=$Row[TABLE_MOD_SETTING."_Status"];
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Result"]=$DataRow;
	$Result["ResultUse"]=$DataRowUse;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>