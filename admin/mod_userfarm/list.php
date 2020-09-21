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
//$arStaffGroup=$Result["Category"]["StaffGroup"];
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
	//print_r($Result["Result"]);

	if($Result["Header"]["Total"]>0) {
		?>
		<div id="idListData">
			<div class="row">
				<div class="col-12 text-center font-weight-bold font-size-lg text-thaisans text-thaisans-normal"> ค้นพบ <?php echo number_format($Result["Header"]["Total"],0); ?> รายการ </div>
			</div>
			<div class="row mt-5" id="idListBody">
				<div class="col-12">
					<div class="card">
						<div class="card-header header-elements-inline">
							<h5 class="card-title">ข้อมูลเกษตรกร</h5>
							<div class="header-elements">
								<div class="list-icons">
									<a class="list-icons-item" data-action="collapse"></a>
									<a class="list-icons-item" data-action="reload"></a>
								</div>
							</div>
						</div>

						<div class="table-responsive" style="">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>ชื่อผู้ใช้</th>
										<th>ชื่อ นามสกุล</th>
										<th>เบอร์โทร</th>
										<th>อีเมล์</th>
										<th>เพศ</th>
										<th>วันเกิด</th>
										<th>ที่อยู่</th>
										<th>ตำบล</th>
										<th>อำเภอ</th>
										<th>จังหวัด</th>
										<th>รหัสไปรษณีย์</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									echo' <tr>
										<td>1</td>
										<td>Eugene</td>
										<td>Kopyov</td>
										<td>@Kopyov</td>
									</tr>';
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