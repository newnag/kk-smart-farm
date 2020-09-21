<?php
####################################################################
include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");
####################################################################
include_once("config.php");
####################################################################
// ---------------------------------------------------------------
$Config_Key=$_REQUEST['key'];
// ---------------------------------------------------------------
$newimage='';
$imageupload = $_FILES['inputFileUpload'.$Config_Key]['tmp_name'];
$imageupload_name = $_FILES['inputFileUpload'.$Config_Key]['name'];
if(isset($imageupload_name)){
    $arraypic = explode(".",$imageupload_name);
    $filetype = strtolower($arraypic[sizeof($arraypic)-1]);
    if($filetype<>"") {
        $newimage = date('YmdHis')."-".strtolower($Config_Key).".".$filetype;
        $target_dir = SYSTEM_RELATIVEPATH_UPLOAD."/test/";
        if(!is_dir($target_dir)) { mkdir($target_dir, 0777, true); chmod($target_dir, 0777); }
        copy($imageupload , $target_dir.$newimage);
		?>
		<script>
		parent.doCloseModal<?php echo $Config_Key; ?>('<?php echo $target_dir.$newimage; ?>');
		//parent.doShowModalDelay<?php echo $Config_Key; ?>();
		</script>
		<?php
		exit;
    }
}
// ---------------------------------------------------------------
?>
<script> alert('Upload Error!'); </script>