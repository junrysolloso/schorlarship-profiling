<option>Select Program</option>
<?php
	require_once 'connection.php';
	$sql = mysqli_query($Conn,"SELECT Course FROM course_info");
	while($r = mysqli_fetch_array($sql)){?>
	<option value="<?php echo $r['Course']?>"><?php echo $r['Course']?></option>
<?php } ?>