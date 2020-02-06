<?php
require_once 'connection.php';
require_once 'functions.php';
if(isset($_POST)){
		extract($_POST);
		$TodayYear = date('m:d:y');
		$Year = date('Y',strtotime($TodayYear));
		$AYToday = $Year .'-'. ($Year + 1);						
		$StId = array();
		$Update = "";
		if($Course == "Select Program"){
			header("location: index.php?message=Course");
		}else{
			$q = mysqli_query($Conn, "SELECT EnId FROM enroll_info WHERE DropStatus = 'NO' AND Course = '$Course' AND YearLevel = '$YearLevel'");
			while($r =  mysqli_fetch_array($q)){
				$StId[] = $r['EnId'];
			}	
			$RCount = ReturnValue($q);
			if($YearLevel == "Select Year Level"){
				header('location: index.php?message=Select');
			}
			elseif($RCount == 0){
				header('location: index.php?message=Empty');
			}else{
				if($YearLevel == "1st Year"){
				$Update = "2nd Year";
				}elseif($YearLevel == "2nd Year"){
					$Update = "3rd Year";
				}elseif($YearLevel == "3rd Year"){
					$Update = "4th Year";
				}
				for($i=0;$i < $RCount;$i++){
				$sql = mysqli_query($Conn,"UPDATE enroll_info SET YearLevel = '$Update' WHERE EnId = '$StId[$i]'");
				}
				if(!$sql){
					header('location: index.php?message=Failed');
				}else{
					header("location: index.php?message=Success&&Count=$RCount");
				}	
			}
		}
	}
?>