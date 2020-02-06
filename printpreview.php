<?php
	include 'sessioncheck.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<title>Students Profiling | Print Preview</title>
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
                <small style="color:silver"><i class="fa fa-eye"></i> <span>PREVIEW REPORTS</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>
        </section>
        <hr>
    <section class="content container-fluid" style="height:560px ;overflow-y: auto">  
    <style> th,td{color: black }</style>    
    <?php 
		require_once 'connection.php';
		require_once 'functions.php';
		$TodayYear = date('m:d:y');
		$Year = date('Y',strtotime($TodayYear));
		$AYToday = $Year .'-'. ($Year + 1);			
		$sql3 = mysqli_query($Conn,"SELECT StId FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE Gender = 'Male' AND DropStatus = 'NO' AND AcademicYear = '$AYToday'");
		$sql4 = mysqli_query($Conn,"SELECT StId FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE Gender = 'Female' AND DropStatus = 'NO' AND AcademicYear = '$AYToday'");
		$sql5 = mysqli_query($Conn,"SELECT StId FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE DropStatus = 'YES' AND AcademicYear = '$AYToday'");
		$sql6 = mysqli_query($Conn,"SELECT StId FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE DropStatus = 'NO' AND YearLevel = '4th Year' AND AcademicYear = '$AYToday'");
		$Male = ReturnValue($sql3);
		$Female = ReturnValue($sql4);
		$Drop = ReturnValue($sql5);
		$Graduating = ReturnValue($sql6);
		$Total = $Female + $Male;
		$OverAll = $Total + $Drop;		
    ?> 
    <!------PintReport------>
    <?php if($Total == 0){?>
		<center>
			<div class="alert alert-warning alert-dismissible">
				<a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
				<p>You have zero entries in the current report.</p>
			</div>
		</center>
    <?php } ?>
    <section class="invoice" style="color: black">
        <center>
			<img src="img/images%20(2).bmp" class="img-circle img-bordered" width="120px" height="120px">
			<h3>PDI College Scholarship Program</h3>
			<h4>Total Number of Governor's Scholar</h4>
			<h4>Academic Year <?php echo $AYToday ?></h4>
		</center>
		<div class="table-responsive">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>NO</th>
						<th>PROGRAM</th>
						<th>DESCRIPTION</th>
						<th>GRADUATING</th>
						<th>TOTAL</th>
					</tr>
				</thead>
				<tbody>
				<?php			
					$Course = array();
					$Desc = array();
					$CountAll = 0;
					$q = mysqli_query($Conn, "SELECT Course, Description FROM course_info");
					while($r =  mysqli_fetch_array($q)){
						$Course[] = $r['Course'];
						$Desc[] = $r['Description'];
					}	
					for($i=0;$i<ReturnValue($q);$i++){
						$sql1 = mysqli_query($Conn,"SELECT StId FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE Course = '$Course[$i]' AND DropStatus = 'NO' AND AcademicYear = '$AYToday'");
						$sql2 = mysqli_query($Conn,"SELECT StId FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE Course = '$Course[$i]' AND DropStatus = 'NO' AND YearLevel = '4th Year' AND AcademicYear = '$AYToday'");
						$CountScholar = ReturnValue($sql1);
						$CountGraduating = ReturnValue($sql2);
				?>
					<tr>
						<td><?php echo $i + 1 ?></td>
						<td><?php echo $Course[$i] ?></td>
						<td><?php echo $Desc[$i] ?></td>
						<td><?php echo $CountGraduating ?></td>
						<td><?php echo $CountScholar ?></td>
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>	
					<tr><td colspan="5"></td></tr>
				</tfoot>
			</table>
			<div style="width:250px">
				<table class="table table-condensed">
					<tbody>
						<tr>
							<td>Total Graduating<span class="pull-right">:</span></td>
							<td><?php echo $Graduating?></td>
						</tr>
						<tr>
							<td>Total Male<span class="pull-right">:</span></td>
							<td><?php echo $Male?></td>
						</tr>
						<tr>
							<td>Total Female<span class="pull-right">:</span></td>
							<td><?php echo $Female?></td>
						</tr>
						<tr>
							<td>Total Enrolled<span class="pull-right">:</span></td>
							<td> <?php echo $Total?></td>
						</tr>
					</tbody>
				</table>
			</div>
			</div>
			<div class="row no-print">
				<div class="col-xs-12">
					<a href="printreport.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
				</div>
			</div>
    	</section>
        <!------/PintReport------>
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