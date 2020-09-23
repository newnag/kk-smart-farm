<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

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
                                <th>ชื่อสัตว์</th>
                                <th>วันที่ตรวจ</th>
                                <th>สถานะการตรวจ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><?php echo $Row["livestock"]; ?></td>
                            <td><?php echo $Row["date"]; ?></td>
                            <td><?php echo $Row["status"]; ?></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
