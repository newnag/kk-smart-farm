<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputName = trim(urldecode($SendRequest['inputName']));
$inputNameFarm = trim(urldecode($SendRequest['inputNameFarm']));
$inputType = trim(urldecode($SendRequest['inputType']));
$inputMicrochip = trim(urldecode($SendRequest['inputMicrochip']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputGene = trim(urldecode($SendRequest['inputGene']));
$inputDOB = trim(urldecode($SendRequest['inputDOB']));
$inputAge = trim(urldecode($SendRequest['inputAge']));
$inputSex = trim(urldecode($SendRequest['inputSex']));
$inputWeight = trim(urldecode($SendRequest['inputWeight']));
$inputHealthStatus = trim(urldecode($SendRequest['inputHealthStatus']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));
#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
$arSQLDataA=array();
$sql =" SELECT * FROM ".TABLE_MOD_FARM." WHERE ".TABLE_MOD_FARM."_ID=? "; $arSQLDataA[]=$inputNameFarm;
$Query=$System_Connection->prepare($sql);
if(sizeof($arSQLDataA)>0) { $Query->execute($arSQLDataA);  } else { $Query->execute(); }	
$Rows=$Query->fetchAll();
$Row=$Rows[0];

if($Row[TABLE_MOD_FARM."_id"] != $inputNameFarm){
	$ErrorMessage = "ไม่มี Farm นี้";
}

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

	try {
		$DataField=array(); $arSQLData=array();
		$sqla =" INSERT INTO ".TABLE_MOD_LIVESTOCK."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
		$sqla.=" ".TABLE_MOD_LIVESTOCK."_name ";          $sqlb.=" ? ";         $arSQLData[]=$inputName;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_type ";         $sqlb.=",? ";         $arSQLData[]=$inputType;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_gene ";         $sqlb.=",? ";         $arSQLData[]=$inputGene;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_microchipNo ";          $sqlb.=",? ";         $arSQLData[]=$inputMicrochip;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_farmID ";       $sqlb.=",? ";         $arSQLData[]=$inputNameFarm;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_DOB ";       $sqlb.=",? ";         $arSQLData[]=$inputDOB;
    $sqla.=",".TABLE_MOD_LIVESTOCK."_age ";       $sqlb.=",? ";         $arSQLData[]=$inputAge;        
		$sqla.=",".TABLE_MOD_LIVESTOCK."_sex ";       $sqlb.=",? ";         $arSQLData[]=$inputSex;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_weight ";       $sqlb.=",? ";         $arSQLData[]=$inputWeight;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_healthStatus ";       $sqlb.=",? ";         $arSQLData[]=$inputHealthStatus;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_thumbnail ";       $sqlb.=",? ";         $arSQLData[]=$inputPicture;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
		$sqla.=",".TABLE_MOD_LIVESTOCK."_status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
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