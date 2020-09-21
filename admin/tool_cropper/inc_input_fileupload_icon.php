<?php
#######################################################
$isEnableCrop=false;
#######################################################
if($Config_Width==0 && $Config_Width==0) {
	$Config_Width=400;
	$Config_Height=400;
	$isEnableCrop=false;
} else {
	if($Config_Width==0) { $Config_Width=400; }
	if($Config_Height==0) { $Config_Height=400; }
	$isEnableCrop=true;
}
#######################################################
?>
<div style=" margin:auto; width: 40px; height: 40px; text-align: center; background-color: #cccccc; vertical-align: middle; cursor: pointer; " onclick=" doShowModal<?php echo $Config_Key; ?>(); " id="idImg<?php echo $Config_Key; ?>" >
	<?php if($Config_OldFile=="") { ?>
	<img src="../img/picture.png" style=" max-height: 40px; max-width: 40px; margin-top:8px; " />
	<?php } else { ?>
	<img src="<?php echo $Config_OldFile; ?>" style=" max-height: 40px; max-width: 40px; " />
	<?php } ?>
	<input type="hidden" id="input<?php echo $Config_Key; ?>" name="input<?php echo $Config_Key; ?>" value="<?php echo $Config_OldFile; ?>" />
</div>
<style>
.cropHeaderWrapperW<?php echo $Config_Width; ?>H<?php echo $Config_Height; ?> { width:<?php echo $Config_Width+30; ?>px; height:<?php echo $Config_Height+60; ?>px; overflow:hidden; padding: 10px; margin: auto; text-align:center; }
#croppic<?php echo $Config_Key; ?> { width:<?php echo $Config_Width; ?>px; height:<?php echo $Config_Height; ?>px; overflow:hidden; margin: auto; }
.customW<?php echo $Config_Width; ?>H<?php echo $Config_Height; ?> { width:<?php echo $Config_Width+30; ?>px; height:<?php echo $Config_Height+30; ?>px; }
</style>
<script>
var myTimer<?php echo $Config_Key; ?>;
//---------------------------------
function doShowModal<?php echo $Config_Key; ?>() {
//---------------------------------
	clearTimeout(myTimer<?php echo $Config_Key; ?>);
	var html='';
	<?php if($isEnableCrop) { ?>
	if($('#input<?php echo $Config_Key; ?>').val()=='') {
		html ='<form method="post" id="myUploadForm<?php echo $Config_Key; ?>" name="myUploadForm<?php echo $Config_Key; ?>" enctype="multipart/form-data" target="frameInvisibleSubmit" action="../tool_cropper/upload.php">';
		html+='	<input type="hidden" name="key" value="<?php echo $Config_Key; ?>" />';
		html+='	<div style=" background-color: #cccccc; margin:auto; width:100%; height: <?php echo $Config_Height; ?>px; vertical-align: middle; " id="idImg1<?php echo $Config_Key; ?>">';
		html+='	<img src="';
		if($('#input<?php echo $Config_Key; ?>').val()=='') {
			html+='../img/picture.png';
		} else {
			html+=$('#input<?php echo $Config_Key; ?>').val();
		}
		html+='" style=" max-height: <?php echo $Config_Height; ?>px; max-width: <?php echo $Config_Width; ?>px; margin-top:140px; " /> ';
		html+='	</div>';
		html+='	<div class="upload-btn-wrapper cursor" style=" margin:auto; padding:5px; ">';
		html+='		<button class="btn btn-info cursor" type="button"> <i class="fa fa-upload" aria-hidden="true"></i> อัพโหลดไฟล์ </button>';
		html+='		<input type="file" id="inputFileUpload<?php echo $Config_Key; ?>" name="inputFileUpload<?php echo $Config_Key; ?>">';
		html+='	</div>';
		html+='</form>';
	} else {
		html ='<div id="croppic<?php echo $Config_Key; ?>">';
		html+='</div>';
		html+='<input type="hidden" id="inputCroped<?php echo $Config_Key; ?>" name="inputCroped<?php echo $Config_Key; ?>" value="" />';
		html+='<form method="post" id="myUploadForm<?php echo $Config_Key; ?>" name="myUploadForm<?php echo $Config_Key; ?>" enctype="multipart/form-data" target="frameInvisibleSubmit" action="../tool_cropper/upload.php">';
		html+='	<input type="hidden" name="key" value="<?php echo $Config_Key; ?>" />';
		html+='	<div class="upload-btn-wrapper cursor" style=" margin:auto; padding:5px; ">';
		html+='		<button class="btn btn-info cursor" type="button"> <i class="fa fa-upload" aria-hidden="true"></i> อัพโหลดไฟล์ </button>';
		html+='		<input type="file" id="inputFileUpload<?php echo $Config_Key; ?>" name="inputFileUpload<?php echo $Config_Key; ?>">';
		html+='	</div>';
		html+='</form>';
	}
	<?php } else { ?>
		html ='<form method="post" id="myUploadForm<?php echo $Config_Key; ?>" name="myUploadForm<?php echo $Config_Key; ?>" enctype="multipart/form-data" target="frameInvisibleSubmit" action="../tool_cropper/upload.php">';
		html+='	<input type="hidden" name="key" value="<?php echo $Config_Key; ?>" />';
		html+='	<div style=" margin:auto; width:100%; height: <?php echo $Config_Height; ?>px; " id="idImg1<?php echo $Config_Key; ?>">';
		html+='	<img src="';
		if($('#input<?php echo $Config_Key; ?>').val()=='') {
			html+='../img/picture.png';
		} else {
			html+=$('#input<?php echo $Config_Key; ?>').val();
		}
		html+='" style=" max-height: <?php echo $Config_Height; ?>px; max-width: <?php echo $Config_Width; ?>px; " /> ';
		html+='	</div>';
		html+='	<div class="upload-btn-wrapper cursor" style=" margin:auto; padding:5px; ">';
		html+='		<button class="btn btn-info cursor" type="button"> <i class="fa fa-upload" aria-hidden="true"></i> อัพโหลดไฟล์ </button>';
		html+='		<input type="file" id="inputFileUpload<?php echo $Config_Key; ?>" name="inputFileUpload<?php echo $Config_Key; ?>">';
		html+='	</div>';
		html+='</form>';
	<?php } ?>
	$('#idCropArea').html(html);
	//--------------------------------------------------------------------------------
	$('.modal-dialog').addClass("customW<?php echo $Config_Width; ?>H<?php echo $Config_Height; ?>");
	$('#idCropArea').addClass("cropHeaderWrapperW<?php echo $Config_Width; ?>H<?php echo $Config_Height; ?>");
	//--------------------------------------------------------------------------------
	$('#idModalCrop').modal('show');
	//--------------------------------------------------------------------------------
	$('#inputFileUpload<?php echo $Config_Key; ?>').on("change", function(){
		$('#idImg1<?php echo $Config_Key; ?>').html('<br><br><br>Uploading..');
		$('#myUploadForm<?php echo $Config_Key; ?>').submit();
	});
	//--------------------------------------------------------------------------------
	<?php if($isEnableCrop) { ?>
	if($('#input<?php echo $Config_Key; ?>').val()=='') {
		// do nothing
	} else {
		var croppicHeaderOptions = {
			cropUrl:'../tool_cropper/img_crop_to_file.php',
			loadPicture: $('#input<?php echo $Config_Key; ?>').val(),
			outputUrlId: 'inputCroped<?php echo $Config_Key; ?>',
			modal:false,
			processInline:true,
			enableMousescroll:true,
			doubleZoomControls:true,
			rotateControls:true,			
			onAfterImgCrop:function() {
				doCloseModal<?php echo $Config_Key; ?>($('#inputCroped<?php echo $Config_Key; ?>').val());
			},
			onError:function(errormessage){ console.log('onError:'+errormessage) }
		}   
		var croppic = new Croppic('croppic<?php echo $Config_Key; ?>', croppicHeaderOptions);
		$('.cropControlReset').hide();
	}
	<?php } ?>
}
//---------------------------------
function doCloseModal<?php echo $Config_Key; ?>(myNewImg) {
//---------------------------------
	var html='';
	html ='<img src="'+myNewImg+'" style=" max-height: 40px; max-width: 40px; " />';
	html+='<input type="hidden" id="input<?php echo $Config_Key; ?>" name="input<?php echo $Config_Key; ?>" value="'+myNewImg+'" />';
	$('#idImg<?php echo $Config_Key; ?>').html(html);
	$('#idModalCrop').modal('hide');
}
//---------------------------------
function doShowModalDelay<?php echo $Config_Key; ?>() {
//---------------------------------
	myTimer<?php echo $Config_Key; ?> = setTimeout('doShowModal<?php echo $Config_Key; ?>()', 1*1000);
}
</script>