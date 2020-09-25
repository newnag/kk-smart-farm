<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>
<form id="myForm" name="myForm" method="get" action="?">
<input type="hidden" id="doaction" name="doaction" value="edit" />
</form>
<?php

#-------------------------------------------------------------------
# Save Data to API
#-------------------------------------------------------------------
$SendRequest['act']=MODULE_TABLE."_Update";
foreach ($_POST as $key => $value) { $SendRequest[$key]=$value; }
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);

#-------------------------------------------------------------------
# Show Result
#-------------------------------------------------------------------
$inputName=$SendRequest["inputName"];
if($Result["Status"]=="Success") {
    include("../inc/inc_show_success.php");

	#-------------------------------------------------------------------
	# Save action to system logs
	#-------------------------------------------------------------------
	$SendRequest=array(); $SendRequest["inputAction"]="แก้ไขข้อมูล ".MODULE_NAME." ในชื่อ ".MODULE_NAME;
	include("../inc/inc_save_logs.php");

	#-------------------------------------------------------------------
	# Clear cache folder
	#-------------------------------------------------------------------
	$arClearCache=array(strtolower(MODULE_TABLE));
	System_Clear_Cache($arClearCache);

    ?>
    <script>
    autoSubmitTimer = setTimeout('submitMe()', 1*1000);
    function submitMe() { $('#myForm').submit(); }
    </script>
    <?php
	
} else {
	
	#-------------------------------------------------------------------
	# Show Error Message
	#-------------------------------------------------------------------
	$ErrorMessage=$Result["Message"];
    include("../inc/inc_show_error.php");
	
    ?>
    <div style=" text-align: center; ">
        <button type="button" class="btn btn-w-m btn-danger" style=" width: 160px; " onclick=" $('#myForm').submit(); "> <i class="fa fa-warning" aria-hidden="true"></i> &nbsp;  ตกลง </button>
    </div>
    <?php
}
####################################################################

?>