<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>


<tr>
	<td><?php echo $i+1; ?></td>
	<td><?php echo $Row["name"]; ?></td>
	<td>
		<button class="btn bg-grey legitRipple" onclick="doEdit(<?php echo $Row['id']; ?>)">แก้ไข</button>
		<button class="btn btn-danger legitRipple" onclick="doDelete(<?php echo $Row['id']; ?>)">ลบ</button>
	</td>
</tr>