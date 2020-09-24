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
  $counter=0; $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_MOD_DISEASE." WHERE ".TABLE_MOD_DISEASE."_id=? "; $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
    $dataQ = array();
    $dataQ["id"]=$Row[TABLE_MOD_DISEASE."_id"];
		$dataQ["name"]=$Row[TABLE_MOD_DISEASE."_name"];
		$dataQ["title1"]=$Row[TABLE_MOD_DISEASE."_title1"];
		$dataQ["content1"]=$Row[TABLE_MOD_DISEASE."_content1"];
		$dataQ["title2"]=$Row[TABLE_MOD_DISEASE."_title2"];
		$dataQ["content2"]=$Row[TABLE_MOD_DISEASE."_content2"];
		$dataQ["title3"]=$Row[TABLE_MOD_DISEASE."_title3"];
		$dataQ["content3"]=$Row[TABLE_MOD_DISEASE."_content3"];
		$dataQ["title4"]=$Row[TABLE_MOD_DISEASE."_title4"];
		$dataQ["content4"]=$Row[TABLE_MOD_DISEASE."_content4"];
    $counter++;
  
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Result"]=$dataQ;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>