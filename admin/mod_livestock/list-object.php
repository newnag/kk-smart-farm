<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

?>


<tr>
	<td><?php echo $i+1; ?></td>
	<td><?php echo $Row["name"]; ?></td>
	<td><?php echo $Row["farmName"]; ?></td>
	<td><?php echo $Row["type"]; ?></td>
	<td><?php echo $Row["gene"]; ?></td>
	<td><?php echo $Row["microchip"]; ?></td>
	<td><?php echo $Row["DOB"]; ?></td>
	<td><?php echo $Row["healthStatus"]; ?></td>
	<td>
		<button class="btn bg-grey legitRipple" onclick="doEdit(<?php echo $Row['id']; ?>,<?php echo $Row['farmID']; ?>)">ดู/แก้ไข</button>
		<button class="btn btn-danger legitRipple" onclick="doDelete(<?php echo $Row['id']; ?>,<?php echo $Row['farmID']; ?>)">ลบ</button>
	</td>
</tr>