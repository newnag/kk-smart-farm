<?php
#-------------------------------------------------------------------
# Save Cache File 
#-------------------------------------------------------------------
if(CONFIG_USE_FILE_CACHING) {
    $Config_Cache_Data=ob_get_contents();
    $Config_Cache_Data=System_Minify_HTML($Config_Cache_Data);
    if(!is_dir($Config_Cache_RelativeFolder)) { mkdir($Config_Cache_RelativeFolder); chmod($Config_Cache_RelativeFolder, 0775); }
    if(file_exists($Config_Cache_FullFile)) { @unlink($Config_Cache_FullFile); }
    $fp = fopen($Config_Cache_FullFile,'w+');
    fwrite($fp,$Config_Cache_Data);
    fclose($fp);
    chmod($Config_Cache_FullFile, 0775);
}

#-------------------------------------------------------------------
# Clear Output Buffering
#-------------------------------------------------------------------
ob_flush();

?>