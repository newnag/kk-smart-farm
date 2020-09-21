<?php
####################################################################
# Config
####################################################################
define('CONFIG_THIS_IS_LOGIN_PAGE',true);

include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");

####################################################################
# Auto Redirect to /home/home.php .. if still loged in
####################################################################
if($_COOKIE[SS.'-SystemSession_Staff_ID']>0) { header( "location: home.php"); }

####################################################################
# Action
####################################################################
if($_POST["act"]=="SignIn") {
	//----------------------------------------------------
	$SendRequest=array();
	$SendRequest["act"]="SignIn";
	foreach ($_POST as $key => $value) { $SendRequest[$key]=$value; }
	if($SendRequest["inputPassword"]=="") { } else {
		$SendRequest["inputPassword"]=hash('sha256',SYSTEM_AUTHEN_KEY.$SendRequest["inputPassword"].SYSTEM_AUTHEN_KEY);
	}
	$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
	//----------------------------------------------------
	$isLoginSuccess=false;
	if($Result["Status"]=="Success") { // redirect to home.php
		$isLoginSuccess = true;
		$Row=$Result["Result"];
		$RowSetting=$Result["Setting"];
		// Clear old cookies --------------------------
		setcookie(SS.'-SystemSession_Staff_ID', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
		setcookie(SS.'-SystemSession_Staff_User', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
		setcookie(SS.'-SystemSession_Staff_Picture', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
		setcookie(SS.'-SystemSession_Staff_Token',null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
		setcookie(SS.'-SystemSession_Staff_Email', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
		// Create new cookies --------------------------
		$SystemSession_Staff_ID=$Row["ID"];           setcookie(SS.'-SystemSession_Staff_ID',   $SystemSession_Staff_ID, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
		$SystemSession_Staff_User=$Row["User"];       setcookie(SS.'-SystemSession_Staff_User', $SystemSession_Staff_User, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
		$SystemSession_Staff_Picture=$Row["Picture"]; setcookie(SS.'-SystemSession_Staff_Picture', $SystemSession_Staff_Picture, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
		$SystemSession_Staff_Token=$Row["Token"];     setcookie(SS.'-SystemSession_Staff_Token',$SystemSession_Staff_Token, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
		$SystemSession_Staff_Email=$Row["Email"];     setcookie(SS.'-SystemSession_Staff_Email', $SystemSession_Staff_Email, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
		//----------------------------------------------
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once("../inc/inc_head.php"); ?>
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<script src="index.js"></script>
</head>
<body>
	<img src="../images/login/pencil.jpg" class="bg">
	<div class="page-content">
		<?php
		include_once("../inc/inc_login.php");
		?>
	</div>
	<form method="get" action="home.php" id="idSystemRefreshForm"></form>
	<?php
	####################################################################
	# Footer
	####################################################################
	include_once("../config/disconnect.php");
	include_once("../inc/inc_foot.php");

	####################################################################
	if($isLoginSuccess) {
		?>
		<script>
		$(document).ready(function() {
			doAlert('เข้าสู่ระบบสำเร็จ','success');
			System_PageRefreshTimer(1);
		});
		</script>
		<?php
	}
	
?>
</body>
</html>