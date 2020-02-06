<?php
	function ReturnValue($query){
		$Count = mysqli_num_rows($query);
		return $Count;
	}
?>