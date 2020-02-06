<?php
	include 'sessioncheck.php';
	require_once 'connection.php';
	require_once  'functions.php';
	$TodayYear = date('m:d:y');
	$Year = date('Y',strtotime($TodayYear));
	$AYToday = $Year .'-'. ($Year + 1);
	$query = mysqli_query($Conn,"SELECT enroll_info.EnId, student_info.StId, Fname, Lname, Mname, Course, YearLevel, Address, PhoneNo, ProfilePic,IdNumber, Gender, CivilStatus, EmailAdd, DateBirth FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE DropStatus = 'NO' AND AcademicYear = '$AYToday'");
	$CountRow = ReturnValue($query);
	if(isset($_POST['Course'])){
		extract($_POST);
		$query = mysqli_query($Conn,"SELECT enroll_info.EnId, student_info.StId, Fname, Lname, Mname, Course, YearLevel, Address, PhoneNo, ProfilePic,IdNumber, Gender, CivilStatus, EmailAdd, DateBirth FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE Course = '$Course' AND DropStatus = 'NO' AND AcademicYear = '$AYToday'");
		$CountRow = ReturnValue($query);
	}
?>
<!DOCTYPE html>
<html>
<head>
  	<title>Students Profiling | List of Scholar</title>
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
                <small style="color:silver"><i class="fa fa-list"></i> <span>LIST OF ALL SCHOLARS</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>
        </section>
        <hr>
        <section class="content container-fluid" style="height:560px ;overflow-y: auto">      
      	<!------StudentsList------>
        <center>
         	<div class="container-fluid">
				<div class="row">
				   <div class="col-sm-12">
					   <?php error_reporting(0); if($_GET['message']=="Success"){?>
							<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
								<p>Status successfully updated.</p> 
							</div>
						<?php } ?> 
					</div>
					<div class="col-sm-12">
						<?php error_reporting(0); if($_GET['message']=="Failed"){?>
							<div class="alert alert-danger alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
								<p>Error occured during the execution.</p> 
							</div>
						<?php } ?> 
					</div>
					<?php if($CountRow == 0){?>
						<div class="alert alert-dismissible alert-warning">
							<a href="#" class="close" data-dismiss="alert"><i class="fa fa-times"></i></a>
							<p>No records found.</p>
						</div>
					<?php } ?>
					<?php error_reporting(0); if($_GET['message'] == "AYExist"){?>
						<div class="alert alert-warning alert-dismissible">
							<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
							<p>Selected student is already updated in this academic year.</p>
						</div>
					<?php } ?>
				</div>
           	</div>
            <div style="width:800px">
                <div class="box-header">
                	<div class="row">
                		<div class="col-sm-4">
                			<a href="#" class="btn btn-box-tool pull-left " data-widget="collapse"><i class="fa fa-circle-thin"></i></a>
                		</div>
                		<div class="col-sm-4">
                		<span class="fa fa-ul"></span>
							<form action="#" method="POST">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-angle-double-right"></i>
										</div>
										<select name="Course" class="form-control input-sm" onchange="this.form.submit()">
											<?php include 'course.php'?>
										</select>
										<div class="input-group-addon">
											<i class="fa fa-angle-double-left"></i>
										</div>
									</div>
								</div>
							</form>
                		</div>
                		<div class="col-sm-4">
                			<a href="#" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-circle-thin"></i></a>
                		</div>
                	</div>            
                </div>
                <div class="box-body">
                    <table id="StudentList">
                        <thead>
                            <tr>
                                <th><center><h3>Personal Information</h3></center></th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                while($v = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <td>
									<div class="box box-default" style="width:750px">
										<div class="box-body">		
											<div class="row">
												<div class="col-sm-4">
													<div class="box-body box-profile">
														<center>
															<img src="upload/<?php echo $v['ProfilePic'];?>" width="120px" height="120px" class="img-bordered img-circle">
															<h3 class="profile-username">
																<?php echo $v['Lname'];?>, <?php echo $v['Fname'];?> <?php echo $v['Mname'];?>
															</h3>
															<p><?php echo $v['Course'];?></p>
															<div class="btn-group">
																<a href="updateprofile.php?StId=<?php echo $v['StId'];?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <span>Profile</span></a>
																<a href="updatestatus.php?EnId=<?php echo $v['EnId'];?>" class="btn btn-primary btn-sm"><i class="fa fa-line-chart"></i> <span>Status</span></a>         
															</div>
														</center>
													</div>   
												</div>
												<div class="col-sm-8">
													<div class="col-sm-6">
														<div class="box-body box-profile">
															<strong><i class="fa fa-circle-thin"></i> <span>Id Number</span></strong>
															<p><?php echo $v['IdNumber']?></p>
															<strong><i class="fa fa-circle-thin"></i> <span>Year Level</span></strong>
															<p><?php echo $v['YearLevel']?></p>
															<strong><i class="fa fa-circle-thin"></i> <span>Gender</span></strong>
															<p> <?php echo $v['Gender']?></p>
															<strong><i class="fa fa-circle-thin"></i> <span>Status</span></strong>
															<p> <?php echo $v['CivilStatus']?></p>                                            
														</div>
													</div> 
													<div class="col-sm-6">
														<div class="box-body box-profile">
															<strong><i class="fa fa-circle-thin"></i> <span>Date Of Birth</span></strong>
															<p><?php echo $v['DateBirth']?></p>
															<strong><i class="fa fa-circle-thin"></i> <span>Email Address</span></strong>
															<p><?php echo $v['EmailAdd']?></p>
															<strong><i class="fa fa-circle-thin"></i> <span>Phone number</span></strong>
															<p> <?php echo $v['PhoneNo']?></p>
															<strong><i class="fa fa-circle-thin"></i> <span>Address</span></strong>
															<p> <?php echo $v['Address']?></p>               
														</div>
													</div>                
												</div>
											</div>
										</div>
									</div>
                                </td>              
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                <a href="#" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-circle-thin"></i></a>
                <a href="#" class="btn btn-box-tool pull-left" data-widget="collapse"><i class="fa fa-circle-thin"></i></a>
                </div>
            </div>
        </center>
        <!------/StudentsList------>       
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
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/chart.js/Chart.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $('#StudentList').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>