<?php
####################################################################
include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");
####################################################################
if($_REQUEST["inputSideBarHideOrShow"]<>"") {
    setcookie(SS.'-SystemSession_Theme_MenuHideOrShow', null, -1, "/", SYSTEM_COOKIES_DOMAIN, 0);
    $SystemSession_Theme_MenuHideOrShow=$_REQUEST["inputSideBarHideOrShow"];
    setcookie(SS.'-SystemSession_Theme_MenuHideOrShow', $SystemSession_Theme_MenuHideOrShow, time()+SYSTEM_COOKIES_TIME, "/", SYSTEM_COOKIES_DOMAIN, 0);
}
?>OK