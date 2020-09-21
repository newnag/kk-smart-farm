<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

global $arFacilityKey,$arFacilityName,$arAssetTypeKey,$arAssetTypeName;

//INPUT:----------------------------------------
$myID = trim(urldecode($SendRequest['inputID']));
$inputName = trim(urldecode($SendRequest['inputName']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputPictureMap = trim(urldecode($SendRequest['inputPictureMap']));
$inputMapLogo = trim(urldecode($SendRequest['inputMapLogo']));
$inputHTML = trim(urldecode($SendRequest['inputHTML']));
$inputDescription = trim(urldecode($SendRequest['inputDescription']));
$inputLocationName = trim(urldecode($SendRequest['inputLocationName']));
$inputGoogleMapLink = trim(urldecode($SendRequest['inputGoogleMapLink']));
$inputStatus = trim(urldecode($SendRequest['inputStatus']));
$inputIsRegisterOn = trim(urldecode($SendRequest['inputIsRegisterOn']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

//PROCESS:----------------------------------------
###################################################
try {
	$arSQLData=array();
	$sql =" UPDATE ".TABLE_MOD_PROJECT." SET "; 
	$sql.=" ".TABLE_MOD_PROJECT."_Name=? ";            $arSQLData[]=$inputName;
	if($inputPicture<>"") {
		$sql.=",".TABLE_MOD_PROJECT."_Picture=? ";     $arSQLData[]=$inputPicture;
	}
	if($inputPictureMap<>"") {
		$sql.=",".TABLE_MOD_PROJECT."_PictureMap=? ";  $arSQLData[]=$inputPictureMap;
	}
	if($inputMapLogo<>"") {
		$sql.=",".TABLE_MOD_PROJECT."_MapLogo=? ";     $arSQLData[]=$inputMapLogo;
	}
	$sql.=",".TABLE_MOD_PROJECT."_HTML=? ";            $arSQLData[]=$inputHTML;
	$sql.=",".TABLE_MOD_PROJECT."_Description=? ";     $arSQLData[]=$inputDescription;
	$sql.=",".TABLE_MOD_PROJECT."_LocationName=? ";    $arSQLData[]=$inputLocationName;
	for($i=0;$i<sizeof($arFacilityKey);$i++) {
		if(trim(urldecode($SendRequest['inputFacility'.$arFacilityKey[$i]]))=="Yes") {
			$sql.=",".TABLE_MOD_PROJECT."_Facility".$arFacilityKey[$i]."=? "; $arSQLData[]="Yes";
		} else {
			$sql.=",".TABLE_MOD_PROJECT."_Facility".$arFacilityKey[$i]."=? "; $arSQLData[]="No";
		}
	}
	for($i=0;$i<sizeof($arAssetTypeKey);$i++) {
		if(trim(urldecode($SendRequest['inputAssetType'.$arAssetTypeKey[$i]]))=="Yes") {
			$sql.=",".TABLE_MOD_PROJECT."_AssetType".$arAssetTypeKey[$i]."=? "; $arSQLData[]="Yes";
		} else {
			$sql.=",".TABLE_MOD_PROJECT."_AssetType".$arAssetTypeKey[$i]."=? "; $arSQLData[]="No";
		}
	}
	for($i=0;$i<sizeof($arAssetTypeKey);$i++) {
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_BedRoom']))*1>0) {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BedRoom=? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_BedRoom']))*1;
		} else {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BedRoom=? "; $arSQLData[]=0;
		}
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_BathRoom']))*1>0) {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BathRoom=? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_BathRoom']))*1;
		} else {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BathRoom=? "; $arSQLData[]=0;
		}
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_CarPark']))*1>0) {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_CarPark=? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_CarPark']))*1;
		} else {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_CarPark=? "; $arSQLData[]=0;
		}
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_LivingSpace']))*1>0) {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_LivingSpace=? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_LivingSpace']))*1;
		} else {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_LivingSpace=? "; $arSQLData[]=0;
		}
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_AssetPicture']))<>"") {
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_AssetPicture=? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_AssetPicture']));
		}
		for($x=1;$x<=5;$x++) {
			if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_Plan'.$x.'Picture']))<>"") {
				$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_Plan".$x."Picture=? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_Plan'.$x.'Picture']));
			}
			$sql.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_Plan".$x."Name=? ";    $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_Plan'.$x.'Name']));
		}
	}
	for($x=1;$x<=3;$x++) {
		if(trim(urldecode($SendRequest['inputHero'.$x]))<>"") {
			$sql.=",".TABLE_MOD_PROJECT."_Hero".$x."=? "; $arSQLData[]=trim(urldecode($SendRequest['inputHero'.$x]));
		}
	}
	for($x=1;$x<=17;$x++) {
		if(trim(urldecode($SendRequest['inputGallery'.$x]))<>"") {
			$sql.=",".TABLE_MOD_PROJECT."_Gallery".$x."=? "; $arSQLData[]=trim(urldecode($SendRequest['inputGallery'.$x]));
		}
	}
	$sql.=",".TABLE_MOD_PROJECT."_GoogleMapLink=? ";        $arSQLData[]=$inputGoogleMapLink;
	for($x=1;$x<=8;$x++) { 
		$sql.=",".TABLE_MOD_PROJECT."_Location".$x."Name=? ";    $arSQLData[]=trim(urldecode($SendRequest['inputLocation'.$x.'Name']));
		$sql.=",".TABLE_MOD_PROJECT."_Location".$x."Min=? ";     $arSQLData[]=trim(urldecode($SendRequest['inputLocation'.$x.'Min']));
		$sql.=",".TABLE_MOD_PROJECT."_Location".$x."Percent=? "; $arSQLData[]=trim(urldecode($SendRequest['inputLocation'.$x.'Percent']));
	}
	$sql.=",".TABLE_MOD_PROJECT."_LastUpdate=? ";      $arSQLData[]=SYSTEM_DATETIMENOW;
	$sql.=",".TABLE_MOD_PROJECT."_LastUpdateByID=? ";  $arSQLData[]=$SystemSession_Staff_ID;
	$sql.=",".TABLE_MOD_PROJECT."_Status=? ";          $arSQLData[]=$inputStatus;
	$sql.=",".TABLE_MOD_PROJECT."_IsRegisterOn=? ";    $arSQLData[]=$inputIsRegisterOn;
	$sql.=" WHERE ".TABLE_MOD_PROJECT."_ID=? ";        $arSQLData[]=$myID;
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