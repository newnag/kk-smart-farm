<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Input
#-------------------------------------------------------------------
$inputThemeBG = trim(urldecode($SendRequest['inputThemeBG']));
$inputThemeLevel = trim(urldecode($SendRequest['inputThemeLevel']));
$inputThemeDarkOrLight = trim(urldecode($SendRequest['inputThemeDarkOrLight']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
$key='ThemeBG';
try {
	if($inputThemeBG<>"") {
		//---------------------------------------------
		$arSQLData=array();
		$sql =" SELECT ".TABLE_SYSTEM_SETTING."_ID FROM ".TABLE_SYSTEM_SETTING." WHERE ".TABLE_SYSTEM_SETTING."_Key=? LIMIT 0,1 "; $arSQLData[]=$key;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$Rows=$Query->fetchAll();
		$myID=$Rows[0][TABLE_SYSTEM_SETTING."_ID"]*1;
		//---------------------------------------------
		if($myID>0) { // update
			$arSQLData=array();
			$sql =" UPDATE ".TABLE_SYSTEM_SETTING." SET ".TABLE_SYSTEM_SETTING."_Value=? "; $arSQLData[]=$inputThemeBG;
			$sql.=" WHERE ".TABLE_SYSTEM_SETTING."_ID=? "; $arSQLData[]=$myID;
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		} else { // insert
			$DataField=array(); $arSQLData=array();
			$sqla =" INSERT INTO ".TABLE_SYSTEM_SETTING."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
			$sqla.=" ".TABLE_SYSTEM_SETTING."_Value ";         $sqlb.=" ? ";         $arSQLData[]=$inputThemeBG;
			$sqla.=",".TABLE_SYSTEM_SETTING."_Key ";           $sqlb.=",? ";         $arSQLData[]=$key;
			$sqla.=",".TABLE_SYSTEM_SETTING."_Type ";          $sqlb.=",? ";         $arSQLData[]="Public";
			$sql=$sqla.$sqlb.$sqlc;
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		}
	}
	//---------------------------------------------
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
$key='ThemeLevel';
try {
	if($inputThemeLevel<>"") {
		//---------------------------------------------
		$arSQLData=array();
		$sql =" SELECT ".TABLE_SYSTEM_SETTING."_ID FROM ".TABLE_SYSTEM_SETTING." WHERE ".TABLE_SYSTEM_SETTING."_Key=? LIMIT 0,1 "; $arSQLData[]=$key;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$Rows=$Query->fetchAll();
		$myID=$Rows[0][TABLE_SYSTEM_SETTING."_ID"]*1;
		//---------------------------------------------
		if($myID>0) { // update
			$arSQLData=array();
			$sql =" UPDATE ".TABLE_SYSTEM_SETTING." SET ".TABLE_SYSTEM_SETTING."_Value=? "; $arSQLData[]=$inputThemeLevel;
			$sql.=" WHERE ".TABLE_SYSTEM_SETTING."_ID=? "; $arSQLData[]=$myID;
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		} else { // insert
			$DataField=array(); $arSQLData=array();
			$sqla =" INSERT INTO ".TABLE_SYSTEM_SETTING."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
			$sqla.=" ".TABLE_SYSTEM_SETTING."_Value ";         $sqlb.=" ? ";         $arSQLData[]=$inputThemeLevel;
			$sqla.=",".TABLE_SYSTEM_SETTING."_Key ";           $sqlb.=",? ";         $arSQLData[]=$key;
			$sqla.=",".TABLE_SYSTEM_SETTING."_Type ";          $sqlb.=",? ";         $arSQLData[]="Public";
			$sql=$sqla.$sqlb.$sqlc;
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		}
	}
	//---------------------------------------------
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
$key='ThemeDarkOrLight';
try {
	if($inputThemeDarkOrLight<>"") {
		//---------------------------------------------
		$arSQLData=array();
		$sql =" SELECT ".TABLE_SYSTEM_SETTING."_ID FROM ".TABLE_SYSTEM_SETTING." WHERE ".TABLE_SYSTEM_SETTING."_Key=? LIMIT 0,1 "; $arSQLData[]=$key;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$Rows=$Query->fetchAll();
		$myID=$Rows[0][TABLE_SYSTEM_SETTING."_ID"]*1;
		//---------------------------------------------
		if($myID>0) { // update
			$arSQLData=array();
			$sql =" UPDATE ".TABLE_SYSTEM_SETTING." SET ".TABLE_SYSTEM_SETTING."_Value=? "; $arSQLData[]=$inputThemeDarkOrLight;
			$sql.=" WHERE ".TABLE_SYSTEM_SETTING."_ID=? "; $arSQLData[]=$myID;
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		} else { // insert
			$DataField=array(); $arSQLData=array();
			$sqla =" INSERT INTO ".TABLE_SYSTEM_SETTING."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
			$sqla.=" ".TABLE_SYSTEM_SETTING."_Value ";         $sqlb.=" ? ";         $arSQLData[]=$inputThemeDarkOrLight;
			$sqla.=",".TABLE_SYSTEM_SETTING."_Key ";           $sqlb.=",? ";         $arSQLData[]=$key;
			$sqla.=",".TABLE_SYSTEM_SETTING."_Type ";          $sqlb.=",? ";         $arSQLData[]="Public";
			$sql=$sqla.$sqlb.$sqlc;
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		}
	}
	//---------------------------------------------
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "แก้ไขข้อมูลสำเร็จ";
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>