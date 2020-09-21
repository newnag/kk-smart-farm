<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>
<div id="mySearchFilter" class="card">
    <div class="card-body" style=" padding-bottom:0px; ">
        <form id="mySearchForm" name="mySearchForm" method="get" action="?">
			<input type="hidden" id="doaction" name="doaction" value="list" />
			<input type="hidden" id="inputID" name="inputID" value="0" />
			<!-- ---------------------------------------------------------- -->
			<input type="hidden" id="inputShowPage" name="inputShowPage" value="<?php echo $_REQUEST["inputShowPage"]; ?>" />
			<input type="hidden" id="inputShowPageSize" name="inputShowPageSize" value="<?php echo $_REQUEST["inputShowPageSize"]; ?>" />
			<input type="hidden" id="inputShowMaxPage" name="inputShowMaxPage" value="<?php echo $_REQUEST["inputShowMaxPage"]; ?>" />
			<input type="hidden" id="inputShowFilter" name="inputShowFilter" value="<?php echo $_REQUEST["inputShowFilter"]; ?>" />
			<!-- ---------------------------------------------------------- -->
            <div class="input-group mb-2">
                <div class="form-group-feedback form-group-feedback-left">
                    <input type="text" id="inputShowSearch" name="inputShowSearch" class="form-control form-control-lg" placeholder="" value="<?php echo $_REQUEST["inputShowSearch"]; ?>">
                    <div class="form-control-feedback form-control-feedback-lg"> <i class="icon-search4 text-muted"></i> </div> </div>
                <div class="input-group-append mr-0"><button type="submit" class="btn btn-success btn-lg <?php echo $System_ThemeClass; ?>" style=" width: 110px; ">ค้นหา</button></div>
                <div class="input-group-append ml-1"><button type="button" class="btn btn-success <?php echo CONFIG_DEFAULT_DESIGN_CLASS; ?> btn-lg" style=" width: 80px; " onclick=" location.href='?'; ">รีเซ็ต</button></div>
            </div>
			<!-- ---------------------------------------------------------- -->
            <div class="d-md-flex align-items-md-center flex-md-wrap text-center text-md-left">
                <div class="btn-group justify-content-center mb-0 mr-4" style=" vertical-align: text-top; ">
					<span class="font-weight-bold text-muted mb-3"> <i class="icon-filter3 mr-1"></i> ตัวกรองข้อมูล </span>
				</div>
                <!-- Right Filter ------------------------------------------------------------ -->
                <ul class="list-inline mb-0 ml-md-auto">
					<!-- Order By ------------------------------------------------------------ -->
                    <li class="list-inline-item">
						<div class="form-group" style=" width:170px; ">
							<select id="inputShowOrderBy" name="inputShowOrderBy" class="form-control select FilterSearch" data-fouc>
								<optgroup label="เรียงตาม">
									<option value="ID" <?php if($_REQUEST["inputShowOrderBy"]=="ID") { echo ' selected '; } ?>> วันที่สร้าง </option>
									<option value="Key" <?php if($_REQUEST["inputShowOrderBy"]=="Key") { echo ' selected '; } ?>> คีย์ </option>
								</optgroup>
							</select>
						</div>
                    </li>
					<!-- ASCDESC ------------------------------------------------------------ -->
                    <li class="list-inline-item">
						<div class="form-group" style=" width:140px; ">
							<select id="inputShowASCDESC" name="inputShowASCDESC" class="form-control select FilterSearch" data-fouc>
								<optgroup label="ลำดับ">
									<option value="DESC" <?php if($_REQUEST["inputShowASCDESC"]=="DESC") { echo ' selected '; } ?>> มากไปน้อย </option>
									<option value="ASC" <?php if($_REQUEST["inputShowASCDESC"]=="ASC") { echo ' selected '; } ?>> น้อยไปมาก </option>
								</optgroup>
							</select>
						</div>
                    </li>
					<!-- ------------------------------------------------------------ -->
                </ul>
                <!-- ------------------------------------------------------------ -->
            </div>
			<!-- ---------------------------------------------------------- -->
        </form>
    </div>
</div>