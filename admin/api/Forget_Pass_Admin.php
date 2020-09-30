<?php

include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");

include_once("../inc/inc_head.php");

#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");
$ErrorMessage="";

#-------------------------------------------------------------------
# INPUT
#-------------------------------------------------------------------
$inputEmail = ($_GET["inputEmail"]);

#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------


$arSQLDataA=array();
$sql =" SELECT * FROM ".TABLE_SYSTEM_STAFF." WHERE ".TABLE_SYSTEM_STAFF."_Email=? "; $arSQLDataA[]=$inputEmail;
$Query=$System_Connection->prepare($sql);
if(sizeof($arSQLDataA)>0) { $Query->execute($arSQLDataA);  } else { $Query->execute(); }	
$Rows=$Query->fetchAll();
$Row=$Rows[0];

if($Row[TABLE_SYSTEM_STAFF."_Email"] != $inputEmail){
  echo 'ไม่มี User นี้';
}


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

$randomPass = generateRandomString();


#-------------------------------------------------------------------
# PROCESS
#-------------------------------------------------------------------

$inputPass = hash('sha256',SYSTEM_AUTHEN_KEY.$randomPass.SYSTEM_AUTHEN_KEY);



try {
  $arSQLData=array();
  $sql =" UPDATE ".TABLE_SYSTEM_STAFF." SET "; 
  $sql.=" ".TABLE_SYSTEM_STAFF."_Pass=? ";        $arSQLData[]=$inputPass;
  $sql.=" WHERE ".TABLE_SYSTEM_STAFF."_Email=? ";        $arSQLData[]=$inputEmail;
  $Query=$System_Connection->prepare($sql);
  if(sizeof($arSQLData)>0) { $Query->execute($arSQLData);  } else { $Query->execute(); }	
} catch(PDOException $e) { 	$ErrorMessage=$e->getMessage(); echo 'ผิดพลาดดึงข้อมูลไม่ได้'; }


###################################################

//RESULT:---------------------------------------
if($ErrorMessage=="") {
	$Result["Status"] = "Success";
  $Result["Message"] = "แก้ไขข้อมูลสำเร็จ";

  ?>

   <div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Password recovery form -->
				<form class="login-form" action="<?php echo SYSTEM_FULLPATH_API; ?>Forget_Pass_Admin.php">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">รหัสผ่านชั่วคราวของคุณคือ</h5>
								<h2 class="d-block"><?php echo $randomPass; ?></h2>
							</div>

              <div class="text-center">
							  <button type="button" class="btn btn-primary legitRippl" onclick="redirect()">ย้อนกลับหน้าแรก</button>
              <div>
							
						</div>
					</div>
				</form>
				<!-- /password recovery form -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>

<?php
} else {
	$Result["Status"] = "Error";
  $Result["Message"] = $ErrorMessage;
  echo 'ผิดพลาด';
}

?>

<script>
  function redirect(){
    window.location.href = `http://kk.getdev.top/smartfarm/admin`;
  }
</script>