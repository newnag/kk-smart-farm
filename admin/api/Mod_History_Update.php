<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));

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


//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_HISTORYHEALTH." SET "; 
  $sql.=" ".TABLE_MOD_HISTORYHEALTH."_livestockID=? ";           $arSQLData[]=$inputname;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_cateName1=? ";           $arSQLData[]=$inputCate1;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_subName1=? ";           $arSQLData[]=$inputSub11;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_choice1=? ";           $arSQLData[]=$inputchoice11;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_subName2=? ";           $arSQLData[]=$inputSub12;
	$sql.=",".TABLE_MOD_HISTORYHEALTH."_choice2=? ";     $arSQLData[]=$inputchoice12;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_subName3=? ";           $arSQLData[]=$inputSub13;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_choice3=? ";           $arSQLData[]=$inputchoice13;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_subName4=? ";           $arSQLData[]=$inputSub14;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_choice4=? ";           $arSQLData[]=$inputchoice14;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_cateName5=? ";           $arSQLData[]=$inputCate2;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_subName5=? ";           $arSQLData[]=$inputSub2;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_choice5=? ";           $arSQLData[]=$inputchoice2;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_cateName6=? ";           $arSQLData[]=$inputCate3;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_subName6=? ";           $arSQLData[]=$inputSub3;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_choice6=? ";           $arSQLData[]=$inputchoice3;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_cateName7=? ";           $arSQLData[]=$inputCate4;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_subName7=? ";           $arSQLData[]=$inputSub4;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_choice7=? ";           $arSQLData[]=$inputchoice4;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_cateName8=? ";           $arSQLData[]=$inputCate5;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_subName8=? ";           $arSQLData[]=$inputSub5;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_choice8=? ";           $arSQLData[]=$inputchoice5;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_historyStatus=? ";           $arSQLData[]=$inputHistoryStatus;
	$sql.=",".TABLE_MOD_HISTORYHEALTH."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
  $sql.=",".TABLE_MOD_HISTORYHEALTH."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
  $sql.=" WHERE ".TABLE_MOD_HISTORYHEALTH."_id=? ";        $arSQLData[]=$myID;

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