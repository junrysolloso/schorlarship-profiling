<!DOCTYPE html>
<html>
<head>
  	<title>Students Profiling | Log in</title>
  	<?php include 'css.php'?>
</head>
<body class="hold-transition">
	<br><br><br><br><br>
 	<div class="login-box">
 		<center>
			<?php error_reporting(0); if($_GET['message'] == "Error"){?>
				<div class="alert alert-info alert-dismissible">
					<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
					<p>Sorry! Please try again.</p>
				</div>
			<?php } ?>
			<?php error_reporting(0); if($_GET['message'] == "Login"){?>
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
					<p>Please login first to start your session.</p>
				</div>
			<?php } ?>
			<?php error_reporting(0); if($_GET['message'] == "Out"){?>
				<div class="alert alert-warning alert-dismissible">
					<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
					<p>You logout successfully.</p>
				</div>
			<?php } ?>
		</center>
		<div class="login-logo">
			<img src="img/images%20(2).bmp" class="img-bordered-sm img-circle" width="110px" height="110px">
		</div>
	 	<div class="login-box-body" style="margin-top:-80px">
			<div class="container-fluid" style="margin-top:20px">
			<h3 class="text-center">Login</h3><hr>
			<form action="start.php" method="post">
				<div class="form-group has-feedback">
					<input type="text" name="username" class="form-control" required placeholder="Username">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
			 	</div>
			 	<div class="form-group has-feedback">
					<input type="password" name="password" class="form-control" required placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			 	</div>
				<button class="btn btn-primary btn-md btn-flat btn-block" type="submit" name="submit"><i class="glyphicon glyphicon-log-in"></i> <span>Login</span></button>
			</form><hr>
			</div><br><br>
	 	</div>
	</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
