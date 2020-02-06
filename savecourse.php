
<?php 
	require_once 'class.php';
	require_once 'connection.php';
	if(ISSET($_POST['save'])){	
		extract($_POST);
		$initilize = preg_replace('/\b(\w)\w*\W*/', '\1', $OtherCourse);
		$CourseName = implode((''),array_diff_assoc(str_split(ucwords($initilize)),str_split(strtolower($initilize))));
		$sql = mysqli_query($Conn,"SELECT Course FROM course_info WHERE Course = '$CourseName'");
		$r = mysqli_fetch_assoc($sql);
		extract($r);
		if($Course == $CourseName){
			header('location: newstudent.php?message=CExist');
		}else{		
			$conn = new db_class();
			$conn->create($CourseName, $OtherCourse);
			header('location: newstudent.php?message=Other');
		}
	}	
?>