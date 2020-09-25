<?php

include("./config/function.php");

#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------

$inputUser = trim(urldecode($SendRequest['inputUser']));
$inputImage = trim(urldecode($SendRequest['inputImage']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

	try {
		$key = 'Image';
		$inputImage = System_UploadPicture($key,'Mod_Upload');
		$DataField=array(); $arSQLData=array();
		$sqla =" INSERT INTO ".TABLE_MOD_UPLOADPIC."( ";  $sqlb =" ) VALUES(";  $sqlc =" ) ";
		$sqla.=" ".TABLE_MOD_UPLOADPIC."_userID ";          $sqlb.=" ? ";         $arSQLData[]=$inputUser;
		$sqla.=",".TABLE_MOD_UPLOADPIC."_image ";       $sqlb.=",? ";         $arSQLData[]=$inputImage;
		$sqla.=",".TABLE_MOD_UPLOADPIC."_date ";    $sqlb.=",? ";         $arSQLData[]=SYSTEM_DATETIMENOW;

		$sql=$sqla.$sqlb.$sqlc;
		$Query=$System_Connection->prepare($sql);
		if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }
		$myInsertID = $System_Connection->lastInsertId();
		$DataField["InsertID"]=$myInsertID; 
		$DataField["URL"]=SYSTEM_FULLPATH_UPLOAD."Mod_Upload/".$inputImage; 
		

		
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