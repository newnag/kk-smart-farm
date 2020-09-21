<?php
#-------------------------------------------------------------------
# Database Connection
#-------------------------------------------------------------------
try {
    $System_Connection = new PDO("mysql:host=".SYSTEM_DB_HOSTNAME.";dbname=".SYSTEM_DB_NAME,SYSTEM_DB_USERNAME,SYSTEM_DB_PASSWORD);
    $System_Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $System_Connection->exec("set names utf8");
} catch(PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
    exit;
}
?>