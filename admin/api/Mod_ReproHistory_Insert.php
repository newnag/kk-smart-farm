<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
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

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

try {
  $DataField=array(); $arSQLData=array();
  $sqla =" INSERT INTO ".TABLE_MOD_REPRODUCTHISTORY."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
  $sqla.=" ".TABLE_MOD_REPRODUCTHISTORY."_livestockID ";          $sqlb.=" ? ";         $arSQLData[]=$inputname;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_giveBirth ";         $sqlb.=",? ";         $arSQLData[]=$inputDateGive;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_giveBirthDetail ";         $sqlb.=",? ";         $arSQLData[]=$inputHistoryGive;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_breastFeed ";          $sqlb.=",? ";         $arSQLData[]=$inputBreastFeed;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_dateRut ";       $sqlb.=",? ";         $arSQLData[]=$inputDateRut;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_symtom ";       $sqlb.=",? ";         $arSQLData[]=$inputSymtom;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_rut ";       $sqlb.=",? ";         $arSQLData[]=$inputRutChoice;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_rutDetail ";       $sqlb.=",? ";         $arSQLData[]=$inputRutChoice;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_abnormalSymtom ";       $sqlb.=",? ";         $arSQLData[]=$inputAbSymtom;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_treatment ";       $sqlb.=",? ";         $arSQLData[]=$inputTreatment;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_treatmentDetail ";       $sqlb.=",? ";         $arSQLData[]=$inputTreatmentDetail;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_recomment ";       $sqlb.=",? ";         $arSQLData[]=$inputRecomment;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_historyStatus ";       $sqlb.=",? ";         $arSQLData[]=$inputHistoryStatus;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
  $sqla.=",".TABLE_MOD_REPRODUCTHISTORY."_status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
  $sql=$sqla.$sqlb.$sqlc;
  $Query=$System_Connection->prepare($sql);
  if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
  $myInsertID = $System_Connection->lastInsertId();
  $DataField["InsertID"]=$myInsertID; 
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "เพิ่มข้อมูลสำเร็จ";
	$Result["Result"] = $DataField;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>