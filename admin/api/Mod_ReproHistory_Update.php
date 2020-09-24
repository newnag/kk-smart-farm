<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));

$inputname = trim(urldecode($SendRequest['inputname']));
$inputDateGive = trim(urldecode($SendRequest['inputDateGive']));
$inputHistoryGive = trim(urldecode($SendRequest['inputHistoryGive']));
$inputBreastFeed = trim(urldecode($SendRequest['inputBreastFeed']));
$inputDateRut = trim(urldecode($SendRequest['inputDateRut']));
$inputSymtom = trim(urldecode($SendRequest['inputSymtom']));
$inputRutChoice = trim(urldecode($SendRequest['inputRutChoice']));
$inputRutDetail = trim(urldecode($SendRequest['inputRutDetail']));
$inputAbSymtom = trim(urldecode($SendRequest['inputAbSymtom']));
$inputTreatment = trim(urldecode($SendRequest['inputTreatment']));
$inputTreatmentDetail = trim(urldecode($SendRequest['inputTreatmentDetail']));
$inputRecomment = trim(urldecode($SendRequest['inputRecomment']));
$inputHistoryStatus = trim(urldecode($SendRequest['inputHistoryStatus']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_REPRODUCTHISTORY." SET "; 
  $sql.=" ".TABLE_MOD_REPRODUCTHISTORY."_livestockID=? ";           $arSQLData[]=$inputname;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_giveBirth=? ";           $arSQLData[]=$inputDateGive;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_giveBirthDetail=? ";           $arSQLData[]=$inputHistoryGive;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_breastFeed=? ";           $arSQLData[]=$inputBreastFeed;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_dateRut=? ";           $arSQLData[]=$inputDateRut;
	$sql.=",".TABLE_MOD_REPRODUCTHISTORY."_symtom=? ";     $arSQLData[]=$inputSymtom;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_rut=? ";           $arSQLData[]=$inputRutChoice;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_rutDetail=? ";           $arSQLData[]=$inputRutDetail;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_abnormalSymtom=? ";           $arSQLData[]=$inputAbSymtom;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_treatment=? ";           $arSQLData[]=$inputTreatment;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_treatmentDetail=? ";           $arSQLData[]=$inputTreatmentDetail;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_recomment=? ";           $arSQLData[]=$inputRecomment;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_historyStatus=? ";           $arSQLData[]=$inputHistoryStatus;
	$sql.=",".TABLE_MOD_REPRODUCTHISTORY."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
  $sql.=",".TABLE_MOD_REPRODUCTHISTORY."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
  $sql.=" WHERE ".TABLE_MOD_REPRODUCTHISTORY."_id=? ";        $arSQLData[]=$myID;

	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
###################################################

//RESULT:---------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "แก้ไขข้อมูลสำเร็จ";
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>