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
    $sql =" SELECT * FROM ".TABLE_MOD_REPRODUCTHISTORY." JOIN ".TABLE_MOD_LIVESTOCK." ON ".TABLE_MOD_LIVESTOCK."_id = ".TABLE_MOD_REPRODUCTHISTORY."_livestockID  WHERE ".TABLE_MOD_REPRODUCTHISTORY."_ID=? "; $arSQLData[]=$myID;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
    $Rows=$Query->fetchAll();
    $Row=$Rows[0];
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