<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# Input
#-------------------------------------------------------------------
	$inputUser=$SendRequest["inputEmail"];
	$inputPassword=hash('sha256',SYSTEM_AUTHEN_KEY.$SendRequest["inputPassword"].SYSTEM_AUTHEN_KEY);

#-------------------------------------------------------------------
# PROCESS - Type to Signin
#-------------------------------------------------------------------
try {
	$sql = " SELECT * FROM ".TABLE_MOD_USERFARM." WHERE ".TABLE_MOD_USERFARM."_Status='Enable' ";
	$sql.= " AND ".TABLE_MOD_USERFARM."_email = ? "; $arSQLData[] = $inputUser;
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
		if($Row[TABLE_MOD_USERFARM."_password"]==$inputPassword) {
			$myID=$Row[TABLE_MOD_USERFARM."_ID"];
			$DataField=array();
			$DataField["ID"]			=	$Row[TABLE_MOD_USERFARM."_id"];
			//$DataField["User"]			=	$Row[TABLE_MOD_USERFARM."_user"];
			$DataField["Email"]			=	$Row[TABLE_MOD_USERFARM."_email"];
			// $DataField["Phone"]			=	$Row[TABLE_MOD_USERFARM."_Phone"];
			
			//-------------------------------------------------
			$LastToken=System_GenToken($myID);
			$DataField["Token"]			=	$LastToken;
			//-------------------------------------------------
			// $arSQLData=array();
			// $sql =" UPDATE ".TABLE_MOD_USERFARM." SET "; 
			// $sql.=" ".TABLE_MOD_USERFARM."_LastToken=? ";      $arSQLData[]=$LastToken;
			// $sql.=",".TABLE_MOD_USERFARM."_LastLoginDate=? ";  $arSQLData[]=SYSTEM_DATETIMENOW;
			// $sql.=",".TABLE_MOD_USERFARM."_LastUpdateByID=? "; $arSQLData[]=$myID;
			// $sql.=" WHERE ".TABLE_MOD_USERFARM."_ID=? ";       $arSQLData[]=$myID;
			// $Query=$System_Connection->prepare($sql);
			// if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
			//-------------------------------------------------
			// $DataSettingRow=array();
			// $sql =" SELECT * FROM ".TABLE_SYSTEM_SETTING." WHERE ".TABLE_SYSTEM_SETTING."_Type='Public' ";
			// $Query=$System_Connection->prepare($sql);
			// if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
			// while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
			// 	$DataSetting=array();
			// 	$DataSetting["Key"]=$Row[TABLE_SYSTEM_SETTING."_Key"];
			// 	$DataSetting["Value"]=$Row[TABLE_SYSTEM_SETTING."_Value"];
			// 	$DataSettingRow[]=$DataSetting;
			// }
			//-------------------------------------------------
			$Result["Status"] 			= 	"Success";
			$Result["Message"] 			= 	"เข้าสู่ระบบเรียบร้อย";
			$Result["Result"]			=	$DataField;
			// $Result["Setting"]			=	$DataSettingRow;
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