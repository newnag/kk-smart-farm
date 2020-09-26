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
$ownerID = trim(urldecode($SendRequest['inputOwnerID']));

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------
if($ownerID == ''){
  try {
    $counter=0; $arSQLData=array();
    $sql =" SELECT * FROM ".TABLE_MOD_FARM." WHERE ".TABLE_MOD_FARM."_ID=? "; $arSQLData[]=$myID;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
    $Rows=$Query->fetchAll();
    $Row=$Rows[0];

    if($Row[TABLE_MOD_FARM."_ownerID"] == $ownerID){
      $dataQ = array();
      $dataQ["id"] = $Row[TABLE_MOD_FARM."_id"];
      $dataQ["name"]=$Row[TABLE_MOD_FARM."_name"] ;
      $dataQ["ownerID"]=$Row[TABLE_MOD_FARM."_ownerID"] ;
      $dataQ["owner"]=$Row[TABLE_MOD_FARM."_owner"] ;
      $dataQ["tel"]=$Row[TABLE_MOD_FARM."_tel"] ;
      $dataQ["pinlat"]=$Row[TABLE_MOD_FARM."_pinlat"] ;
      $dataQ["pinlon"]=$Row[TABLE_MOD_FARM."_pinlon"] ;
      $dataQ["qty"]=$Row[TABLE_MOD_FARM."_qtyLivestock"] ;
      $dataQ["address"]=$Row[TABLE_MOD_FARM."_address"] ;
      $dataQ["province"]=$Row[TABLE_MOD_FARM."_province"] ;
      $dataQ["district"]=$Row[TABLE_MOD_FARM."_district"] ;
      $dataQ["subdistrict"]=$Row[TABLE_MOD_FARM."_subdistrict"] ;
      $dataQ["postcode"]=$Row[TABLE_MOD_FARM."_postcode"]  ;
      if($Row[TABLE_MOD_FARM."_thumbnail"]<>"") {
        $dataQ["thumbnail"]=SYSTEM_FULLPATH_UPLOAD."mod_farm/".$Row[TABLE_MOD_FARM."_thumbnail"];
      } else {
        $dataQ["thumbnail"]=CONFIG_DEFAULT_THUMB_USER;
      }
      $counter++;
    }
    else{
      $ErrorMessage = 'ไม่พบ Farm';
    }
    
    
  } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}
else{
  try {
    $counter=0; $arSQLData=array();
    $sql =" SELECT * FROM ".TABLE_MOD_FARM." WHERE ".TABLE_MOD_FARM."_ownerID=? "; $arSQLData[]=$ownerID;
    $Query=$System_Connection->prepare($sql);
    if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
    $Rows=$Query->fetchAll();
    $Row=$Rows[0];
    $dataQ = array();
    $dataQ["id"] = $Row[TABLE_MOD_FARM."_id"];
    $dataQ["name"]=$Row[TABLE_MOD_FARM."_name"] ;
    $dataQ["ownerID"]=$Row[TABLE_MOD_FARM."_ownerID"] ;
    $dataQ["owner"]=$Row[TABLE_MOD_FARM."_owner"] ;
    $dataQ["tel"]=$Row[TABLE_MOD_FARM."_tel"] ;
    $dataQ["pinlat"]=$Row[TABLE_MOD_FARM."_pinlat"] ;
    $dataQ["pinlon"]=$Row[TABLE_MOD_FARM."_pinlon"] ;
    $dataQ["qty"]=$Row[TABLE_MOD_FARM."_qtyLivestock"] ;
    $dataQ["address"]=$Row[TABLE_MOD_FARM."_address"] ;
    $dataQ["province"]=$Row[TABLE_MOD_FARM."_province"] ;
    $dataQ["district"]=$Row[TABLE_MOD_FARM."_district"] ;
    $dataQ["subdistrict"]=$Row[TABLE_MOD_FARM."_subdistrict"] ;
    $dataQ["postcode"]=$Row[TABLE_MOD_FARM."_postcode"]  ;
    if($Row[TABLE_MOD_FARM."_thumbnail"]<>"") {
      $dataQ["thumbnail"]=SYSTEM_FULLPATH_UPLOAD."mod_farm/".$Row[TABLE_MOD_FARM."_thumbnail"];
    } else {
      $dataQ["thumbnail"]=CONFIG_DEFAULT_THUMB_USER;
    }
    $counter++;
    
  } catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); }
}


#-------------------------------------------------------------------
# RESULT
#-------------------------------------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
	$Result["Message"] = "อ่านข้อมูลสำเร็จ";
	$Result["Result"]=$dataQ;
} else {
	$Result["Status"] = "Error";
	$Result["Message"] = $ErrorMessage;
}

?>