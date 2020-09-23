<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Predefine Variable
#-------------------------------------------------------------------
$_REQUEST["inputShowPage"]="1";
if($_REQUEST["inputShowPageSize"]>0) { } else { $_REQUEST["inputShowPageSize"]=20; }
if($_REQUEST["inputShowStaffLevel"]=="") { $_REQUEST["inputShowStaffLevel"]="All"; }
if($_REQUEST["inputShowStaffGroup"]=="") { $_REQUEST["inputShowStaffGroup"]="All"; }
if($_REQUEST["inputShowStatus"]=="") { $_REQUEST["inputShowStatus"]="Enable"; }
if($_REQUEST["inputShowOrderBy"]=="") { $_REQUEST["inputShowOrderBy"]="ID"; }
if($_REQUEST["inputShowASCDESC"]=="") { $_REQUEST["inputShowASCDESC"]="DESC"; }
if($_REQUEST["inputShowFilter"]=="") { $_REQUEST["inputShowFilter"]=0; }

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
$_REQUEST["inputShowMaxPage"]=$Result["Header"]["MaxPage"];   

#-------------------------------------------------------------------
# Show Page Header Panel
#-------------------------------------------------------------------
$Config_ShowButton=array("add","filter");
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

	if($Result["Header"]["Total"]>0) {
		?>
		<div id="idListData">
			<div class="row">
				<div class="col-12 text-center font-weight-bold font-size-lg text-thaisans text-thaisans-normal"> ค้นพบ <?php echo number_format($Result["Header"]["Total"],0); ?> รายการ </div>
			</div>
			<div class="row mt-5" id="idListBody">
				<div class="col-8 mx-auto">
					<div class="card">

						<div class="table-responsive" style="">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>ชื่อหมวดหมู่ย่อย</th>
										<th>รูปภาพ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$arrData = $Result["Result"];
									for($i=0;$i<sizeof($arrData);$i++){
										$Row=$arrData[$i];
										//print_r($Row);
										include("list-object.php");
									}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
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