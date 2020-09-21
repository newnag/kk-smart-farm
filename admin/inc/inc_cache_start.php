<?php
#-------------------------------------------------------------------
# Output Buffering Setting
#-------------------------------------------------------------------
$Config_Cache_Extension      = 'html'; // file extension
$Config_Cache_Time           = 6*3600; // hour 
$Config_Cache_RelativeFolder = SYSTEM_RELATIVEPATH_UPLOAD."/system_cache/".$Config_Cache_Folder;
$Config_Cache_File           = md5($Config_Cache_Name).".".$Config_Cache_Extension;
$Config_Cache_FullFile       = $Config_Cache_RelativeFolder."/".$Config_Cache_File;
$Config_Cache_Skip           = false;

#-------------------------------------------------------------------
# Show Caching File
#-------------------------------------------------------------------
if (CONFIG_USE_FILE_CACHING && file_exists($Config_Cache_FullFile) && time() - $Config_Cache_Time < filemtime($Config_Cache_FullFile)) {
    $Config_Cache_Data=file_get_contents($Config_Cache_FullFile);
    echo "\r\n\r\n\r\n<!-- ################################### Cache Start [".$Config_Cache_Folder."/".$Config_Cache_Name."] ################################### -->\r\n";
    echo $Config_Cache_Data;
    echo "\r\n<!-- ################################### Cache End [".$Config_Cache_Folder."/".$Config_Cache_Name."] ################################### -->\r\n\r\n\r\n";
    $Config_Cache_Skip=true;
}

?>