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
		$sql =" SELECT * FROM ".TABLE_MOD_REPRODUCTHISTORY." JOIN ".TABLE_MOD_LIVESTOCK." ON ".TABLE_MOD_LIVESTOCK."_id = ".TABLE_MOD_REPRODUCTHISTORY."_livestockID  WHERE ".TABLE_MOD_REPRODUCTHISTORY."_status<>'Deleted' ";
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
		while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
			$dataQ = array();
			$dataQ["id"] = $Row[TABLE_MOD_REPRODUCTHISTORY."_id"];
      $dataQ["livestockID"] = $Row[TABLE_MOD_REPRODUCTHISTORY."_livestockID"];
      $dataQ["name"] = $Row[TABLE_MOD_LIVESTOCK."_name"];
			$dataQ["giveBirth"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_giveBirth"] ;
			$dataQ["giveBirthDetail"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_giveBirthDetail"] ;
			$dataQ["breastFeed"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_breastFeed"] ;
			$dataQ["dateRut"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_dateRut"] ;
			$dataQ["symtom"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_symtom"] ;
			$dataQ["rut"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_rut"] ;
			$dataQ["rutDetail"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_rutDetail"] ;
			$dataQ["treatment"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_treatment"] ;
			$dataQ["treatmentDetail"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_treatmentDetail"] ;
			$dataQ["abnormalSymtom"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_abnormalSymtom"] ;
			$dataQ["recomment"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_recomment"] ;
			$dataQ["historyStatus"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_historyStatus"]  ;
			$dataQ["date"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_CreateDate"] ;
	
			$arrdataQ[] = $dataQ;
		}
	} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}
else{
	try {
		$sql =" SELECT * FROM ".TABLE_MOD_REPRODUCTHISTORY." JOIN ".TABLE_MOD_LIVESTOCK." ON ".TABLE_MOD_LIVESTOCK."_id = ".TABLE_MOD_REPRODUCTHISTORY."_livestockID  WHERE ".TABLE_MOD_REPRODUCTHISTORY."_status<>'Deleted' AND ".TABLE_MOD_REPRODUCTHISTORY."_livestockID =".$LivestockID;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
		while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
			$dataQ = array();
			$dataQ["id"] = $Row[TABLE_MOD_REPRODUCTHISTORY."_id"];
      $dataQ["livestockID"] = $Row[TABLE_MOD_REPRODUCTHISTORY."_livestockID"];
      $dataQ["name"] = $Row[TABLE_MOD_LIVESTOCK."_name"];
			$dataQ["giveBirth"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_giveBirth"] ;
			$dataQ["giveBirthDetail"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_giveBirthDetail"] ;
			$dataQ["breastFeed"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_breastFeed"] ;
			$dataQ["dateRut"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_dateRut"] ;
			$dataQ["symtom"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_symtom"] ;
			$dataQ["rut"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_rut"] ;
			$dataQ["rutDetail"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_rutDetail"] ;
			$dataQ["treatment"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_treatment"] ;
			$dataQ["treatmentDetail"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_treatmentDetail"] ;
			$dataQ["abnormalSymtom"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_abnormalSymtom"] ;
			$dataQ["recomment"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_recomment"] ;
			$dataQ["historyStatus"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_historyStatus"]  ;
			$dataQ["date"]=$Row[TABLE_MOD_REPRODUCTHISTORY."_CreateDate"] ;
	
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