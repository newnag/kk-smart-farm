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
	$counter=0; $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_MOD_BANNER1." WHERE ".TABLE_MOD_BANNER1."_Status='Enable' ";
	$sql.=" ORDER BY RAND() ";
	$sql.=" LIMIT 0,1 ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		if($Row[TABLE_MOD_BANNER1."_Picture"]<>"") {
			$DataField=array();
			$DataField["ID"]=$Row[TABLE_MOD_BANNER1."_ID"];
			$DataField["Name"]=$Row[TABLE_MOD_BANNER1."_Name"];
			$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_banner1/".$Row[TABLE_MOD_BANNER1."_Picture"];
			$DataField["CreateDate"]=$Row[TABLE_MOD_BANNER1."_CreateDate"];
			$DataField["LastUpdate"]=$Row[TABLE_MOD_BANNER1."_LastUpdate"];
			$DataField["Status"]=$Row[TABLE_MOD_BANNER1."_Status"];
			$DataRow[]=$DataField;
			$counter++;
		}
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