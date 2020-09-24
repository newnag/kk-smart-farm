<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Predefine
#-------------------------------------------------------------------
if($SendRequest["inputShowOrderBy"]=="") { $SendRequest["inputShowOrderBy"]="ID"; }
if($SendRequest["inputShowPage"]>0) { } else { $SendRequest["inputShowPage"]=1; }
if($SendRequest["inputShowPageSize"]>0) { } else { $SendRequest["inputShowPageSize"]=CONFIG_DEFAULT_PAGESIZE; }
$recstart=($SendRequest["inputShowPage"]-1)*$SendRequest["inputShowPageSize"];
$arDataList=array(); $DataRow=array(); $DataHeader=array();

$LivestockID = trim(urldecode($SendRequest['LivestockID']));

#-------------------------------------------------------------------
# SQL Injection Protect 
#-------------------------------------------------------------------
$arCheck=array("Enable","Disable","Deleted");
if(!in_array($SendRequest["inputShowStatus"],$arCheck)) { $SendRequest["inputShowStatus"]="Enable"; }
$arCheck=array("ID","LastLoginDate","User");
if(!in_array($SendRequest["inputShowOrderBy"],$arCheck)) { $SendRequest["inputShowOrderBy"]="ID"; }
$arCheck=array("ASC","DESC");
if(!in_array($SendRequest["inputShowASCDESC"],$arCheck)) { $SendRequest["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
if($LivestockID == ""){
	try {
		$sql =" SELECT * FROM ".TABLE_MOD_HISTORYHEALTH." JOIN ".TABLE_MOD_LIVESTOCK." ON ".TABLE_MOD_LIVESTOCK."_id = ".TABLE_MOD_HISTORYHEALTH."_livestockID  WHERE ".TABLE_MOD_HISTORYHEALTH."_status<>'Deleted' ";
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
		while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
			$dataQ = array();
			$dataQ["id"] = $Row[TABLE_MOD_HISTORYHEALTH."_id"];
			$dataQ["livestockID"] = $Row[TABLE_MOD_HISTORYHEALTH."_livestockID"];
			$dataQ["livestock"]=$Row[TABLE_MOD_LIVESTOCK."_name"] ;
			$dataQ["cateName1"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName1"] ;
			$dataQ["subName1"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName1"] ;
			$dataQ["choice1"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice1"] ;
			$dataQ["subName2"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName2"] ;
			$dataQ["choice2"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice2"] ;
			$dataQ["subName3"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName3"] ;
			$dataQ["choice3"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice3"] ;
			$dataQ["subName4"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName4"] ;
			$dataQ["choice4"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice4"] ;
			$dataQ["cateName5"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName5"] ;
			$dataQ["subName5"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName5"]  ;
			$dataQ["choice5"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice5"] ;
			$dataQ["cateName6"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName6"] ;
			$dataQ["subName6"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName6"] ;
			$dataQ["choice6"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice6"] ;
			$dataQ["cateName7"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName7"] ;
			$dataQ["subName7"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName7"] ;
			$dataQ["choice7"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice7"] ;
			$dataQ["cateName8"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName8"]  ;
			$dataQ["subName8"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName8"] ;
			$dataQ["choice8"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice8"] ;
			$dataQ["historyStatus"]=$Row[TABLE_MOD_HISTORYHEALTH."_historyStatus"] ;
			$dataQ["date"]=$Row[TABLE_MOD_HISTORYHEALTH."_CreateDate"] ;
	
			$arrdataQ[] = $dataQ;
		}
	} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}
else{
	try {
		$sql =" SELECT * FROM ".TABLE_MOD_HISTORYHEALTH." JOIN ".TABLE_MOD_LIVESTOCK." ON ".TABLE_MOD_LIVESTOCK."_id = ".TABLE_MOD_HISTORYHEALTH."_livestockID  WHERE ".TABLE_MOD_HISTORYHEALTH."_status<>'Deleted' AND ".TABLE_MOD_HISTORYHEALTH."_livestockID =".$LivestockID;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
		while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
			$dataQ = array();
			$dataQ["id"] = $Row[TABLE_MOD_HISTORYHEALTH."_id"];
			$dataQ["livestockID"] = $Row[TABLE_MOD_HISTORYHEALTH."_livestockID"];
			$dataQ["livestock"]=$Row[TABLE_MOD_LIVESTOCK."_name"] ;
			$dataQ["cateName1"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName1"] ;
			$dataQ["subName1"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName1"] ;
			$dataQ["choice1"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice1"] ;
			$dataQ["subName2"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName2"] ;
			$dataQ["choice2"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice2"] ;
			$dataQ["subName3"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName3"] ;
			$dataQ["choice3"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice3"] ;
			$dataQ["subName4"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName4"] ;
			$dataQ["choice4"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice4"] ;
			$dataQ["cateName5"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName5"] ;
			$dataQ["subName5"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName5"]  ;
			$dataQ["choice5"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice5"] ;
			$dataQ["cateName6"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName6"] ;
			$dataQ["subName6"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName6"] ;
			$dataQ["choice6"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice6"] ;
			$dataQ["cateName7"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName7"] ;
			$dataQ["subName7"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName7"] ;
			$dataQ["choice7"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice7"] ;
			$dataQ["cateName8"]=$Row[TABLE_MOD_HISTORYHEALTH."_cateName8"]  ;
			$dataQ["subName8"]=$Row[TABLE_MOD_HISTORYHEALTH."_subName8"] ;
			$dataQ["choice8"]=$Row[TABLE_MOD_HISTORYHEALTH."_choice8"] ;
			$dataQ["historyStatus"]=$Row[TABLE_MOD_HISTORYHEALTH."_historyStatus"] ;
			$dataQ["date"]=$Row[TABLE_MOD_HISTORYHEALTH."_CreateDate"] ;
	
			$arrdataQ[] = $dataQ;
		}
	} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}



$DataHeader["Total"] = count($arrdataQ) ;

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Header"]=$DataHeader;
	$Result["Result"]=$arrdataQ;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>