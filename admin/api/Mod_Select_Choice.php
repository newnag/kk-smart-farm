<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$sql =" SELECT * FROM ".TABLE_MOD_CATEGORY." WHERE ".TABLE_MOD_CATEGORY."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataC = array();
    $dataC["id"] = $Row[TABLE_MOD_CATEGORY."_id"];
    $dataC["name"]=$Row[TABLE_MOD_CATEGORY."_name"] ;

    $arrC[] = $dataC;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$sql =" SELECT * FROM ".TABLE_MOD_SUBCATEGORY." JOIN ".TABLE_MOD_THUMBNAIL." ON ".TABLE_MOD_THUMBNAIL."_subID = ".TABLE_MOD_SUBCATEGORY."_id  WHERE ".TABLE_MOD_SUBCATEGORY."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataS = array();
    $dataS["id"] = $Row[TABLE_MOD_SUBCATEGORY."_id"];
    $dataS["cateID"]=$Row[TABLE_MOD_SUBCATEGORY."_cateID"] ;
    $dataS["cateName"]=$Row[TABLE_MOD_SUBCATEGORY."_cateName"] ;
    $dataS["name"]=$Row[TABLE_MOD_SUBCATEGORY."_name"] ;
    if($Row[TABLE_MOD_THUMBNAIL."_Picture"]<>"") {
			$dataS["Picture"]=SYSTEM_FULLPATH_UPLOAD."mod_thumbnail/".$Row[TABLE_MOD_THUMBNAIL."_picture"];
		} else {
			$dataS["Picture"]=CONFIG_DEFAULT_THUMB_USER;
		}
    //$dataS["picture"]=$Row[TABLE_MOD_THUMBNAIL."_picture"] ;

    $arrS[] = $dataS;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
try {
	$sql =" SELECT * FROM ".TABLE_MOD_CHOICE." WHERE ".TABLE_MOD_CHOICE."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataQ = array();
    $dataQ["id"] = $Row[TABLE_MOD_CHOICE."_id"];
    $dataQ["name"]=$Row[TABLE_MOD_CHOICE."_name"] ;

    $arrQ[] = $dataQ;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
// try {
// 	$sql =" SELECT * FROM ".TABLE_MOD_LIVESTOCK." WHERE ".TABLE_MOD_LIVESTOCK."_status<>'Deleted' ";
// 	$Query=$System_Connection->prepare($sql);
// 	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
// 	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
//     $dataL = array();
//     $dataL["id"] = $Row[TABLE_MOD_LIVESTOCK."_id"];
//     $dataL["name"]=$Row[TABLE_MOD_LIVESTOCK."_name"] ;
//     $dataL["type"]=$Row[TABLE_MOD_LIVESTOCK."_type"] ;
//     $dataL["gene"]=$Row[TABLE_MOD_LIVESTOCK."_gene"] ;
//     $dataL["microchip"]=$Row[TABLE_MOD_LIVESTOCK."_microchipNo"] ;
//     $dataL["DOB"]=$Row[TABLE_MOD_LIVESTOCK."_DOB"] ;
//     $dataL["age"]=$Row[TABLE_MOD_LIVESTOCK."_age"] ;
//     $dataL["sex"]=$Row[TABLE_MOD_LIVESTOCK."_sex"] ;
//     $dataL["weight"]=$Row[TABLE_MOD_LIVESTOCK."_weight"] ;
//     $dataL["healthStatus"]=$Row[TABLE_MOD_LIVESTOCK."_healthStatus"] ;

//     $arrL[] = $dataL;
//   }
// } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
    $Result["ResultCate"]=$arrC;
    $Result["ResultSub"]=$arrS;
    $Result["ResultChoice"]=$arrQ;
    // $Result["ResultLivestock"]=$arrL;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>