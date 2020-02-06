<?php
	include 'sessioncheck.php';
	if(isset($_POST['print'])){
		extract($_POST);
	}
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Students Profiling | Print Preview</title>
	<?php include 'css.php'?>
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
		<div class="table-responsive">
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
					<tr><td colspan="6"></td></tr>
				</tfoot>
			</table>
		</div>
			<div class="row no-print">
				<div class="col-xs-12">
					<a href="printlist.php?Course=<?php echo $Course?>&&YearLevel=<?php echo $YearLevel?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
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