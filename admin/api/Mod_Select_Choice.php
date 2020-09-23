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
	$sql =" SELECT * FROM ".TABLE_MOD_SUBCATEGORY." WHERE ".TABLE_MOD_SUBCATEGORY."_status<>'Deleted' ";
	$Query=$System_Connection->prepare($sql);
	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
    $dataS = array();
    $dataS["id"] = $Row[TABLE_MOD_SUBCATEGORY."_id"];
    $dataS["cateID"]=$Row[TABLE_MOD_SUBCATEGORY."_cateID"] ;
    $dataS["cateName"]=$Row[TABLE_MOD_SUBCATEGORY."_cateName"] ;
    $dataS["name"]=$Row[TABLE_MOD_SUBCATEGORY."_name"] ;
    $dataS["thumbnail"]=$Row[TABLE_MOD_SUBCATEGORY."_thumbnail"] ;

    $arrS[] = $dataS;
  }
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
// try {
// 	$sql =" SELECT * FROM ".TABLE_MOD_SUBCATEGORY." WHERE ".TABLE_MOD_SUBCATEGORY."_status<>'Deleted' ";
// 	$Query=$System_Connection->prepare($sql);
// 	if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
// 	while($Row=$Query->fetch(PDO::FETCH_ASSOC)) {
//     $dataQ = array();
//     $dataQ["id"] = $Row[TABLE_MOD_SUBCATEGORY."_id"];
//     $dataQ["name"]=$Row[TABLE_MOD_SUBCATEGORY."_name"] ;
//     $dataQ["cateID"]=$Row[TABLE_MOD_SUBCATEGORY."_cateID"] ;
//     $dataQ["cateName"]=$Row[TABLE_MOD_SUBCATEGORY."_cateName"] ;
//     $dataQ["thumbnail"]=$Row[TABLE_MOD_SUBCATEGORY."_thumbnail"] ;

//     $arrQ[] = $dataQ;
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
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>