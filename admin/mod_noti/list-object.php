<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>


<tr>
	<td><?php echo $i+1; ?></td>	
	<td><?php echo $Row["subject"]; ?></td>
	<td><?php echo $Row["username"]; ?></td>
	<td><?php echo $Row["date"]; ?></td>
	<td><?php echo $Row["unread"]; ?></td>
	<td>
		<button class="btn btn-success legitRipple" onclick="doEdit(<?php echo $Row['id']?>,<?php echo $Row['userID']; ?>)">ตอบคำถาม</button>
		<button class="btn btn-danger legitRipple" onclick="doDelete(<?php echo $Row['id']; ?>)">ลบ</button>
	</td>
</tr>