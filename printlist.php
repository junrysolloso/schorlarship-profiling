<?php
	include 'sessioncheck.php';
	if(isset($_GET['Course'])){
		extract($_GET);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<style>th,td,section{color: black} @page{size:auto; margin:0mm}</style>
 	<title>Students Profiling | Print List</title>
	<?php include 'css.php'?>
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="window.print()">
<div class="wrapper">
    <section class="content container-fluid" style="height:560px ;overflow-y: auto">  
    <style> th,td{color: black }</style>    
    <?php 
		require_once 'connection.php';
		require_once 'functions.php';
		$TodayYear = date('m:d:y');
		$Year = date('Y',strtotime($TodayYear));
		$AYToday = $Year .'-'. ($Year + 1);		
		$sql1 = mysqli_query($Conn,"SELECT IdNumber, Fname, Lname, Mname, Address, EmailAdd, PhoneNo, Municipality FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId INNER JOIN parent_info ON student_info.StId = parent_info.PaId WHERE Course = '$Course' AND YearLevel = '$YearLevel' AND DropStatus = 'NO' AND AcademicYear = '$AYToday'");
		$Total = ReturnValue($sql1);
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
			<h4>Governor's Scholar List</h4>
			<h4><?php echo $Course ?> - <?php echo $YearLevel?></h4>
			<h4>Academic Year <?php echo $AYToday ?></h4>
		</center>
		<span class="fa fa-ul"></span>
		<div class="table-responsive" style="margin:20px">
			<table class="table table-condensed">
				<thead>
					<th>ID NUMBER</th>
					<th>FULLNAME</th>
					<th>ADDRESS</th>
					<th>PHONE NO</th>
					<th>EMAIL ADD</th>
					<th>MUNICIPALITY</th>
				</thead>
				<tbody>
				<?php
					while($r = mysqli_fetch_array($sql1)){	
				?>
				<tr>
					<td><?php echo $r['IdNumber']?></td>
					<td><?php echo $r['Lname']?>, <?php echo $r['Fname']?> <?php echo $r['Mname']?></td>
					<td><?php echo $r['Address']?></td>
					<td><?php echo $r['PhoneNo']?></td>
					<td><?php echo $r['EmailAdd']?></td>
					<td><?php echo $r['Municipality']?></td>
				</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td>Total<span class="pull-right">:</span></td>
						<td><?php echo $Total?></td>
						<td colspan="4"></td>
					</tr>
					<tr><td colspan="6"></td></tr>
				</tfoot>
			</table>
		</div>
    </section>
    <!------/PintReport------>
	</section>
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