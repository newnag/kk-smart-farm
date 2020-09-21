<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
# Load Data from API
#-------------------------------------------------------------------
$SendRequest=array("act"=>MODULE_TABLE."_List");
$SendRequest["inputShowStatus"]="Enable";
$SendRequest["inputShowOrderBy"]="Order";
$SendRequest["inputShowASCDESC"]="DESC";
$SendRequest["inputShowPage"]="1";
$SendRequest["inputShowPageSize"]="1000";
$Result=System_GetAPI(SYSTEM_DB_MODE_BACKEND,$SendRequest);
//-------------------------------------------------------------------
$arStaffGroup=$Result["Category"]["StaffGroup"];
$_REQUEST["inputShowMaxPage"]=$Result["Header"]["MaxPage"];

#-------------------------------------------------------------------
# Show Page Header Panel
#-------------------------------------------------------------------
$Config_ShowButton=array("back");
include_once("../inc/inc_page_header.php");

	?>
	<div class="content">
		<?php
		if($Result["Header"]["TotalRecord"]>0) {
			?>
			<div id="idListData">
				<div class="row">
					<div class="col-12 text-center font-weight-bold font-size-lg text-thaisans text-thaisans-normal text-warning" id="idTest"> คลิ๊กลาก! ไปมาเพื่อเรียงลำดับ </div>
				</div>
				<!-- Form ------------------------------------------------------- -->
				<form id="myBackForm" name="myBackForm" method="get" action="?">
					<input type="hidden" id="doaction" name="doaction" value="list" />
					<!-- Remember Current List State ---------------------------- -->
					<input type="hidden" id="inputShowFilter"     name="inputShowFilter"     value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
					<input type="hidden" id="inputShowStatus"     name="inputShowStatus"     value="<?php echo $_REQUEST["inputShowStatus"]; ?>" />
					<input type="hidden" id="inputShowOrderBy"    name="inputShowOrderBy"    value="<?php echo $_REQUEST["inputShowOrderBy"]; ?>" />
					<input type="hidden" id="inputShowASCDESC"    name="inputShowASCDESC"    value="<?php echo $_REQUEST["inputShowASCDESC"]; ?>" />
					<!-- ---------------------------------------------------------- -->
				</form>
				<form id="mySortForm" name="mySortForm" method="post" action="?">
				<div class="row" id="idListBody" style=" margin-top: 10px; ">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<ul id="sortable">
							<?php
							$arData=$Result["Result"];
							for($i=0;$i<sizeof($arData);$i++) {
								$Row=$arData[$i];
								?>
								<li class="ui-state-default">
									<input type="hidden" name="<?php echo $Row["ID"]; ?>" value="" />
									<?php
									
									#-------------------------------------------------------------------
									# Show Object
									#-------------------------------------------------------------------
									$Config_ViewOnly=true;
									include("list-object.php");
									
									?>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
				</div>
				</form>
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
	<script>
	$(function() {
		$("#sortable").sortable({
			placeholder: "ui-state-highlight" ,
			update: function( ) {
				var serializeVar = $("#mySortForm").serialize();
				var arID = serializeVar.split('=&');
				var myText=',';
				for(i=0;i<arID.length;i++) { 
					myText+=arID[i].replace('=','')+',';
				}
				doAlert('กำลังอัพเดทข้อมูลการเรียงลำดับ!','info');
				$.ajax('update-sorting-ajax.php?inputData='+myText, {
					dataType: 'text',
					success: function(data){
						if(data=='OK') {
							doAlert('บันทึกการเรียงลำดับ เรียบร้อยแล้ว!','success');
						}
					}
				});	
				
			}
		});
		$("#sortable").disableSelection();
	});
	</script>
	<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
	#sortable li { margin: 3px 3px 3px 0; padding: 4px; float: left; width: 350px; height: 130px; cursor: pointer; margin-bottom: 10px; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; background-color: #AAAAAA; }
	</style>
	<script>
	//----------------------------------------
	function doBack() {
	//----------------------------------------
		$('#doaction').val('list');
		$('#myBackForm').submit();
	}
	</script>