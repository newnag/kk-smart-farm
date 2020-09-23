<?php
#-------------------------------------------------------------------
# PHP Show Error
#-------------------------------------------------------------------
error_reporting( error_reporting() & ~E_NOTICE );

#-------------------------------------------------------------------
# System Config
#-------------------------------------------------------------------
define('SS','MS'); // for multiple WebEngine in 1 domain
define('SYSTEM_FULLPATH','http://kk.getdev.top/smartfarm/');
define('SYSTEM_FULLPATH_API','http://kk.getdev.top/smartfarm/admin/api/');
define('SYSTEM_FULLPATH_UPLOAD','http://kk.getdev.top/smartfarm/upload/');
define('SYSTEM_COOKIES_DOMAIN','kk.getdev.top'); // domain name with no http
define('SYSTEM_RELATIVEPATH_UPLOAD','../../upload'); // relative path from /admin/home/
define('SYSTEM_RELATIVEPATH_API','../api'); // relative path from /admin/function/
define('SYSTEM_COOKIES_TIME',24*60*60); // = 24 hour

#-------------------------------------------------------------------
# Database
#-------------------------------------------------------------------
define('SYSTEM_DB_HOSTNAME','localhost');
define('SYSTEM_DB_HOSTPORT','3306');
define('SYSTEM_DB_USERNAME','getdev_kksmart');
define('SYSTEM_DB_PASSWORD','mpMAB2yLjX');
define('SYSTEM_DB_NAME','getdev_kksmart');
define('SYSTEM_DB_PREFIX','we'); // for multiple WebEngine in 1 database

#-------------------------------------------------------------------
# Tables
#-------------------------------------------------------------------
define('TABLE_SYSTEM_STAFF',SYSTEM_DB_PREFIX.'_system_staff');
define('TABLE_SYSTEM_STAFF_GROUP',SYSTEM_DB_PREFIX.'_system_staff_group');
define('TABLE_SYSTEM_SETTING',SYSTEM_DB_PREFIX.'_system_setting');
define('TABLE_SYSTEM_LOGS',SYSTEM_DB_PREFIX.'_system_logs');

define('TABLE_MOD_BANNERHERO',SYSTEM_DB_PREFIX.'_mod_bannerhero');
define('TABLE_MOD_BANNERHERO1',SYSTEM_DB_PREFIX.'_mod_bannerhero1');
define('TABLE_MOD_BANNERHERO2',SYSTEM_DB_PREFIX.'_mod_bannerhero2');
define('TABLE_MOD_BANNERHERO3',SYSTEM_DB_PREFIX.'_mod_bannerhero3');
define('TABLE_MOD_BANNERHERO4',SYSTEM_DB_PREFIX.'_mod_bannerhero4');
define('TABLE_MOD_BANNER1',SYSTEM_DB_PREFIX.'_mod_banner1');
define('TABLE_MOD_BANNER2',SYSTEM_DB_PREFIX.'_mod_banner2');
define('TABLE_MOD_PROMOTION',SYSTEM_DB_PREFIX.'_mod_promotion');
define('TABLE_MOD_ARTICLE',SYSTEM_DB_PREFIX.'_mod_article');
define('TABLE_MOD_PROJECT',SYSTEM_DB_PREFIX.'_mod_project');
define('TABLE_MOD_REGISTER',SYSTEM_DB_PREFIX.'_mod_register');
define('TABLE_MOD_CONTACT',SYSTEM_DB_PREFIX.'_mod_contact');
define('TABLE_MOD_SETTING',SYSTEM_DB_PREFIX.'_mod_setting');
define('TABLE_MOD_PAGE',SYSTEM_DB_PREFIX.'_mod_page');

define('TABLE_MOD_USERFARM',SYSTEM_DB_PREFIX.'_mod_userfarm');
define('TABLE_MOD_FARM',SYSTEM_DB_PREFIX.'_mod_farm');
define('TABLE_MOD_LIVESTOCK',SYSTEM_DB_PREFIX.'_mod_livestock');
define('TABLE_MOD_CATEGORY',SYSTEM_DB_PREFIX.'_mod_category');
define('TABLE_MOD_SUBCATEGORY',SYSTEM_DB_PREFIX.'_mod_subcate');
define('TABLE_MOD_CHOICE',SYSTEM_DB_PREFIX.'_mod_choice');
define('TABLE_MOD_THUMBNAIL',SYSTEM_DB_PREFIX.'_mod_thumbnailSub');

#-------------------------------------------------------------------
# API Connection
#-------------------------------------------------------------------
define('SYSTEM_DB_MODE_BACKEND','MYSQL'); // API , MYSQL
define('SYSTEM_DB_MODE_FRONTEND','MYSQL'); // API , MYSQL
define('SYSTEM_AUTHEN_KEY','ThisIsWebEngineAuthenKey'); // for Password encoding at SignIn.php

#-------------------------------------------------------------------
# E-mail Account
#-------------------------------------------------------------------
define('SYSTEM_GMAIL_USERNAME','doer.test.mail@gmail.com');
define('SYSTEM_GMAIL_PASSWORD','ILoveDoer!123456');
define('SYSTEM_GMAIL_NAME','WebEngine Test Mail');

#-------------------------------------------------------------------
# Other Config
#-------------------------------------------------------------------
define('SYSTEM_TITLE_DEFAULT','WebEngine');
define('SYSTEM_PREVENT_DIRECT_ACCESS',false);
define('CONFIG_TIMENOW_MINUTE_ADD',0); // 0 Hour
define('CONFIG_DEFAULT_PAGESIZE',8); // Page Size 
define('CONFIG_DEFAULT_THUMB_USER',SYSTEM_FULLPATH.'upload/system_staff/default.png'); // default user path
define('CONFIG_DEFAULT_THUMB_PICTURE',SYSTEM_FULLPATH.'upload/blank.png'); // default user path
define('CONFIG_DEFAULT_DESIGN_CLASS',' theme-bgcolor-slate-800 text-white '); // basic design color 1
define('CONFIG_DEFAULT_DESIGN_CLASS2',' theme-bgcolor-slate-600 text-white '); // basic design color 2
 
#-------------------------------------------------------------------
# Predefine Variable
#-------------------------------------------------------------------
define('CONFIG_THIS_IS_LOGIN_PAGE',false);
define('CONFIG_USE_FILE_CACHING',false);
define('CONFIG_MINIFY_OUTPUT',false);

#-------------------------------------------------------------------
# Public Variable
#-------------------------------------------------------------------
$System_ListAPI=array();
$System_ListAPICURL=array();
$System_MenuMain_Name=array();
$System_MenuSub_Name=array();
$System_MenuMain_Icons=array();
$System_MenuSub_Link=array();

#-------------------------------------------------------------------
# Menu List
#-------------------------------------------------------------------
$System_MenuMain_Name[1000]="โครงการ"; $System_MenuMain_Icons[1000]="icon-home4";
        $System_MenuSub_Name[1001] ="จัดการโครงการ"; $System_MenuSub_Link[1001]="../mod_project/";
        $System_MenuSub_Name[1002] ="ลงทะเบียน"; $System_MenuSub_Link[1002]="../mod_register/";
$System_MenuMain_Name[2000]="ข่าวและบทความ"; $System_MenuMain_Icons[2000]="icon-typewriter";
        $System_MenuSub_Name[2001] ="บทความ"; $System_MenuSub_Link[2001]="../mod_article/";
        $System_MenuSub_Name[2002] ="ข่าวสารและโปรโมชั่น"; $System_MenuSub_Link[2002]="../mod_promotion/";
$System_MenuMain_Name[3000]="จัดการหมวดหมู่และคำตอบ"; $System_MenuMain_Icons[3000]="mi-mail-outline";
        $System_MenuSub_Name[3001] ="หมวดหมู่"; $System_MenuSub_Link[3001]="../mod_category/";
        $System_MenuSub_Name[3002] ="หมวดหมู่ย่อย"; $System_MenuSub_Link[3002]="../mod_subcate/";
        $System_MenuSub_Name[3003] ="คำตอบ"; $System_MenuSub_Link[3003]="../mod_choice/";
        $System_MenuSub_Name[3004] ="รูปภาพหมวดหมู่ย่อย"; $System_MenuSub_Link[3004]="../mod_thumbnail/";
// $System_MenuMain_Name[4000]="การติดต่อ"; $System_MenuMain_Icons[3000]="mi-mail-outline";
//         $System_MenuSub_Name[4001] ="Contact Us"; $System_MenuSub_Link[3001]="../mod_contact/";
$System_MenuMain_Name[5000]="จัดการข้อมูลเกี่ยวกับฟาร์ม"; $System_MenuMain_Icons[5000]="icon-pencil7";
        $System_MenuSub_Name[5001] ="จัดการข้อมูลเกษตรกร"; $System_MenuSub_Link[5001]="../mod_userfarm/";
        $System_MenuSub_Name[5002] ="จัดการข้อมูลปศุสัตว์"; $System_MenuSub_Link[5002]="../mod_livestock/";
        $System_MenuSub_Name[5003] ="จัดการข้อมูลฟาร์ม"; $System_MenuSub_Link[5003]="../mod_farm/";
$System_MenuMain_Name[6000]="จัดการเว็บไซต์"; $System_MenuMain_Icons[6000]="icon-equalizer2";
        $System_MenuSub_Name[6001] ="Website Setting"; $System_MenuSub_Link[6001]="../mod_setting/";
        $System_MenuSub_Name[6002] ="Terms and Conditions"; $System_MenuSub_Link[6002]="../mod_page/";
        $System_MenuSub_Name[6003] ="Privacy Policy"; $System_MenuSub_Link[6003]="../mod_page1/";

#-------------------------------------------------------------------
# Project
#-------------------------------------------------------------------
$arFacilityKey = array(3,4,5,6,7,8);
$arFacilityName = array("สระว่ายน้ำ","ฟิตเนส","สวนพักผ่อน","กล้องวงจรปิด","เจ้าหน้าที่ รักษาความปลอดภัย","ระบบผ่านเข้าออก อัตโนมัติ");

$arAssetTypeKey = array("SingleHouse","TwinHouse","TownHome","CommercialBuilding");
$arAssetTypeName = array("บ้านเดี่ยว","บ้านแฝด","ทาว์นโฮม","อาคารพาณิชย์");

?>