<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>



<tr>
	<td><?php echo $i+1; ?></td>
	<td><?php echo $Row["name"]; ?></td>
	<td><?php echo $Row["date"]; ?></td>
	<td><?php echo $Row["historyStatus"]; ?></td>
	<td>
		<button class="btn bg-grey legitRipple" onclick="doEdit(<?php echo $Row['id']; ?>)">ดู/แก้ไข</button>
		<button class="btn btn-danger legitRipple" onclick="doDelete(<?php echo $Row['id']; ?>)">ลบ</button>
	</td>
</tr>