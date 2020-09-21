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
try {
  $dataQ=array();
  $arData = array();
	$sql =" SELECT * FROM ".TABLE_MOD_USERFARM."";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataQ[$Row[TABLE_MOD_USERFARM."_id"]]=[  $Row[TABLE_MOD_USERFARM."_user"],
                                              $Row[TABLE_MOD_USERFARM."_email"],
                                              $Row[TABLE_MOD_USERFARM."_fullname"],
                                              $Row[TABLE_MOD_USERFARM."_lastname"],
                                              $Row[TABLE_MOD_USERFARM."_sex"],
                                              $Row[TABLE_MOD_USERFARM."_DOB"],
                                              $Row[TABLE_MOD_USERFARM."_id_No"],
                                              $Row[TABLE_MOD_USERFARM."_address"],
                                              $Row[TABLE_MOD_USERFARM."_province"],
                                              $Row[TABLE_MOD_USERFARM."_district"],
                                              $Row[TABLE_MOD_USERFARM."_subdistrict"],
                                              $Row[TABLE_MOD_USERFARM."_postcode"],
                                            ];
  }
  // print_r($dataQ);
  // exit();
  
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
// try {
// 	$arStaffGroupNameByID=array(); $arStaffGroupCodeNameByID=array();
// 	$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF_GROUP." WHERE ".TABLE_SYSTEM_STAFF_GROUP."_Status<>'Deleted' ";
// 	$Query=$System_Connection->prepare($sql);
// 	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
// 	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
// 		$arStaffGroupNameByID[$Row[TABLE_SYSTEM_STAFF_GROUP."_ID"]]=$Row[TABLE_SYSTEM_STAFF_GROUP."_Name"];
// 		$arStaffGroupCodeNameByID[$Row[TABLE_SYSTEM_STAFF_GROUP."_ID"]]=$Row[TABLE_SYSTEM_STAFF_GROUP."_CodeName"];
// 	}
// } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
// try {
// 	$arSQLData=array();
// 	$sql =" SELECT COUNT(*) AS Counter FROM ".TABLE_MOD_USERFARM."";
// 	if($SendRequest["inputShowSearch"]<>"") {
// 		$sql.=" AND ( ".TABLE_MOD_USERFARM."_User LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
// 		$sql.=" OR ".TABLE_MOD_USERFARM."_Email LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
// 		$sql.=" ) ";
// 	}
// 	if($SendRequest["inputShowStaffLevel"]<>"" && $SendRequest["inputShowStaffLevel"]<>"All") {
// 		$sql.=" AND ".TABLE_MOD_USERFARM."_Level = ? "; $arSQLData[]=''.$SendRequest["inputShowStaffLevel"].'';
// 	}
// 	if($SendRequest["inputShowStaffGroup"]>0 && $SendRequest["inputShowStaffGroup"]<>"All") {
// 		$sql.=" AND ".TABLE_MOD_USERFARM."_StaffGroupID = ? "; $arSQLData[]=''.$SendRequest["inputShowStaffGroup"].'';
// 	}
// 	if($SendRequest["inputShowStatus"]<>"") {
// 		$sql.=" AND ".TABLE_MOD_USERFARM."_Status= ? "; $arSQLData[]=''.$SendRequest["inputShowStatus"].'';
// 	}
// 	$Query=$System_Connection->prepare($sql);
// 	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
// 	$Rows=$Query->fetchAll();
// 	$totalrecord=$Rows[0]["Counter"];
// 	if($totalrecord>0) { $maxpage=ceil($totalrecord/$SendRequest["inputShowPageSize"]); } else { $maxpage=1; }
// 	$DataHeader["Page"]=$SendRequest["inputShowPage"];
// 	$DataHeader["PageSize"]=$SendRequest["inputShowPageSize"];
// 	$DataHeader["MaxPage"]=$maxpage;
// 	$DataHeader["TotalRecord"]=$totalrecord;
// } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
// try {
// 	$counter=0; $arSQLData=array();
// 	$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_Status<>'Deleted' ";
// 	if($SendRequest["inputShowSearch"]<>"") {
// 		$sql.=" AND ( ".TABLE_SYSTEM_STAFF."_User LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
// 		$sql.=" OR ".TABLE_SYSTEM_STAFF."_Email LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
// 		$sql.=" ) ";
// 	}
// 	if($SendRequest["inputShowStaffLevel"]<>"" && $SendRequest["inputShowStaffLevel"]<>"All") {
// 		$sql.=" AND ".TABLE_SYSTEM_STAFF."_Level = ? "; $arSQLData[]=''.$SendRequest["inputShowStaffLevel"].'';
// 	}
// 	if($SendRequest["inputShowStaffGroup"]>0 && $SendRequest["inputShowStaffGroup"]<>"All") {
// 		$sql.=" AND ".TABLE_SYSTEM_STAFF."_StaffGroupID = ? "; $arSQLData[]=''.$SendRequest["inputShowStaffGroup"].'';
// 	}
// 	if($SendRequest["inputShowStatus"]<>"") {
// 		$sql.=" AND ".TABLE_SYSTEM_STAFF."_Status= ? "; $arSQLData[]=''.$SendRequest["inputShowStatus"].'';
// 	}
// 	$sql.=" ORDER BY ".TABLE_SYSTEM_STAFF."_".$SendRequest["inputShowOrderBy"]." ".$SendRequest["inputShowASCDESC"];
// 	$sql.=" LIMIT ".$recstart.",".$SendRequest["inputShowPageSize"]." ";
// 	$Query=$System_Connection->prepare($sql);
// 	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
// 	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
// 		$DataField=array();
// 		$DataField["ID"]=$Row[TABLE_SYSTEM_STAFF."_ID"];
// 		$DataField["User"]=$Row[TABLE_SYSTEM_STAFF."_User"];
// 		$DataField["Phone"]=$Row[TABLE_SYSTEM_STAFF."_Phone"];
// 		if($Row[TABLE_SYSTEM_STAFF."_Picture"]<>"") {
// 			$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."system_staff/".$Row[TABLE_SYSTEM_STAFF."_Picture"];
// 		} else {
// 			$DataField["Picture"]=CONFIG_DEFAULT_THUMB_USER;
// 		}
// 		$DataField["Email"]=$Row[TABLE_SYSTEM_STAFF."_Email"];
// 		$DataField["Level"]=$Row[TABLE_SYSTEM_STAFF."_Level"];
// 		$DataField["StaffGroupID"]=$Row[TABLE_SYSTEM_STAFF."_StaffGroupID"];
// 		if($Row[TABLE_SYSTEM_STAFF."_StaffGroupID"]>0) {
// 			$arTmp1=array();
// 			$arTmp1["ID"]=$Row[TABLE_SYSTEM_STAFF."_StaffGroupID"];
// 			$arTmp1["Name"]=$arStaffGroupNameByID[$Row[TABLE_SYSTEM_STAFF."_StaffGroupID"]];
// 			$arTmp1["CodeName"]=$arStaffGroupCodeNameByID[$Row[TABLE_SYSTEM_STAFF."_StaffGroupID"]];
// 			$DataField["StaffGroupIDInfo"]=$arTmp1;
// 		}
// 		$DataField["CreateDate"]=$Row[TABLE_SYSTEM_STAFF."_CreateDate"];
// 		$DataField["CreateByID"]=$Row[TABLE_SYSTEM_STAFF."_CreateByID"];
// 		$DataField["CreateByName"]=$arUserNameByID[$Row[TABLE_SYSTEM_STAFF."_CreateByID"]];
// 		$DataField["LastUpdate"]=$Row[TABLE_SYSTEM_STAFF."_LastUpdate"];
// 		$DataField["LastUpdateByID"]=$Row[TABLE_SYSTEM_STAFF."_LastUpdateByID"];
// 		$DataField["LastUpdateByName"]=$arUserNameByID[$Row[TABLE_SYSTEM_STAFF."_LastUpdateByID"]];
// 		$DataField["LastLoginDate"]=$Row[TABLE_SYSTEM_STAFF."_LastLoginDate"];
// 		$DataField["Status"]=$Row[TABLE_SYSTEM_STAFF."_Status"];
// 		$DataRow[]=$DataField;
// 		$counter++;
// 	}
// 	$DataHeader["NoOfReturn"]=$counter;
// 	if($SendRequest["inputShowPage"]==1) {
// 		$DataCategory["StaffGroup"]=$arStaffGroupNameByID;
// 	}
// } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

$DataHeader["Total"] = count($dataQ) ;

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Header"]=$DataHeader;
	$Result["Category"]=$DataCategory;
	$Result["Result"]=$dataQ;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>