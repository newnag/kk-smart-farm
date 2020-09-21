<?php
#-------------------------------------------------------------------
# Config
#-------------------------------------------------------------------
include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");
include_once("../config/loader.php");
include_once("config.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("../inc/inc_head.php"); ?>
</head>

<body class="<?php echo $System_BodyClass; ?>">
	<?php
	#-------------------------------------------------------------------
	# Show NavBar
	#-------------------------------------------------------------------
	include_once("../inc/inc_navbar.php");
	
	?>
	<div class="page-content">
		<?php
		#-------------------------------------------------------------------
		# Show SideBar
		#-------------------------------------------------------------------
		include_once("../inc/inc_sidebar.php");
		
		?>
		<div class="content-wrapper">
			<?php
			include("edit.php");
			
			#-------------------------------------------------------------------
			# Show Page Footer
			#-------------------------------------------------------------------
			include_once("../inc/inc_page_footer.php");
			?>
		</div>
	</div>
<?php
#-------------------------------------------------------------------
# Footer
#-------------------------------------------------------------------
include_once("../config/disconnect.php");
include_once("../inc/inc_foot.php");
?>
<script>
$('#idNavBar').removeClass('bg-'+currentClass);
var currentClass='<?php echo $SystemConfig_Setting["ThemeBG"]; if($SystemConfig_Setting["ThemeLevel"]=="") { } else { echo "-".$SystemConfig_Setting["ThemeLevel"]; } ?>';
doChangeTheme('<?php echo $SystemConfig_Setting["ThemeBG"]; ?>','<?php echo $SystemConfig_Setting["ThemeLevel"]; ?>');
$('#id<?php echo $SystemConfig_Setting["ThemeBG"]; echo $SystemConfig_Setting["ThemeLevel"]; ?>').addClass("borderOne");
</script>

</body>
</html>