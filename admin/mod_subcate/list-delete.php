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
                            <th>ชื่อหมวดหมู่ย่อย</th>
                            <th>ชื่อหมวดหมู่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><?php echo $Row["name"]; ?></td>
                            <td><?php echo $Row["cateName"]; ?></td>
                            <td><?php echo $Row["choice"]; ?></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
