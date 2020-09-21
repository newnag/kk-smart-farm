<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$myID = trim(urldecode($SendRequest['inputID']))*1;

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_MOD_PAGE." WHERE ".TABLE_MOD_PAGE."_ID=? "; $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
	$DataField=array();
	$DataField["ID"]=$Row[TABLE_MOD_PAGE."_ID"];
	$DataField["HTML"]=$Row[TABLE_MOD_PAGE."_HTML"];
	if($Row[TABLE_MOD_PAGE."_ID"]>0) {
		// do noting
	} else { // insert
		$DataField=array(); $arSQLData=array();
		$sqla =" INSERT INTO ".TABLE_MOD_PAGE."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
		$sqla.=" ".TABLE_MOD_PAGE."_ID ";            $sqlb.=" ? ";         $arSQLData[]=$myID;
		$sqla.=",".TABLE_MOD_PAGE."_HTML ";          $sqlb.=",? ";         $arSQLData[]=' ';
		$sqla.=",".TABLE_MOD_PAGE."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_PAGE."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_PAGE."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_PAGE."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_PAGE."_Status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
		$sql=$sqla.$sqlb.$sqlc;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }		
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