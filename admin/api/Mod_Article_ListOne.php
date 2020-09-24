<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$myID = trim(urldecode($SendRequest['inputID']))*1;
$inputType = trim(urldecode($SendRequest["inputType"]));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
if($inputType === "News"){
	try {
		$counter=0; $arSQLData=array();
		$sql =" SELECT * FROM ".TABLE_MOD_ARTICLE." WHERE ".TABLE_MOD_ARTICLE."_ID=? AND ".TABLE_MOD_ARTICLE."_Type = 'News'"; $arSQLData[]=$myID;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$Rows=$Query->fetchAll();
		$Row=$Rows[0];
		$DataField=array();
		$DataField["ID"]=$Row[TABLE_MOD_ARTICLE."_ID"];
		$DataField["Name"]=$Row[TABLE_MOD_ARTICLE."_Name"];
		$DataField["HTML"]=$Row[TABLE_MOD_ARTICLE."_HTML"];
		$DataField["Type"]=$Row[TABLE_MOD_ARTICLE."_Type"];
		$DataField["source"]=$Row[TABLE_MOD_ARTICLE."_source"];
		if($Row[TABLE_MOD_ARTICLE."_Picture"]<>"") {
			$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_article/".$Row[TABLE_MOD_ARTICLE."_Picture"];
			$DataField["Picture-Thumb"]=SYSTEM_FULLPATH_UPLOAD."mod_article/thumb-".$Row[TABLE_MOD_ARTICLE."_Picture"];
		} else {
			$DataField["Picture"]=CONFIG_DEFAULT_THUMB_PICTURE;
			$DataField["Picture-Thumb"]=CONFIG_DEFAULT_THUMB_PICTURE;
		}
		$DataField["Status"]=$Row[TABLE_MOD_ARTICLE."_Status"];
		$counter++;
	} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}
elseif($inputType === "BodyCon"){
	try {
		$counter=0; $arSQLData=array();
		$sql =" SELECT * FROM ".TABLE_MOD_ARTICLE." WHERE ".TABLE_MOD_ARTICLE."_ID=? AND ".TABLE_MOD_ARTICLE."_Type = 'BodyCondition'"; $arSQLData[]=$myID;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$Rows=$Query->fetchAll();
		$Row=$Rows[0];
		$DataField=array();
		$DataField["ID"]=$Row[TABLE_MOD_ARTICLE."_ID"];
		$DataField["Name"]=$Row[TABLE_MOD_ARTICLE."_Name"];
		$DataField["HTML"]=$Row[TABLE_MOD_ARTICLE."_HTML"];
		$DataField["Type"]=$Row[TABLE_MOD_ARTICLE."_Type"];
		if($Row[TABLE_MOD_ARTICLE."_Picture"]<>"") {
			$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_article/".$Row[TABLE_MOD_ARTICLE."_Picture"];
			$DataField["Picture-Thumb"]=SYSTEM_FULLPATH_UPLOAD."mod_article/thumb-".$Row[TABLE_MOD_ARTICLE."_Picture"];
		} else {
			$DataField["Picture"]=CONFIG_DEFAULT_THUMB_PICTURE;
			$DataField["Picture-Thumb"]=CONFIG_DEFAULT_THUMB_PICTURE;
		}
		$DataField["Status"]=$Row[TABLE_MOD_ARTICLE."_Status"];
		$counter++;
	} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}
elseif($inputType === "Nutrition"){
	try {
		$counter=0; $arSQLData=array();
		$sql =" SELECT * FROM ".TABLE_MOD_ARTICLE." WHERE ".TABLE_MOD_ARTICLE."_ID=? AND ".TABLE_MOD_ARTICLE."_Type = 'Nutrition'"; $arSQLData[]=$myID;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$Rows=$Query->fetchAll();
		$Row=$Rows[0];
		$DataField=array();
		$DataField["ID"]=$Row[TABLE_MOD_ARTICLE."_ID"];
		$DataField["Name"]=$Row[TABLE_MOD_ARTICLE."_Name"];
		$DataField["Title"]=$Row[TABLE_MOD_ARTICLE."_Title"];
		$DataField["HTML"]=$Row[TABLE_MOD_ARTICLE."_HTML"];
		$DataField["Type"]=$Row[TABLE_MOD_ARTICLE."_Type"];
		if($Row[TABLE_MOD_ARTICLE."_Picture"]<>"") {
			$DataField["Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_article/".$Row[TABLE_MOD_ARTICLE."_Picture"];
			$DataField["Picture-Thumb"]=SYSTEM_FULLPATH_UPLOAD."mod_article/thumb-".$Row[TABLE_MOD_ARTICLE."_Picture"];
		} else {
			$DataField["Picture"]=CONFIG_DEFAULT_THUMB_PICTURE;
			$DataField["Picture-Thumb"]=CONFIG_DEFAULT_THUMB_PICTURE;
		}
		$DataField["Status"]=$Row[TABLE_MOD_ARTICLE."_Status"];
		$counter++;
	} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}


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