<?php
	include 'sessioncheck.php';
    require_once 'connection.php';
    if(isset($_GET['EnId'])){
        extract($_GET);
        $hide = "";
    }
?>
<!DOCTYPE html>
<html>
<head>
  	<title>Students Profiling | Update Student Status</title>
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
                <a href="studentslist.php" class="btn pull-left"><i class="fa fa-backward"></i> <span>BACK</span></a>
                <small style="color:silver"><i class="fa fa-line-chart"></i> <span>UPDATE SCHOLAR STATUS</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>
        </section>
        <hr>
        <section class="content container-fluid" style="height:560px ;overflow-y: auto">        
        <?php
            $query = mysqli_query($Conn,"SELECT EnId, ProfilePic, YearLevel ,Fname, Lname, Mname, Course, AcademicYear FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId WHERE student_info.StId = '$EnId' LIMIT 1");
            $r = mysqli_fetch_array($query);
            extract($r);
        ?>  
        <!------UpdateProfile------>
        <center>
            <?php error_reporting(0); if($YearLevel == "4th Year"){?>
                <div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
                    <p>This student is already 4th year.</p>
                </div>
            <?php } ?>
            <?php error_reporting(0); if($_GET['message'] == "AY"){?>
                <div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert"><i class="fa fa-close"></i></a>
                    <p>Please select a valid academic year.</p>
                </div>
            <?php } ?>
        </center>
        <form method="POST" action="aytrap.php">
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-4 border-right"></div>
                    <div class="col-sm-4 border-right">
                       <div class="box box-info">
                            <div class="box-body box-profile">
                                <span class="fa fa-ul"></span>
                                <center>
                                    <img class="img-bordered img-circle" width="150px" height="150px" src="upload/<?php echo $ProfilePic;?>" alt="User profile picture">
                                </center>
                                <h3 class="profile-username text-center">
                                    <?php echo $Fname?> <?php echo $Mname?>. <?php echo $Lname?>
                                </h3>
                                <p class="text-center"><?php echo $Course?> - <?php echo $YearLevel?></p>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-angle-double-right"></i>
                                        </div>
                                        <select class="form-control" name="AcademicYear" required>
                                       		<?php include 'academicyear.php'?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-angle-double-right"></i>
                                        </div>
                                        <select class="form-control" name="YearLevel" required>
                                            <?php if($YearLevel == "1st Year"){?> 
                                                <option value='2nd Year'>2nd Year</option>
                                                <option value='3rd Year'>3rd Year</option>
                                                <option value='4th Year'>4th Year</option>            
                                            <?php } if($YearLevel == "2nd Year"){?>
                                                <option value='3rd Year'>3rd Year</option>
                                                <option value='4th Year'>4th Year</option> 
                                            <?php } if($YearLevel == "3rd Year"){?>
                                                <option value='4th Year'>4th Year</option>    
                                            <?php } ?>     
                                            <?php if($YearLevel == "4th Year"){
                                                $hide = "hide"?>
                                                <option>No option available.</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="EnId" value="<?php echo $EnId?>">
                                <button type="submit" name="submit" class="btn btn-info btn-md btn-block <?php echo $hide?>"><i class="fa fa-edit">
                                </i> <span>Update</span></button>
                                <a href="comments.php?EnId=<?php echo $EnId;?>" class="btn btn-danger btn-block btn-md <?php echo $hide?>"><i class="fa fa-minus-circle"></i> <span>Remove</span></a>  
                            </div>  
                        </div>         
                    </div>
                <div class="col-sm-4"></div>
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