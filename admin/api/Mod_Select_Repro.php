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
	$sql =" SELECT * FROM ".TABLE_MOD_RUTCHOICE." WHERE ".TABLE_MOD_RUTCHOICE."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataC = array();
    $dataC["id"] = $Row[TABLE_MOD_RUTCHOICE."_id"];
    $dataC["name"]=$Row[TABLE_MOD_RUTCHOICE."_name"] ;

    $arrC[] = $dataC;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$sql =" SELECT * FROM ".TABLE_MOD_TREATMENT." WHERE ".TABLE_MOD_TREATMENT."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataS = array();
    $dataS["id"] = $Row[TABLE_MOD_TREATMENT."_id"];
    $dataS["name"]=$Row[TABLE_MOD_TREATMENT."_name"] ;

    $arrS[] = $dataS;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
    $Result["ResultRut"]=$arrC;
    $Result["ResultTreatment"]=$arrS;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>