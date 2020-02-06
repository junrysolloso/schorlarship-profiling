<?php 
	include 'connection.php';
	if(isset($_POST['submit'])){
		extract($_POST);
		$CPass = md5($password);
		$sql = mysqli_query($Conn,"SELECT * FROM user_info WHERE UserName = '$username' AND UserPass = '$CPass'");
		$read = mysqli_fetch_assoc($sql);
		$r = mysqli_num_rows($sql);
		extract($read);
		if($r > 0){
			session_start();
			$_SESSION['user'] = $UserId;
			header('location: index.php');
		}else{
			header('location: login.php?message=Error');
		}
	}
?>