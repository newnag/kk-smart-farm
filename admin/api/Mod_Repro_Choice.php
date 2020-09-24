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
	$sql =" SELECT * FROM ".TABLE_MOD_LIVESTOCK." WHERE ".TABLE_MOD_LIVESTOCK."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataC = array();
    $dataC["id"] = $Row[TABLE_MOD_LIVESTOCK."_id"];
    $dataC["name"]=$Row[TABLE_MOD_LIVESTOCK."_name"] ;

    $arrC[] = $dataC;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

try {
	$sql =" SELECT * FROM ".TABLE_MOD_RUTCHOICE." WHERE ".TABLE_MOD_RUTCHOICE."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataS = array();
    $dataS["id"] = $Row[TABLE_MOD_RUTCHOICE."_id"];
    $dataS["name"]=$Row[TABLE_MOD_RUTCHOICE."_name"] ;

    $arrS[] = $dataS;
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
    $dataQ = array();
    $dataQ["id"] = $Row[TABLE_MOD_TREATMENT."_id"];
    $dataQ["name"]=$Row[TABLE_MOD_TREATMENT."_name"] ;

    $arrQ[] = $dataQ;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
    $Result["ResultL"]=$arrC;
    $Result["ResultR"]=$arrS;
    $Result["ResultT"]=$arrQ;
    // $Result["ResultLivestock"]=$arrL;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>