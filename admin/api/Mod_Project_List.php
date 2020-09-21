<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

global $arFacilityKey,$arFacilityName,$arAssetTypeKey,$arAssetTypeName;

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
$arCheck=array("ID","LastUpdate","Order");
if(!in_array($SendRequest["inputShowOrderBy"],$arCheck)) { $SendRequest["inputShowOrderBy"]="Order"; }
$arCheck=array("ASC","DESC");
if(!in_array($SendRequest["inputShowASCDESC"],$arCheck)) { $SendRequest["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$arUserNameByID=array();
	$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_Status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); };
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
		$arUserNameByID[$Row[TABLE_SYSTEM_STAFF."_ID"]]=$Row[TABLE_SYSTEM_STAFF."_User"];
	}
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
#-------------------------------------------------------------------
try {
	$arSQLData=array();
	$sql =" SELECT COUNT(*) AS Counter FROM ".TABLE_MOD_PROJECT." WHERE ".TABLE_MOD_PROJECT."_Status='Enable' ";
	if($SendRequest["inputShowSearch"]<>"") {
		$sql.=" AND ( ".TABLE_MOD_PROJECT."_Description LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
		$sql.=" OR ".TABLE_MOD_PROJECT."_Name LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
		$sql.=" ) ";
	}
	if($SendRequest["inputTypeSearch"]<>"") {
		$sql.=" AND ".TABLE_MOD_PROJECT."_AssetType".$SendRequest["inputTypeSearch"]." = 'Yes' ";
	}
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$totalrecord=$Rows[0]["Counter"];
	if($totalrecord>0) { $maxpage=ceil($totalrecord/$SendRequest["inputShowPageSize"]); } else { $maxpage=1; }
	$DataHeader["Page"]=$SendRequest["inputShowPage"];
	$DataHeader["PageSize"]=$SendRequest["inputShowPageSize"];
	$DataHeader["MaxPage"]=$maxpage;
	$DataHeader["TotalRecord"]=$totalrecord;
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$counter=0; $arSQLData=array();
	$sql =" SELECT * FROM ".TABLE_MOD_PROJECT." WHERE ".TABLE_MOD_PROJECT."_Status='Enable' ";
	if($SendRequest["inputShowSearch"]<>"") {
		$sql.=" AND ( ".TABLE_MOD_PROJECT."_Description LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
		$sql.=" OR ".TABLE_MOD_PROJECT."_Name LIKE ? "; $arSQLData[]='%'.$SendRequest["inputShowSearch"].'%';
		$sql.=" ) ";
	}	
	if($SendRequest["inputTypeSearch"]<>"") {
		$sql.=" AND ".TABLE_MOD_PROJECT."_AssetType".$SendRequest["inputTypeSearch"]." = 'Yes' ";
	}
	$sql.=" ORDER BY ".TABLE_MOD_PROJECT."_".$SendRequest["inputShowOrderBy"]." ".$SendRequest["inputShowASCDESC"];
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
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
		$DataField["CreateDate"]=$Row[TABLE_MOD_PROJECT."_CreateDate"];
		$DataField["CreateByID"]=$Row[TABLE_MOD_PROJECT."_CreateByID"];
		$DataField["CreateByName"]=$arUserNameByID[$Row[TABLE_MOD_PROJECT."_CreateByID"]];
		$DataField["LastUpdate"]=$Row[TABLE_MOD_PROJECT."_LastUpdate"];
		$DataField["LastUpdateByID"]=$Row[TABLE_MOD_PROJECT."_LastUpdateByID"];
		$DataField["LastUpdateByName"]=$arUserNameByID[$Row[TABLE_MOD_PROJECT."_LastUpdateByID"]];
		$DataField["Order"]=$Row[TABLE_MOD_PROJECT."_Order"];
		$DataField["Status"]=$Row[TABLE_MOD_PROJECT."_Status"];
		$DataField["IsRegisterOn"]=$Row[TABLE_MOD_PROJECT."_IsRegisterOn"];
		$DataRow[]=$DataField;
		$counter++;
	}
	$DataHeader["NoOfReturn"]=$counter;
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Header"]=$DataHeader;
	$Result["Result"]=$DataRow;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>