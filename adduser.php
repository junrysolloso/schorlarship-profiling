

<!DOCTYPE html>
<html>
<head>
  <title>Students Profiling | Add User</title>
  <?php
	include 'sessioncheck.php';
	require_once 'connection.php';
	if(isset($_POST['submit'])){
		extract($_POST);
		$CPass = md5($password);
		$sql = mysqli_query($Conn,"INSERT INTO user_info (`UserId`, `UserName`, `UserPass`) VALUES ('', '$username', '$CPass')");
		if(!$sql){
			header('location: adduser.php?message=Failed');
		}else{
			header('location: adduser.php?message=Success');
		}	
	}
?>
  <?php include 'css.php' ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">  
 <!-------navigatin-------->
    <?php
    include 'header.php';
    include 'navigation.php';
    ?> 
 <!-------navigatin-------->
    <div class="content-wrapper" style="background-color: rgb(63, 71, 84)">
        <section class="content-header">
            <h1>
                <small style="color:silver"><i class="fa fa-dashboard"></i> <span> ADD USER</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>    
        </section>
        <hr>
        <section class="content container-fluid" style="height:560px ;overflow-y: auto">
        <!------AddUser------>
				<div class="login-box">
					<center>
						<?php error_reporting(0); if($_GET['message'] == "Success"){?>
							<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
								<p>User added successfully.</p>
							</div>
						<?php } ?>
						<?php error_reporting(0); if($_GET['message'] == "Failed"){?>
							<div class="alert alert-warning alert-dismissible">
								<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
								<p>Error while executing the command.</p>
							</div>
						<?php } ?>
					</center>
					<div class="login-logo">		
						<img src="img/images%20(2).bmp" class="img-bordered-sm img-circle" width="110px" height="110px">
					</div>
					<div class="login-box-body" style="margin-top:-90px">
						<div class="container-fluid" style="margin-top:50px">
						<form action="#" method="post">
							<h3 class="text-center profile-username">Add User</h3><hr>
							<div class="form-group has-feedback">
								<input type="text" name="username" class="form-control" required placeholder="Username">
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
							</div>
							<div class="form-group has-feedback">
								<input type="password" name="password" class="form-control" required placeholder="Password">
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
							</div>
							<button class="btn btn-primary btn-md btn-flat btn-block" type="submit" name="submit"><i class="glyphicon glyphicon-plus-sign"></i> <span>Add</span></button>
						</form><hr>
					</div>
				</div>
			</div>
        <!------/AddUser------>          
        </section>
    	</div>
    <!-------footer-------->
        <?php
        include 'footer.php';
        ?> 
    <!-------footer-------->
	</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/chart.js/Chart.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>