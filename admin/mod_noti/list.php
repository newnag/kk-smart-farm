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

include("list-ajax.php");

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
	?>

  <div class="row">
    <div class="col-4 mx-auto">
      <div class="card p-3">
        <div class="form-group">
          <label class="mb-0 text-grey-800 font-weight-bold">ชื่อเกษตรกร : </label>
          <select class="form-control select select2-hidden-accessible" id="inputName" name="inputName" data-fouc="" tabindex="-1" aria-hidden="true">
            <option value="">เลือกชื่อ</option>
            <?php
              for($i=0;$i<sizeof($arDataA);$i++){
                $listname = $arDataA[$i];
                echo '<option value="'.$listname["id"].'">'.$listname["fullname"].'</option>';
              }
            ?>
          </select>
        </div>
      </div>
    </div>
  </div>
	

	<?php
	if($Result["Header"]["Total"]>0) {
		?>
		<div id="idListData">
			<div class="row">
				<div class="col-12 text-center font-weight-bold font-size-lg text-thaisans text-thaisans-normal"> ค้นพบ <?php echo number_format($Result["Header"]["Total"],0); ?> รายการ </div>
			</div>
			<div class="row mt-5" id="idListBody">
				<div class="col-10 mx-auto">
					<div class="card">

						<div class="table-responsive" style="">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>ชื่อเกษตรกร</th>
										<th>ข้อความ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$arrData = $Result["Result"];
									for($i=0;$i<sizeof($arrData);$i++){
										$Row=$arrData[$i];
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
	$('#inputName').change(function(){
		$('#inputID').val($(this).val());
		$('#mySearchForm').submit();
	})
</script>