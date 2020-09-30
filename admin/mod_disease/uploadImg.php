<?php

    include_once("../config/config.php");
    include_once("../config/function.php");
    include_once("../config/connect.php");
    include_once("../config/loader.php");
    include_once("config.php");

    $file = $_FILES['upload']['name'];
    $filetmp = $_FILES['upload']['tmp_name'];

    $arraypic = explode(".",$file);
    $filetype = strtolower($arraypic[sizeof($arraypic)-1]);
    
    $newimage = date('YmdHis')."-".strtolower($key).".".$filetype;

    $target_dir = SYSTEM_RELATIVEPATH_UPLOAD.'/mod_ck/';

    copy($filetmp,$target_dir.$newimage);

    $function_number = $_REQUEST['CKEditorFuncNum'];
    $url = $target_dir.$newimage;
    $message = '';
    
    echo '<script>window.parent.CKEDITOR.tools.callFunction("'.$function_number.'","'.$url.'","'.$message.'")</script>';
    

?>