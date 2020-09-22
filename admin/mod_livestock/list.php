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

//print_r($Result["Result"]);
//print_r($Result["ResultF"]);
//exit();

#-------------------------------------------------------------------
# Show Page Header Panel
#-------------------------------------------------------------------
$Config_ShowButton=array("add","filter");
include_once("../inc/inc_page_header.php");

include("list-select.php");

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

	?>

	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">เลือกฟาร์มที่ต้องการ</h5>
			<div class="header-elements">
				<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
		</div>

		<form action="?" id="FormSelectFarm" name="FormSelectFarm" method="get">
			<input type="hidden" id="doaction" name="doaction" value="list" />
			<input type="hidden" id="inputFamrSelect" name="inputFamrSelect"  value="<?php echo $_REQUEST["inputFamrSelect"]; ?>" />

			<div class="card-body">
				<div class="form-group">
					<label>ชื่อฟาร์ม :</label>
					<select data-placeholder="เลือกฟาร์ม" id="SelectFarm" class="form-control form-control-lg select select2-hidden-accessible" data-container-css-class="select-lg" data-fouc="" tabindex="-1" aria-hidden="true">
						<option value=""></option>
						<?php 
							$arr = $ResultA["Result"];
							for($i=0;$i<sizeof($arr);$i++){
								$dataArr = $arr[$i];
								echo '<option value="'.$dataArr["id"].'">'.$dataArr["name"].'</option>';
							}
						?>
					</select>
				</div>
			</div>
		</form>
	</div>

<?php if($Result["Header"]["Total"]>0) {
		?>

	<div id="idListData">
		<div class="row">
			<div class="col-12 text-center font-weight-bold font-size-lg text-thaisans text-thaisans-normal"> ค้นพบ <?php echo number_format($Result["Header"]["Total"],0); ?> รายการ </div>
		</div>
		<div class="row mt-5" id="idListBody">
			<div class="col-12">
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title"><?php echo MODULE_NAME; ?></h5>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>

					<div class="table-responsive" style="">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>ชื่อสัตว์</th>
									<th>ชื่อฟาร์ม</th>
									<th>ประเภท</th>
									<th>สายพันธุ์</th>
									<th>เลขไมโครชิพ</th>
									<th>วันเกิด</th>
									<th>สถานะ</th>
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
<script>
	$('#SelectFarm').change(function(){
		$('#inputFamrSelect').val($(this).val());
		$('#FormSelectFarm').submit();
	})
</script>