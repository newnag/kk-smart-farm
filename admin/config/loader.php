<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Auto Redirect to /home/index.php .. if login expired
#-------------------------------------------------------------------
if($_COOKIE[SS.'-SystemSession_Staff_ID']>0) { } else { if(!CONFIG_THIS_IS_LOGIN_PAGE) { header( "location: index.php"); exit; } }

#-------------------------------------------------------------------
# Check Login Session & Make it alive
#-------------------------------------------------------------------
if($_COOKIE[SS.'-SystemSession_Staff_ID']>0) {
    // Save Cookies to System Var -------------
    $SystemSession_Staff_ID=$_COOKIE[SS.'-SystemSession_Staff_ID'];
    $SystemSession_Staff_User=$_COOKIE[SS.'-SystemSession_Staff_User'];
    $SystemSession_Staff_Picture=$_COOKIE[SS.'-SystemSession_Staff_Picture'];
    $SystemSession_Staff_Token=$_COOKIE[SS.'-SystemSession_Staff_Token'];
    $SystemSession_Staff_Email=$_COOKIE[SS.'-SystemSession_Staff_Email'];
    $SystemSession_Theme_MenuHideOrShow=$_COOKIE[SS.'-SystemSession_Theme_MenuHideOrShow'];
    if($SystemSession_Theme_MenuHideOrShow=="") { $SystemSession_Theme_MenuHideOrShow="show"; }
    // Refresh cookies ------------------------
    setcookie(SS.'-SystemSession_Staff_ID', $SystemSession_Staff_ID, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Staff_User', $SystemSession_Staff_User, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Staff_Picture',$SystemSession_Staff_Picture, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Staff_Token',$SystemSession_Staff_Token, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Staff_Email',$SystemSession_Staff_Email, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Theme_MenuHideOrShow', $SystemSession_Theme_MenuHideOrShow, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
} else {
    // Clear cookies --------------------------
    setcookie(SS.'-SystemSession_Staff_ID', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Staff_User', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Staff_Picture', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Staff_Token',null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Staff_Email',null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
    setcookie(SS.'-SystemSession_Theme_MenuHideOrShow', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
}

#-------------------------------------------------------------------
# Public Variable : Date 
#-------------------------------------------------------------------
define('SYSTEM_DATENOW',System_getDateNow());
define('SYSTEM_TIMENOW',System_getTimeNow());
define('SYSTEM_DATETIMENOW',SYSTEM_DATENOW." ".SYSTEM_TIMENOW);

#-------------------------------------------------------------------
$SystemConfig_Setting=array();
$SendRequest=array();
$SendRequest["act"]="System_FirstLoad";
$ResultSetting=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
$arSetting=$ResultSetting["ResultSetting"];
for($i=0;$i<=sizeof($arSetting);$i++) {
	$RowSetting=$arSetting[$i];
	if($RowSetting["Key"]<>"") {
		$SystemConfig_Setting[$RowSetting["Key"]]=$RowSetting["Value"];
	}
}

#-------------------------------------------------------------------
# @@@ Check Token on First Request @@@
#-------------------------------------------------------------------


#-------------------------------------------------------------------
# Theme Change by Setting
#-------------------------------------------------------------------
$System_BodyClass=" navbar-top ";
if($SystemSession_Theme_MenuHideOrShow=='show') { $System_BodyClass.=" "; }
if($SystemSession_Theme_MenuHideOrShow=='hide') { $System_BodyClass.=" sidebar-xs "; }
if($SystemConfig_Setting["ThemeBG"]<>"") {
	if($SystemConfig_Setting["ThemeLevel"]=="") {
		$SystemConfig_Theme_BGClass = " theme-bgcolor-".$SystemConfig_Setting["ThemeBG"]." ";
		$SystemSession_Theme_BGClassName = $SystemConfig_Setting["ThemeBG"];
	} else {
		$SystemConfig_Theme_BGClass = " theme-bgcolor-".$SystemConfig_Setting["ThemeBG"]."-".$SystemConfig_Setting["ThemeLevel"]." ";
		$SystemSession_Theme_BGClassName = $SystemConfig_Setting["ThemeBG"]."-".$SystemConfig_Setting["ThemeLevel"];
	}
} else {
	$SystemConfig_Theme_BGClass = " bg-indigo ";
	$SystemSession_Theme_BGClassName = "indigo";
}

?>