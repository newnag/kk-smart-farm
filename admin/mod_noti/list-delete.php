<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>
<div id="idListData">
    <div class="row mt-5" id="idListBody">
        <div class="col-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title"><?php echo MODULE_NAME ; ?></h5>
                </div>

                <div class="table-responsive" style="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ชื่อเกษตรกร</th>
                                <th>ข้อความ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><?php echo $Row["fullname"]; ?></td>
                            <td><?php echo $Row["text"]; ?></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>