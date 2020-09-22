<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Predefine Variable
#-------------------------------------------------------------------
$_REQUEST["inputShowPage"]="1";
if($_REQUEST["inputShowPageSize"]>0) { } else { $_REQUEST["inputShowPageSize"]=12; }
if($_REQUEST["inputShowStatus"]=="") { $_REQUEST["inputShowStatus"]="Enable"; }
if($_REQUEST["inputShowOrderBy"]=="") { $_REQUEST["inputShowOrderBy"]="Order"; }
if($_REQUEST["inputShowASCDESC"]=="") { $_REQUEST["inputShowASCDESC"]="DESC"; }

#-------------------------------------------------------------------
# Create SendRequest Data and Create PageKey
#-------------------------------------------------------------------
$SendRequest=array("act"=>MODULE_TABLE."_List");
foreach ($_REQUEST as $key => $value) { $SendRequest[$key]=trim(urldecode($value)); }
$Config_PageKey=http_build_query($SendRequest);

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
$arStaffGroup=$Result["Category"]["StaffGroup"];
$_REQUEST["inputShowMaxPage"]=$Result["Header"]["MaxPage"];

#-------------------------------------------------------------------
# Show Page Header Panel
#-------------------------------------------------------------------
$Config_ShowButton=array("filter");
include_once("../inc/inc_page_header.php");
	
	?>
	<div class="content">
		<?php
		#-------------------------------------------------------------------
		# Show Search Box
		#-------------------------------------------------------------------
		include_once("search.php");
		
		#-------------------------------------------------------------------
		# Show Data List
		#-------------------------------------------------------------------
		if($Result["Header"]["TotalRecord"]>0) {
			?>
			<div id="idListData">
				<div class="row">
					<div class="col-12 text-center font-weight-bold font-size-lg text-thaisans text-thaisans-normal"> ค้นพบ <?php echo number_format($Result["Header"]["TotalRecord"],0); ?> รายการ </div>
				</div>
				<div class="row" id="idListBody" style=" margin-top: 10px; ">
					<?php
					$arData=$Result["Result"];
					for($i=0;$i<sizeof($arData);$i++) {
						$Row=$arData[$i];
						?><div class="col-sm-12 col-md-6 col-lg-3" style=" padding-top: 0; "><?php
						#-------------------------------------------------------------------
						# Show Object
						#-------------------------------------------------------------------
						$Config_ViewOnly=false;
						include("list-object.php");
						
						?></div><?php
					}
					?>
				</div>
			</div>
			<?php
		} else {
			
			#-------------------------------------------------------------------
			# Show Find Not Found Object
			#-------------------------------------------------------------------
			include("../inc/inc_data_not_found.php");
			
		}
		?>
	</div>
	<script src="list.js"></script>
	<script>
	function doToggleStatus(myID) {
		$.ajax({
			url : 'togglestatus-ajax.php?inputID='+myID,
			success : function(data) {
				$('#idSetStatus'+myID).html(data);
			}
		});
	}
	</script>