<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputData = trim(urldecode($SendRequest['inputData']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT MAX(".TABLE_MOD_BANNERHERO4."_ID) FROM ".TABLE_MOD_BANNERHERO4." WHERE 1 ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$MyMaxID=$Rows[0][0]*1;
	
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	if($MyMaxID>0) {
		$myMaxOrder=$MyMaxID;
		$arID=explode(",",$inputData);
		for($i=0;$i<=sizeof($arID);$i++) {
			$myID=$arID[$i]*1;
			if($myID>0) {
				$arSQLData=array();
				$sql =" UPDATE ".TABLE_MOD_BANNERHERO4." SET "; 
				$sql.=" ".TABLE_MOD_BANNERHERO4."_Order=? ";        $arSQLData[]=$myMaxOrder;
				$sql.=" WHERE ".TABLE_MOD_BANNERHERO4."_ID=? ";     $arSQLData[]=$myID;
				$Query=$System_Connection->prepare($sql);
				if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
				$myMaxOrder--;
			}
		}
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "แก้ไขข้อมูลสำเร็จ";
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>