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

$inputCate1 = trim(urldecode($SendRequest['inputCate1']));
$inputSub11 = trim(urldecode($SendRequest['inputSub1-1']));
$inputchoice11 = trim(urldecode($SendRequest['inputchoice1-1']));
$inputSub12 = trim(urldecode($SendRequest['inputSub1-2']));
$inputchoice12 = trim(urldecode($SendRequest['inputchoice1-2']));
$inputSub13 = trim(urldecode($SendRequest['inputSub1-3']));
$inputchoice13 = trim(urldecode($SendRequest['inputchoice1-3']));
$inputSub14 = trim(urldecode($SendRequest['inputSub1-4']));
$inputchoice14 = trim(urldecode($SendRequest['inputchoice1-4']));

$inputCate2 = trim(urldecode($SendRequest['inputCate2']));
$inputSub2 = trim(urldecode($SendRequest['inputSub2']));
$inputchoice2 = trim(urldecode($SendRequest['inputchoice2']));

$inputCate3 = trim(urldecode($SendRequest['inputCate3']));
$inputSub3 = trim(urldecode($SendRequest['inputSub3']));
$inputchoice3 = trim(urldecode($SendRequest['inputchoice3']));

$inputCate4 = trim(urldecode($SendRequest['inputCate4']));
$inputSub4 = trim(urldecode($SendRequest['inputSub4']));
$inputchoice4 = trim(urldecode($SendRequest['inputchoice4']));

$inputCate5 = trim(urldecode($SendRequest['inputCate5']));
$inputSub5 = trim(urldecode($SendRequest['inputSub5']));
$inputchoice5 = trim(urldecode($SendRequest['inputchoice5']));

$inputHistoryStatus = trim(urldecode($SendRequest['inputHistoryStatus']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

try {
  $DataField=array(); $arSQLData=array();
  $sqla =" INSERT INTO ".TABLE_MOD_HISTORYHEALTH."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
  $sqla.=" ".TABLE_MOD_HISTORYHEALTH."_livestockID ";          $sqlb.=" ? ";         $arSQLData[]=$inputname;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_cateName1 ";         $sqlb.=",? ";         $arSQLData[]=$inputCate1;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_subName1 ";         $sqlb.=",? ";         $arSQLData[]=$inputSub11;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_choice1 ";          $sqlb.=",? ";         $arSQLData[]=$inputchoice11;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_subName2 ";       $sqlb.=",? ";         $arSQLData[]=$inputSub12;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_choice2 ";       $sqlb.=",? ";         $arSQLData[]=$inputchoice12;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_subName3 ";       $sqlb.=",? ";         $arSQLData[]=$inputSub13;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_choice3 ";       $sqlb.=",? ";         $arSQLData[]=$inputchoice13;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_subName4 ";       $sqlb.=",? ";         $arSQLData[]=$inputSub14;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_choice4 ";       $sqlb.=",? ";         $arSQLData[]=$inputchoice14;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_cateName5 ";       $sqlb.=",? ";         $arSQLData[]=$inputCate2;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_subName5 ";       $sqlb.=",? ";         $arSQLData[]=$inputSub2;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_choice5 ";       $sqlb.=",? ";         $arSQLData[]=$inputchoice2;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_cateName6 ";       $sqlb.=",? ";         $arSQLData[]=$inputCate3;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_subName6 ";       $sqlb.=",? ";         $arSQLData[]=$inputSub3;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_choice6 ";       $sqlb.=",? ";         $arSQLData[]=$inputchoice3;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_cateName7 ";       $sqlb.=",? ";         $arSQLData[]=$inputCate4;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_subName7 ";       $sqlb.=",? ";         $arSQLData[]=$inputSub4;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_choice7 ";       $sqlb.=",? ";         $arSQLData[]=$inputchoice4;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_cateName8 ";       $sqlb.=",? ";         $arSQLData[]=$inputCate5;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_subName8 ";       $sqlb.=",? ";         $arSQLData[]=$inputSub5;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_choice8 ";       $sqlb.=",? ";         $arSQLData[]=$inputchoice5;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_historyStatus ";       $sqlb.=",? ";         $arSQLData[]=$inputHistoryStatus;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
  $sqla.=",".TABLE_MOD_HISTORYHEALTH."_status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
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