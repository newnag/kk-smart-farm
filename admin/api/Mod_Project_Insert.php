<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

global $arFacilityKey,$arFacilityName,$arAssetTypeKey,$arAssetTypeName;

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputName = trim(urldecode($SendRequest['inputName']));
$inputPicture = trim(urldecode($SendRequest['inputPicture']));
$inputPictureMap = trim(urldecode($SendRequest['inputPictureMap']));
$inputMapLogo = trim(urldecode($SendRequest['inputMapLogo']));
$inputHTML = trim(urldecode($SendRequest['inputHTML']));
$inputDescription = trim(urldecode($SendRequest['inputDescription']));
$inputLocationName = trim(urldecode($SendRequest['inputLocationName']));
$inputGoogleMapLink = trim(urldecode($SendRequest['inputGoogleMapLink']));
$inputIsRegisterOn = trim(urldecode($SendRequest['inputIsRegisterOn']));
$SystemSession_Staff_ID = trim(urldecode($SendRequest['SystemSession_Staff_ID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$DataField=array(); $arSQLData=array();
	$sqla =" INSERT INTO ".TABLE_MOD_PROJECT."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
	$sqla.=" ".TABLE_MOD_PROJECT."_Name ";          $sqlb.=" ? ";         $arSQLData[]=$inputName;
	$sqla.=",".TABLE_MOD_PROJECT."_Picture ";       $sqlb.=",? ";         $arSQLData[]=$inputPicture;
	$sqla.=",".TABLE_MOD_PROJECT."_PictureMap ";    $sqlb.=",? ";         $arSQLData[]=$inputPictureMap;
	$sqla.=",".TABLE_MOD_PROJECT."_MapLogo ";       $sqlb.=",? ";         $arSQLData[]=$inputMapLogo;
	$sqla.=",".TABLE_MOD_PROJECT."_HTML ";          $sqlb.=",? ";         $arSQLData[]=$inputHTML;
	$sqla.=",".TABLE_MOD_PROJECT."_Description ";   $sqlb.=",? ";         $arSQLData[]=$inputDescription;
	$sqla.=",".TABLE_MOD_PROJECT."_LocationName ";  $sqlb.=",? ";         $arSQLData[]=$inputLocationName;
	for($i=0;$i<sizeof($arFacilityKey);$i++) {
		if(trim(urldecode($SendRequest['inputFacility'.$arFacilityKey[$i]]))=="Yes") {
			$sqla.=",".TABLE_MOD_PROJECT."_Facility".$arFacilityKey[$i]." "; $sqlb.=",? "; $arSQLData[]="Yes";
		} else {
			$sqla.=",".TABLE_MOD_PROJECT."_Facility".$arFacilityKey[$i]." "; $sqlb.=",? "; $arSQLData[]="No";
		}
	}
	for($i=0;$i<sizeof($arAssetTypeKey);$i++) {
		if(trim(urldecode($SendRequest['inputAssetType'.$arAssetTypeKey[$i]]))=="Yes") {
			$sqla.=",".TABLE_MOD_PROJECT."_AssetType".$arAssetTypeKey[$i]." "; $sqlb.=",? "; $arSQLData[]="Yes";
		} else {
			$sqla.=",".TABLE_MOD_PROJECT."_AssetType".$arAssetTypeKey[$i]." "; $sqlb.=",? "; $arSQLData[]="No";
		}
	}
	for($i=0;$i<sizeof($arAssetTypeKey);$i++) {
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_BedRoom']))*1>0) {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BedRoom "; $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_BedRoom']))*1;
		} else {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BedRoom "; $sqlb.=",? "; $arSQLData[]=0;
		}
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_BathRoom']))*1>0) {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BathRoom "; $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_BathRoom']))*1;
		} else {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BathRoom "; $sqlb.=",? "; $arSQLData[]=0;
		}
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_CarPark']))*1>0) {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_CarPark "; $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_CarPark']))*1;
		} else {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_CarPark "; $sqlb.=",? "; $arSQLData[]=0;
		}
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_LivingSpace']))*1>0) {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_LivingSpace "; $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_LivingSpace']))*1;
		} else {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_LivingSpace "; $sqlb.=",? "; $arSQLData[]=0;
		}
		if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_AssetPicture']))<>"") {
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_AssetPicture "; $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_AssetPicture']));
		}
		for($x=1;$x<=5;$x++) {
			if(trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_Plan'.$x.'Picture']))<>"") {
				$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_Plan".$x."Picture ";  $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_Plan'.$x.'Picture']));
			}
			$sqla.=",".TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_Plan".$x."Name ";     $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['input'.$arAssetTypeKey[$i].'_Plan'.$x.'Name']));
		}
	}
	for($x=1;$x<=3;$x++) {
		if(trim(urldecode($SendRequest['inputHero'.$x]))<>"") {
			$sqla.=",".TABLE_MOD_PROJECT."_Hero".$x." "; $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['inputHero'.$x]));
		}
	}
	for($x=1;$x<=17;$x++) {
		if(trim(urldecode($SendRequest['inputGallery'.$x]))<>"") {
			$sqla.=",".TABLE_MOD_PROJECT."_Gallery".$x." "; $sqlb.=",? "; $arSQLData[]=trim(urldecode($SendRequest['inputGallery'.$x]));
		}
	}
	$sqla.=",".TABLE_MOD_PROJECT."_GoogleMapLink ";         $sqlb.=",? ";         $arSQLData[]=$inputGoogleMapLink;
	for($x=1;$x<=8;$x++) { 
		$sqla.=",".TABLE_MOD_PROJECT."_Location".$x."Name ";     $sqlb.=",? ";         $arSQLData[]=trim(urldecode($SendRequest['inputLocation'.$x.'Name']));
		$sqla.=",".TABLE_MOD_PROJECT."_Location".$x."Min ";      $sqlb.=",? ";         $arSQLData[]=trim(urldecode($SendRequest['inputLocation'.$x.'Min']));
		$sqla.=",".TABLE_MOD_PROJECT."_Location".$x."Percent ";  $sqlb.=",? ";         $arSQLData[]=trim(urldecode($SendRequest['inputLocation'.$x.'Percent']));
	}
	$sqla.=",".TABLE_MOD_PROJECT."_CreateDate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_PROJECT."_CreateByID ";    $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_PROJECT."_LastUpdate ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;
	$sqla.=",".TABLE_MOD_PROJECT."_LastUpdateByID"; $sqlb.=",? ";         $arSQLData[]=$SystemSession_Staff_ID;
	$sqla.=",".TABLE_MOD_PROJECT."_Status ";        $sqlb.=",? ";         $arSQLData[]="Enable";
	$sqla.=",".TABLE_MOD_PROJECT."_IsRegisterOn ";  $sqlb.=",? ";         $arSQLData[]=$inputIsRegisterOn;
	$sql=$sqla.$sqlb.$sqlc;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$myInsertID = $System_Connection->lastInsertId();
	$DataField["InsertID"]=$myInsertID;
	//-------------------------------------------------
	if($myInsertID>0) {
		$arSQLData=array();
		$sql =" UPDATE ".TABLE_MOD_PROJECT." SET "; 
		$sql.=" ".TABLE_MOD_PROJECT."_Order=? ";      $arSQLData[]=$myInsertID;
		$sql.=" WHERE ".TABLE_MOD_PROJECT."_ID=? ";   $arSQLData[]=$myInsertID;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	}
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