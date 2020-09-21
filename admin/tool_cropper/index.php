<?php
//--------------------------------------
include("config.php");
//--------------------------------------
include("../config/config_system.php");
include("../config/config_addon.php");
include("../config/function_system.php");
include("../config/function_addon.php");
## Check Login Session and Redirect ################################
if($_COOKIE[SS.'-SystemSession_Staff_ID']>0) { } else { include("../inc/redirect.php"); exit; }
####################################################################
$w=$_REQUEST["w"];
$h=$_REQUEST["h"];
####################################################################
if($w=="") { $w=400; }
if($h=="") { $h=400; }
?>
<!DOCTYPE html>
<html>
<head>
<?php include("../inc/page-header.php"); ?>

</head>

<body class="<?php echo CONFIG_BODY_CLASS; ?>">
    <!-- -------------------------------------------------- -->
    <div class="wrapper wrapper-content wrapper-content-page animated fadeInRight">
        <!-- ################################################################## -->
		<button type="button" class="btn btn-primary" data-toggle="modal" onclick=" doShowModal(); ">
		  Launch demo modal
		</button>
		<br><br><br>
        <!-- ################################################################## -->
    </div>
    <!-- -------------------------------------------------- -->
    <?php include("../inc/page-footer.php"); ?>
    <!-- -------------------------------------------------- -->
    <form name="idSystemRefreshForm" id="idSystemRefreshForm" method="get" action="?"></form>
    <!-- -------------------------------------------------- -->
	<script type="text/javascript" src="../lib/croppic/assets/js/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="../lib/croppic/croppic.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../lib/croppic/croppic.css">
	<style>
	.cropHeaderWrapper { width:<?php echo $w+30; ?>px; height:<?php echo $h+30; ?>px; overflow:hidden; padding: 10px; margin: auto; }
	#croppic { width:<?php echo $w; ?>px; height:<?php echo $h; ?>px; overflow:hidden; margin: auto; }
	.customWH { width:<?php echo $w+30; ?>px; height:<?php echo $h+30; ?>px; }
	</style>
	<script>
	//---------------------------------
	function doShowModal() {
	//---------------------------------
		$('#idCropArea').html('<div id="croppic"></div> <input type="hidden" id="get_img_url">');
		$('#idModalCrop').modal('show');
		$('.modal-dialog').addClass("customWH");
		var croppicHeaderOptions = {
				cropUrl:'img_crop_to_file.php',
				loadPicture:'../../upload/mod_test_oilpipe/20190816111956-placeaddressdoc.jpg',
				outputUrlId: 'get_img_url',
				modal:false,
				processInline:true,
				enableMousescroll:true,
				doubleZoomControls:true,
				rotateControls:true,			
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}   
		var croppic = new Croppic('croppic', croppicHeaderOptions);
	}
	//---------------------------------
	</script>
	
</body>
</html>