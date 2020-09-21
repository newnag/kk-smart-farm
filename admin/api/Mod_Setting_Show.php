<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputKey = trim(urldecode($SendRequest['inputKey']));
$inputValue = trim(urldecode($SendRequest['inputValue']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_MOD_SETTING." WHERE ".TABLE_MOD_SETTING."_Key LIKE ? "; $arSQLData[]=$inputKey;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
	if($Row[TABLE_MOD_SETTING."_ID"]>0) {
		$DataField=array();
		$DataField["ID"]=$Row[TABLE_MOD_SETTING."_ID"];
		$DataField["Key"]=$Row[TABLE_MOD_SETTING."_Key"];
		$DataField["Value"]=$Row[TABLE_MOD_SETTING."_Value"];
		$DataField["Status"]=$Row[TABLE_MOD_SETTING."_Status"];
	} else { // Insert
		$DataField=array(); $arSQLData=array();
		$sqla =" INSERT INTO ".TABLE_MOD_SETTING."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
		$sqla.=" ".TABLE_MOD_SETTING."_Key ";           $sqlb.=" ? ";         $arSQLData[]=$inputKey;
		$sqla.=",".TABLE_MOD_SETTING."_Value ";         $sqlb.=",? ";         $arSQLData[]=$inputValue;
		$sqla.=",".TABLE_MOD_SETTING."_IsLock ";        $sqlb.=",? ";         $arSQLData[]=1;
		$sqla.=",".TABLE_MOD_SETTING."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_SETTING."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_SETTING."_Status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
		$sql=$sqla.$sqlb.$sqlc;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$myInsertID = $System_Connection->lastInsertId();
		$DataField=array();
		$DataField["ID"]=$myInsertID;
		$DataField["Key"]=$inputKey;
		$DataField["Value"]=$inputValue;
		$DataField["Status"]="Enable";
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Result"]=$DataField;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>