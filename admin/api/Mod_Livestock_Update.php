<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputName = trim(urldecode($SendRequest['inputName']));
$inputIDFarm = trim(urldecode($SendRequest['inputNameFarm']));
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

$inputArr	=	array($inputName,$inputIDFarm,$inputType,$inputMicrochip,
							$inputPicture,$inputGene,$inputDOB,$inputAge,
              $inputSex,$inputWeight,$inputHealthStatus);

if($inputIDFarm == ""){
  $ErrorMessage = "กรุณาใส่ ID ฟาร์ม";
}
              
//PROCESS:----------------------------------------
###################################################

$arSQLDataA=array();
$sql =" SELECT * FROM ".TABLE_MOD_FARM." WHERE ".TABLE_MOD_FARM."_ID=? "; $arSQLDataA[]=$inputIDFarm;
$Query=$System_Connection->prepare($sql);
if(sizeof($arSQLDataA)>0) { $Query->execute($arSQLDataA);  } else { $Query->execute(); }	
$Rows=$Query->fetchAll();
$Row=$Rows[0];

if($Row[TABLE_MOD_FARM."_id"] != $inputIDFarm){
	$ErrorMessage = "ไม่มี Farm นี้";
}

//PROCESS:----------------------------------------
###################################################
$sscount = 0;
for($i=0;$i<sizeof($inputArr);$i++){
	$spcount = $inputArr[$i];
	if($spcount[$i] == ""){
		$sscount++;
	}
}

if($sscount < sizeof($inputArr)){
  try {
    $arSQLData=array();
    $sql =" UPDATE ".TABLE_MOD_LIVESTOCK." SET "; 
    $sql.=" ".TABLE_MOD_LIVESTOCK."_name=? ";           $arSQLData[]=$inputName;
    $sql.=",".TABLE_MOD_LIVESTOCK."_type=? ";           $arSQLData[]=$inputType;
    if($inputPicture<>"") {
      $sql.=",".TABLE_MOD_LIVESTOCK."_thumbnail=? ";     $arSQLData[]=$inputPicture;
    }
    if($inputNameFarm<>"") {
      $sql.=",".TABLE_MOD_LIVESTOCK."_farmID=? ";           $arSQLData[]=$inputIDFarm;
    }
    $sql.=",".TABLE_MOD_LIVESTOCK."_gene=? ";           $arSQLData[]=$inputGene;
    $sql.=",".TABLE_MOD_LIVESTOCK."_microchipNo=? ";           $arSQLData[]=$inputMicrochip;
    $sql.=",".TABLE_MOD_LIVESTOCK."_DOB=? ";           $arSQLData[]=$inputDOB;
    $sql.=",".TABLE_MOD_LIVESTOCK."_age=? ";           $arSQLData[]=$inputAge;
    $sql.=",".TABLE_MOD_LIVESTOCK."_sex=? ";           $arSQLData[]=$inputSex;
    $sql.=",".TABLE_MOD_LIVESTOCK."_weight=? ";           $arSQLData[]=$inputWeight;
    $sql.=",".TABLE_MOD_LIVESTOCK."_healthStatus=? ";           $arSQLData[]=$inputHealthStatus;
    $sql.=",".TABLE_MOD_LIVESTOCK."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
    $sql.=",".TABLE_MOD_LIVESTOCK."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
    $sql.=" WHERE ".TABLE_MOD_LIVESTOCK."_id=? ";        $arSQLData[]=$myID;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
  } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}
else{
	$ErrorMessage = "กรุณากรอกข้อมูลอย่างน้อย 1 ช่อง";
}

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