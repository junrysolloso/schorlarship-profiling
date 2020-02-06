<?php
	require_once 'connection.php';
	if(isset($_POST['submit'])){
		extract($_POST);
		$DateFormat = date('m:d:y');
		$GetYear = date('Y' ,strtotime($DateFormat));
		$AYToday = $GetYear .'-'. ($GetYear + 1);
		$query1 = mysqli_query($Conn,"SELECT AcademicYear FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE student_info.StId = '$EnId' LIMIT 1");
        while ($r = mysqli_fetch_assoc($query1)){
        	$v = $r['AcademicYear'];
        }
		if($AcademicYear == "Select Academic Year"){
			header("location: updatestatus.php?EnId=$EnId&&message=AY");
		}
		elseif($v == $AYToday){
			header("location: studentslist.php?message=AYExist");
		}
		else{
			$query2 = mysqli_query($Conn,"UPDATE `enroll_info` SET `YearLevel`='$YearLevel',`AcademicYear`='$AcademicYear' WHERE EnId = '$EnId'");
			if(!$query2){
				header("location: studentslist.php?EnId=$EnId&&message=Failed");
			}else{
				header("location: studentslist.php?EnId=$EnId&&message=Success");
			}
			mysqli_free_result($query1);
			mysqli_free_result($query2);
			mysqli_close($Conn);
		}	
    }
?>