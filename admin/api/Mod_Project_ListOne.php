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
$myID = trim(urldecode($SendRequest['inputID']))*1;

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$counter=0; $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_MOD_PROJECT." WHERE ".TABLE_MOD_PROJECT."_ID=? "; $arSQLData[]=$myID;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
	$DataField=array();
	$DataField["ID"]=$Row[TABLE_MOD_PROJECT."_ID"];
	$DataField["Name"]=$Row[TABLE_MOD_PROJECT."_Name"];
	$DataField["HTML"]=$Row[TABLE_MOD_PROJECT."_HTML"];
	$DataField["Description"]=$Row[TABLE_MOD_PROJECT."_Description"];
	$DataField["LocationName"]=$Row[TABLE_MOD_PROJECT."_LocationName"];
	if($Row[TABLE_MOD_PROJECT."_Picture"]<>"") {
		$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_project/".$Row[TABLE_MOD_PROJECT."_Picture"];
		$DataField["Picture-Thumb"]=SYSTEM_FULLPATH_UPLOAD."mod_project/thumb-".$Row[TABLE_MOD_PROJECT."_Picture"];
	} else {
		$DataField["Picture"]=CONFIG_DEFAULT_THUMB_PICTURE;
		$DataField["Picture-Thumb"]=CONFIG_DEFAULT_THUMB_PICTURE;
	}
	if($Row[TABLE_MOD_PROJECT."_PictureMap"]<>"") {
		$DataField["PictureMap"]=SYSTEM_FULLPATH_UPLOAD."mod_project/".$Row[TABLE_MOD_PROJECT."_PictureMap"];
	} else {
		$DataField["PictureMap"]=CONFIG_DEFAULT_THUMB_PICTURE;
	}
	if($Row[TABLE_MOD_PROJECT."_MapLogo"]<>"") {
		$DataField["MapLogo"]=SYSTEM_FULLPATH_UPLOAD."mod_project/".$Row[TABLE_MOD_PROJECT."_MapLogo"];
	} else {
		$DataField["MapLogo"]=CONFIG_DEFAULT_THUMB_PICTURE;
	}
	for($i=0;$i<sizeof($arFacilityKey);$i++) {
		if($Row[TABLE_MOD_PROJECT."_Facility".$arFacilityKey[$i]]=="Yes") {
			$DataField["Facility".$arFacilityKey[$i]]="Yes";
		} else {
			$DataField["Facility".$arFacilityKey[$i]]="No";
		}
	}
	for($i=0;$i<sizeof($arAssetTypeKey);$i++) {
		if($Row[TABLE_MOD_PROJECT."_AssetType".$arAssetTypeKey[$i]]=="Yes") {
			$DataField["AssetType".$arAssetTypeKey[$i]]="Yes";
			$DataField[$arAssetTypeKey[$i]."_BedRoom"]=$Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BedRoom"];
			$DataField[$arAssetTypeKey[$i]."_BathRoom"]=$Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_BathRoom"];
			$DataField[$arAssetTypeKey[$i]."_CarPark"]=$Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_CarPark"];
			$DataField[$arAssetTypeKey[$i]."_LivingSpace"]=$Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_LivingSpace"];
			if($Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_AssetPicture"]<>"") {
				$DataField[$arAssetTypeKey[$i]."_AssetPicture"]=SYSTEM_FULLPATH_UPLOAD."mod_project/".$Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_AssetPicture"];
			} else {
				$DataField[$arAssetTypeKey[$i]."_AssetPicture"]=CONFIG_DEFAULT_THUMB_PICTURE;
			}
			for($x=1;$x<=5;$x++) {
				if($Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_Plan".$x."Picture"]<>"") { 
					$DataField[$arAssetTypeKey[$i]."_Plan".$x."Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_project/".$Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_Plan".$x."Picture"];
				} else {
					$DataField[$arAssetTypeKey[$i]."_Plan".$x."Picture"]=CONFIG_DEFAULT_THUMB_PICTURE;
				}
				$DataField[$arAssetTypeKey[$i]."_Plan".$x."Name"]=$Row[TABLE_MOD_PROJECT."_".$arAssetTypeKey[$i]."_Plan".$x."Name"];
			}
		} else {
			$DataField["AssetType".$arAssetTypeKey[$i]]="No";
		}
	}
	for($x=1;$x<=3;$x++) {
		if($Row[TABLE_MOD_PROJECT."_Hero".$x]<>"") {
			$DataField["Hero".$x]=SYSTEM_FULLPATH_UPLOAD."mod_project/".$Row[TABLE_MOD_PROJECT."_Hero".$x];
		} else {
			$DataField["Hero".$x]="";
		}
	}
	for($x=1;$x<=17;$x++) {
		if($Row[TABLE_MOD_PROJECT."_Gallery".$x]<>"") {
			$DataField["Gallery".$x]=SYSTEM_FULLPATH_UPLOAD."mod_project/".$Row[TABLE_MOD_PROJECT."_Gallery".$x];
			$DataField["Gallery".$x."-Thumb"]=SYSTEM_FULLPATH_UPLOAD."mod_project/thumb-".$Row[TABLE_MOD_PROJECT."_Gallery".$x];
		} else {
			$DataField["Gallery".$x]="";
			$DataField["Gallery".$x."-Thumb"]="";
		}
		
	}
	$DataField["GoogleMapLink"]=$Row[TABLE_MOD_PROJECT."_GoogleMapLink"];
	for($x=1;$x<=8;$x++) {
		if($Row[TABLE_MOD_PROJECT."_Location".$x."Name"]<>"") {
			$DataField["Location".$x."Name"]=$Row[TABLE_MOD_PROJECT."_Location".$x."Name"];
			$DataField["Location".$x."Min"]=$Row[TABLE_MOD_PROJECT."_Location".$x."Min"];
			$DataField["Location".$x."Percent"]=$Row[TABLE_MOD_PROJECT."_Location".$x."Percent"];
		} else {
			$DataField["Location".$x."Name"]="";
			$DataField["Location".$x."Min"]=0;
			$DataField["Location".$x."Percent"]=100;
		}
	}
	$DataField["Status"]=$Row[TABLE_MOD_PROJECT."_Status"];
	$DataField["IsRegisterOn"]=$Row[TABLE_MOD_PROJECT."_IsRegisterOn"];
	$counter++;
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Result"]=$DataField;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>