<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>
<form id="myForm" name="myForm" method="get" action="?">
<input type="hidden" id="doaction" name="doaction" value="list" />
<!-- Remember Current List State ---------------------------- -->
<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
<input type="hidden" id="inputShowStaffLevel" name="inputShowStaffLevel" value="<?php echo $_REQUEST["inputShowStaffLevel"]; ?>" />
<input type="hidden" id="inputShowStaffGroup" name="inputShowStaffGroup" value="<?php echo $_REQUEST["inputShowStaffGroup"]; ?>" />
<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
<!-- ---------------------------------------------------------- -->
</form>
<?php

#-------------------------------------------------------------------
# Save Data to API
#-------------------------------------------------------------------
$SendRequest['act']=MODULE_TABLE."_Delete";
foreach ($_POST as $key => $value) { $SendRequest[$key]=$value; }
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);

#-------------------------------------------------------------------
# Show Result
#-------------------------------------------------------------------
$inputName=$SendRequest["inputName"];
if($Result["Status"]=="Success") {
    include("../inc/inc_show_success.php");
    ?>
    <script>
    autoSubmitTimer = setTimeout('submitMe()', 1*1000);
    function submitMe() { $('#myForm').submit(); }
    </script>
    <?php
	#-------------------------------------------------------------------
	# Save action to system logs
	#-------------------------------------------------------------------
	$SendRequest=array(); $SendRequest["inputAction"]="ลบข้อมูล ".MODULE_NAME." ในชื่อ ".$inputName;
	include("../inc/inc_save_logs.php");

	#-------------------------------------------------------------------
	# Clear cache folder
	#-------------------------------------------------------------------
	$arClearCache=array("system_staff");
	System_Clear_Cache($arClearCache);
	
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
?>