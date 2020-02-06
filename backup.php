
<!DOCTYPE html>
<html>
<head>
 	<title>Students Profiling | Backup DB</title>
 	<?php
	include 'sessioncheck.php';
	error_reporting(0);
	backup_tables("localhost","root","","profilingsystem");
	function backup_tables($host,$user,$pass,$name,$tables = '*')
	{
		$link = mysqli_connect($host,$user,$pass);
		mysqli_select_db($link,$name);
		if($tables == '*')
		{
			$tables = array();
			$result = mysqli_query($link,'SHOW TABLES');
			while($row = mysqli_fetch_row($result))
			{
				$tables[] = $row[0];
			}	
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		foreach($tables as $table)
		{
			$result = mysqli_query($link,'SELECT * FROM '.$table);
			$num_fields = mysqli_num_fields($result);	
			$return.= 'DROP TABLE '.$table.';';
			$row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";	
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysqli_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);

						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}

		$handle = fopen('db-backup.sql','w+');
		fwrite($handle,$return);
		fclose($handle);	
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
                <small style="color:silver"><i class="fa fa-dashboard"></i> <span> BACKUP DATABASE</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>    
        </section>
        <hr>
        <section class="content container-fluid" style="height:560px ;overflow-y: auto">
        <!------DbBackup------>		
					<center style="color:white; margin-top:120px">
						<p style="font-family: century gothic">
							DATABASE BACKUP FOR SCHOLARSHIP<br>
							PROGRAM PROFILING SYSTEM	
						</p>
						<p style="font-family: century gothic">Database Backup successfully.</p>
						<?php
							$dir = dirname(__FILE__);
						?>
						<a href="db-backup.sql" target="_blank" style="font-family: century gothic"> Download Backup</a>
						<p style="font-family: century gothic">
							Copyright &copy; Scholarship Program Profiling System<br>
							Design and Program by Syrnuj
						</p>
					</center>
        <!------/DbBackup------>          
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