<?php
#####################################################################
# Save action to system logs
#####################################################################
$SendRequest["act"]="System_Logs";
$SendRequest["inputIcon"]=MODULE_ICON;
$SendRequest["inputColor"]=MODULE_COLOR;
$SendRequest["inputKeyMain"]=MODULE_MAIN_KEY;
$SendRequest["inputKeySub"]=MODULE_SUB_KEY;
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
######################################################################
?>