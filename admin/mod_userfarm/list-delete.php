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
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>อีเมล์</th>
                                <th>เบอร์โทร</th>
                                <th>เพศ</th>
                                <th>ที่อยู่</th>
                                <th>ตำบล</th>
                                <th>อำเภอ</th>
                                <th>จังหวัด</th>
                                <th>รหัสไปรษณีย์</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><?php echo $Row["fullname"]; ?></td>
                            <td><?php echo $Row["lastname"]; ?></td>
                            <td><?php echo $Row["email"]; ?></td>
                            <td><?php echo $Row["tel"]; ?></td>
                            <td><?php echo $Row["sex"]; ?></td>
                            <td><?php echo $Row["address"]; ?></td>
                            <td><?php echo $Row["subdistrict"]; ?></td>
                            <td><?php echo $Row["district"]; ?></td>
                            <td><?php echo $Row["province"]; ?></td>
                            <td><?php echo $Row["postcode"]; ?></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
