<?php
#-------------------------------------------------------------------
# Config
#-------------------------------------------------------------------
include_once("../config/config.php");
include_once("../config/function.php");
include_once("../config/connect.php");
include_once("../config/loader.php");
include_once("config.php");

#-------------------------------------------------------------------
# Security Protect
#-------------------------------------------------------------------
$doaction=$_REQUEST["doaction"];
$arCheck=array("list","delete");
if(!in_array($doaction,$arCheck)) { $doaction="list"; }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("../inc/inc_head.php"); ?>
</head>
<?php

#-------------------------------------------------------------------
# Body Data
#-------------------------------------------------------------------
?>

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
			#-------------------------------------------------------------------
			# Action
			#-------------------------------------------------------------------
			if(file_exists($_REQUEST["doaction"].".php")) { include($doaction.".php"); } else { include("list.php"); }
			
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