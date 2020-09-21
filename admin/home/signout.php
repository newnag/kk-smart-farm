<?php
####################################################################
header("Cache-Control: no-cache");
set_time_limit(0);
####################################################################
include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");
####################################################################
// Clear cookies --------------------------
setcookie(SS.'-SystemSession_Staff_ID', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
setcookie(SS.'-SystemSession_Staff_User', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
setcookie(SS.'-SystemSession_Staff_Picture', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
setcookie(SS.'-SystemSession_Staff_Token',null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
setcookie(SS.'-SystemSession_Staff_Email',null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
####################################################################
header( "location: index.php");
?>