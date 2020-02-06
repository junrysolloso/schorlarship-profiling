<?php
	include 'sessioncheck.php';
    require_once 'connection.php';
    if(isset($_GET['EnId'])){
        extract($_GET);
    }
	$TodayYear = date('m:d:y');
	$Year = date('Y-d-m',strtotime($TodayYear));
    if(isset($_POST['submit'])){
        extract($_POST);
        $query1 = mysqli_query($Conn,"UPDATE `enroll_info` SET `DropStatus`='YES', `DropDate`='$Year', `Comments`='$Comments' WHERE EnId = '$EnId'");
        if(!$query1){
            header("location: studentslist.php?EnId=$EnId&&message=Failed");
        }else{
            header("location: studentslist.php?EnId=$EnId&&message=Success");
        }
        mysqli_free_result($query1);
    }
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Students Profiling | Add Comments</title>
	<?php include 'css.php'?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="container-fluid">
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
                <a href="updatestatus.php?EnId=<?php echo $EnId;?>" class="btn pull-left"><i class="fa fa-backward"></i> <span>BACK</span></a>
                <small style="color:silver"><i class="fa fa-line-chart"></i> <span>ADD COMMENTS</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>
        </section>
        <hr>
        <section class="content container-fluid" style="height:560px ;overflow-y: auto">         
        <?php
            $query = mysqli_query($Conn,"SELECT EnId, Fname, Lname, Mname, ProfilePic FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE student_info.StId = '$EnId' LIMIT 1");
            $r = mysqli_fetch_array($query);
            extract($r);
        ?>     
        <!------UpdateProfile------>      
        <form method="POST" action="#">
            <div class="row" style="margin-top: 60px">
                <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                       <div class="box box-danger">
                            <div class="box-body box-profile">
                                <input type="hidden" name="EnId" value="<?php echo $EnId;?>">
                                <span class="fa fa-ul"></span>
                                <div class="form-group">
                                   <label>Comments</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-angle-double-right"></i>
                                        </div>
                                        <textarea name="Comments" class="form-control" required placeholder="Your Comments"></textarea>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger btn-md btn-block"><i class="fa fa-minus-circle"></i> <span>Remove</span></button>   
                            </div>  
                        </div>         
                    </div>
                <div class="col-sm-3"></div>
            </div>
        </form>   
        <!------/UpdateProfile------>   
        	</section>
    	</div>
	<!-------footer-------->
		<?php
		include 'footer.php';
		?> 
	<!-------footer-------->
    </div>
  	</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>