<?php
	include 'sessioncheck.php';
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Students Profiling | Home</title>
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
                <small style="color:silver"><i class="fa fa-dashboard"></i> <span> DASHBOARD</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>
        </section>
        <hr>
        <section class="content container-fluid" style="height:560px ;overflow-y: auto">
        <!------Dashboard------>
				<?php
					require_once 'connection.php';
					require_once 'functions.php';
					$TodayYear = date('m:d:y');
					$Year = date('Y',strtotime($TodayYear));
					$AYToday = $Year .'-'. ($Year + 1);
					$query1 = mysqli_query($Conn,"SELECT Gender FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE Gender = 'Male' AND AcademicYear = '$AYToday'");
					$query2 = mysqli_query($Conn,"SELECT Gender FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE Gender = 'Female' AND AcademicYear = '$AYToday'");
					$query3 = mysqli_query($Conn,"SELECT YearLevel FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE YearLevel = '4th Year' AND DropStatus = 'NO' AND AcademicYear = '$AYToday'");
					$query4 = mysqli_query($Conn,"SELECT student_info.StId FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE AcademicYear = '$AYToday'");
					$query5 = mysqli_query($Conn,"SELECT student_info.StId FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE DropStatus = 'YES' AND AcademicYear = '$AYToday'");
					$CountMale = ReturnValue($query1);
					$CountFemale = ReturnValue($query2);
					$CountGraduating = ReturnValue($query3);
					$CountAll = ReturnValue($query4);
					$CountDrop = ReturnValue($query5);
				?>
				<center>
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12">
								<?php if($CountAll == 0){?>
									<div class="alert alert-warning alert-dismissible">
										<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
										<p>No records found</p>
									</div>
								<?php } ?>
							</div>
							<div class="col-sm-12">
								<?php error_reporting(0); if($_GET['message'] == "Empty"){?>
									<div class="alert alert-warning alert-dismissible">
										<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
										<p>No records to update.</p>
									</div>
								<?php } ?>
							</div>
							<div class="col-sm-12">
								<?php error_reporting(0); if($_GET['message'] == "Failed"){?>
									<div class="alert alert-danger alert-dismissible">
										<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
										<p>Failed to update all records.</p>
									</div>
								<?php } ?>
							</div>
							<div class="col-sm-12">
								<?php error_reporting(0); if($_GET['message'] == "Success"){?>
									<div class="alert alert-success alert-dismissible">
										<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
										<p><?php echo $_GET['Count']?> records updated successfully.</p>
									</div>
								<?php } ?>
							</div>
							<div class="col-sm-12">
								<?php error_reporting(0); if($_GET['message'] == "Select"){?>
									<div class="alert alert-warning alert-dismissible">
										<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
										<p>Please select valid year level.</p>
									</div>
								<?php } ?>
							</div>
							<div class="col-sm-12">
								<?php error_reporting(0); if($_GET['message'] == "Course"){?>
									<div class="alert alert-warning alert-dismissible">
										<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
										<p>Please select valid Course.</p>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="widget-user-header">
						<h3>PROVINCE OF DINAGAT ISLANDS</h3>
						<h1 class="widget-user-username">SCHOLARSHIP PROGRAM PROFILING SYSTEM</h1>
					</div>
					<span class="fa fa-ul"></span>
					<div style="width:550px; height:auto;">
						<div class="widget-user-image">
						  <img class="img-bordered img-circle" src="img/images%20(2).bmp" width="200px" height="200px" alt="User Avatar">
						</div>
						<span class="fa fa-ul"></span>
						<div class="box-footer">
							<div class="row">
								<div class="col-sm-3">
									<div class="description-block">
										<h5 class="description-header"><?php echo $CountAll;?></h5>
										<span class="description-text">ENROLLED</span>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="description-block">
										<h5 class="description-header"><?php echo $CountMale;?></h5>
										<span class="description-text">MALE</span>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="description-block">
										<h5 class="description-header"><?php echo $CountFemale;?></h5>
										<span class="description-text">FEMALE</span>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="description-block">
										<h5 class="description-header"><?php echo $CountGraduating;?></h5>
										<span class="description-text">GRADUATING</span>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="description-block">
										<h5 class="description-header"><?php echo $CountDrop;?></h5>
										<span class="description-text">REMOVE</span>
									</div>
								</div>
						  </div>
						  <hr>
						</div>
					</div>
				</center>
        <!------/Dashboard------>
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
