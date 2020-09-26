<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>


<tr>
	<td><?php echo $Row["username"]; ?></td>
	<td><?php echo $Row["text"]; ?></td>
	<td><?php echo $Row["status"]; ?></td>
	<td>
		<button class="btn btn-danger legitRipple" onclick="doDelete(<?php echo $Row['id']; ?>)">ลบ</button>
	</td>
</tr>