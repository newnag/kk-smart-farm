<?php
#-------------------------------------------------------------------
# Config
#-------------------------------------------------------------------
include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");
include_once("../config/loader.php");
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
		<div class="content-wrapper text-center">
			<br><br><br>
			<h1>ยินดีต้อนรับสู่ระบบจัดการเว็บไซต์</h1>
			<!-- <h2><?php echo SYSTEM_COOKIES_DOMAIN; ?></h2> -->
			<h2>KK Smart Farm</h2>
			<?php
			#-------------------------------------------------------------------
			# Show Home Content
			#-------------------------------------------------------------------
			//include_once("../inc/inc_content_home.php");
			
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
</body>
</html>