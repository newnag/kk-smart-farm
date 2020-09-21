<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Input
#-------------------------------------------------------------------
	$inputUser=$SendRequest["inputUser"];
	$inputPassword=$SendRequest["inputPassword"];

#-------------------------------------------------------------------
# PROCESS - Type to Signin
#-------------------------------------------------------------------
try {
	$sql = " SELECT * FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_Status='Enable' ";
	$sql.= " AND ".TABLE_SYSTEM_STAFF."_User = ? "; $arSQLData[] = $inputUser;
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
	$Rows=$Query->fetchAll();
	$Row=$Rows[0];
	if(!is_array($Row)) {
		//-------------------------------------------------
		$Result["Status"] 			= 	"Error";
		$Result["Message"] 			= 	"ไม่พบ Username นี้";
		//-------------------------------------------------
	} else {
		if($Row[TABLE_SYSTEM_STAFF."_Pass"]==$inputPassword || $Row[TABLE_SYSTEM_STAFF."_Pass"]=="") {
			$myID=$Row[TABLE_SYSTEM_STAFF."_ID"];
			$DataField=array();
			$DataField["ID"]			=	$Row[TABLE_SYSTEM_STAFF."_ID"];
			$DataField["User"]			=	$Row[TABLE_SYSTEM_STAFF."_User"];
			$DataField["Email"]			=	$Row[TABLE_SYSTEM_STAFF."_Email"];
			$DataField["Phone"]			=	$Row[TABLE_SYSTEM_STAFF."_Phone"];
			if($Row[TABLE_SYSTEM_STAFF."_Picture"]<>"") {
				$DataField["Picture"]	= SYSTEM_FULLPATH_UPLOAD.'system_staff/'.$Row[TABLE_SYSTEM_STAFF."_Picture"];
			} else {
				$DataField["Picture"]	= CONFIG_DEFAULT_THUMB_USER;
			}
			//-------------------------------------------------
			$LastToken=System_GenToken($myID);
			$DataField["Token"]			=	$LastToken;
			//-------------------------------------------------
			$arSQLData=array();
			$sql =" UPDATE ".TABLE_SYSTEM_STAFF." SET "; 
			$sql.=" ".TABLE_SYSTEM_STAFF."_LastToken=? ";      $arSQLData[]=$LastToken;
			$sql.=",".TABLE_SYSTEM_STAFF."_LastLoginDate=? ";  $arSQLData[]=SYSTEM_DATETIMENOW;
			$sql.=",".TABLE_SYSTEM_STAFF."_LastUpdateByID=? "; $arSQLData[]=$myID;
			$sql.=" WHERE ".TABLE_SYSTEM_STAFF."_ID=? ";       $arSQLData[]=$myID;
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
			//-------------------------------------------------
			$DataSettingRow=array();
			$sql =" SELECT * FROM ".TABLE_SYSTEM_SETTING." WHERE ".TABLE_SYSTEM_SETTING."_Type='Public' ";
			$Query=$System_Connection->prepare($sql);
			if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
			while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
				$DataSetting=array();
				$DataSetting["Key"]=$Row[TABLE_SYSTEM_SETTING."_Key"];
				$DataSetting["Value"]=$Row[TABLE_SYSTEM_SETTING."_Value"];
				$DataSettingRow[]=$DataSetting;
			}
			//-------------------------------------------------
			$Result["Status"] 			= 	"Success";
			$Result["Message"] 			= 	"เข้าสู่ระบบเรียบร้อย";
			$Result["Result"]			=	$DataField;
			$Result["Setting"]			=	$DataSettingRow;
			//-------------------------------------------------
		} else {
			//-------------------------------------------------
			$Result["Status"] 			= 	"Error";
			$Result["Message"] 			= 	"รหัสผ่านไม่ถูกต้อง";
			//-------------------------------------------------			
		}
	}
} catch(PDOException $e) { 			
	$ErrorMessage			=	$e->getMessage(); 	
	//-------------------------------------------------
	$Result["Status"] 		= 	"Error";
	$Result["Message"] 		= 	$ErrorMessage;
	//-------------------------------------------------
}
?>