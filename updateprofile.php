<?php
	include 'sessioncheck.php';
    include 'connection.php';
    if(isset($_GET['StId'])){
        extract($_GET);
    }
    if(isset($_POST['submit'])){
        extract($_POST);
        $FileSize = $_FILES['ProfilePic']['size'];
        $TempName = $_FILES['ProfilePic']['tmp_name'];
        $PicName = $_FILES['ProfilePic']['name'];
        $TargetDir = "upload/";
        $targetName = $TargetDir .basename($_FILES['ProfilePic']['name']);
        $FileType = pathinfo($targetName, PATHINFO_EXTENSION); 
        if($PicName != ""){            
            if($FileType != "jpg" && $FileType != "png"){
                header('location: updateprofile.php?message=FileType');
            }
            elseif($FileSize > 5000000){
                header('location: updateprofile.php?message=FileSize');
            }else{
                move_uploaded_file($TempName,"upload/".$PicName);
                $PicName = $_FILES['ProfilePic']['name'];
            }   
        }else{
            $PicName = $OldProfilePic;
        }
        $sql1 = mysqli_query($Conn,"UPDATE `student_info` SET `IdNumber`='$IdNumber',`Fname`='$Fname',`Lname`='$Lname',`Mname`='$Mname',`DateBirth`='$DateBirth',`Gender`='$Gender',`CivilStatus`='$CivilStatus',`Address`='$Address',`EmailAdd`='$EmailAdd',`PhoneNo`='$PhoneNo',`ProfilePic`='$PicName' WHERE StId = '$StId'");
        $sql2 = mysqli_query($Conn,"UPDATE `parent_info` SET `ParentName`='$ParentName',`ParentPhone`='$ParentPhone',`Municipality`='$Municipality' WHERE PaId = '$StId'");
        $sql3 = mysqli_query($Conn,"UPDATE `enroll_info` SET `Course`='$Course' WHERE EnId = '$StId'");
        $sql4 = mysqli_query($Conn,"UPDATE `educ_info` SET `ElemComp`='$ElemComp',`HighComp`='$HighComp',`ElemGrad`='$ElemGrad',`HighGrad`='$HighGrad' WHERE EdId = '$StId'");
        if(!$sql1 && !$sql2 && !$sql3 && !$sql4){
            header('location: updateprofile.php?message=Failed');
        }else{
            header('location: updateprofile.php?message=Success');
        }            
    }
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Students Profiling | Update Student Profile</title>
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
                <small style="color:silver"><i class="fa fa-edit"></i> <span>UPDATE SCHOLAR PROFILE</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>
        </section>
        <hr>
        <section class="content container-fluid" style="height:560px ;overflow-y: auto">     
        <!------NewStudent------>  
        <?php
            if(isset($_GET['StId'])){
                extract($_GET);
                $query = mysqli_query($Conn,"SELECT DISTINCT * FROM student_info INNER JOIN enroll_info ON student_info.StId = enroll_info.EnId INNER JOIN parent_info ON student_info.StId = parent_info.PaId INNER JOIN educ_info ON parent_info.PaId = educ_info.EdId WHERE student_info.StId = '$StId'");
                $r = mysqli_fetch_assoc($query);
                extract($r);
            }
        ?>       
        <form method="POST" enctype="multipart/form-data" action="#">
            <div class="row">
                <center>
                    <div class="col-sm-12">
                       <?php error_reporting(0); if($_GET['message']=="Success"){?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
                                <p>Data successfully updated.</p> 
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
                    <div class="col-sm-12">
                        <?php error_reporting(0); if($_GET['message']=="FileType"){?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
                                <p>Image format is not valid.</p> 
                            </div>
                        <?php } ?> 
                    </div>
                    <div class="col-sm-12">
                        <?php error_reporting(0); if($_GET['message']=="FileSize"){?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
                                <p>Your image is too large.</p> 
                            </div>
                        <?php } ?> 
                    </div>
                </center>
                <div class="col-sm-4">
                   <div class="box box-info">
                       <div class="box-header">
                           <i class="fa fa-info-circle"></i> <span>Personal Information</span>
                           <button type="button" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       </div>
                        <div class="box-body">
                            <div class="user-panel">
                                <center>
                                    <img src="upload/<?php echo $ProfilePic ;?>" width="160px" height="160px" class="img-bordered-sm img-circle" alt="User Image">
                                </center>    
                            </div>
                            <div class="form-group">
                                <label>Picture</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input type="hidden" name="OldProfilePic" value = "<?php echo $ProfilePic ;?>">
                                    <input type="file" class="btn btn-default btn-sm" name="ProfilePic" style="width:100%">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Firstname</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-angle-double-right"></i>
                                        </div>
                                        <input type="text" value="<?php echo $Fname; ?>" class="form-control input-sm" name="Fname" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-angle-double-right"></i>
                                        </div>
                                        <input type="text" value="<?php echo $Lname; ?>" class="form-control input-sm" name="Lname" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Middlename</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-angle-double-right"></i>
                                        </div>
                                        <input type="text" value="<?php echo $Mname; ?>" class="form-control input-sm" name="Mname" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Civil Status</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input class="form-control input-sm" type="text" value="<?php echo $CivilStatus; ?>" name="CivilStatus" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input class="form-control input-sm" type="text" value="<?php echo $Gender; ?>" name="Gender" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input type="text" value="<?php echo $EmailAdd; ?>" class="form-control input-sm" name="EmailAdd" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input type="text" value="<?php echo $PhoneNo; ?>" class="form-control input-sm" name="PhoneNo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input type="Date" value="<?php echo $DateBirth; ?>" class="form-control input-sm" name="DateBirth" required>
                                </div>
                            </div>                                                             
                       </div>
                   </div>           
                </div>            
                <div class="col-sm-8">
                    <div class="box box-info">
                        <div class="box-header">
                            <i class="fa fa-circle-thin"></i> <span>Program Information</span>
                            <button type="button" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>ID Number</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <input type="text" value="<?php echo $IdNumber; ?>" class="form-control input-sm" name="IdNumber" required>
                                        </div>
                                    </div>                                 
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Program/Major</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <input class="form-control input-sm" type="text" value="<?php echo $Course; ?>" name="Course" required>
                                        </div>
                                    </div>                
                                </div>
                            </div>
                        </div>
                    </div>                 
                    <div class="box box-info">
                        <div class="box-header">
                            <i class="fa fa-user"></i> <span>Parent/Gaurdian Information</span>
                            <button type="button" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                   <div class="form-group">
                                        <label>Parent/Guardian Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <input type="text" value="<?php echo $ParentName; ?>" class="form-control input-sm" name="ParentName" required>
                                        </div>
                                    </div>                              
                                </div>
                                <div class="col-sm-6">
                                   <div class="form-group">
                                        <label>Parent/Guardian Phone Number</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <input type="text" value="<?php echo $ParentPhone; ?>" class="form-control input-sm" name="ParentPhone" required>
                                        </div>
                                    </div>          
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Municipality</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <input class="form-control input-sm" type="text" value="<?php echo $Municipality; ?>" name="Municipality" required>
                                        </div>
                                    </div>                                  
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <input value="<?php echo $Address; ?>" class="form-control input-sm" name="Address" required>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>                    
                     <div class="box box-info">
                        <div class="box-header">
                            <i class="fa fa-book"></i> <span>Educational Background</span>
                            <button type="button" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Elementary Completed</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                             <input type="text" value="<?php echo $ElemComp; ?>" class="form-control input-sm" name="ElemComp" required>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label>Elementary Year Graduated</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                             <input class="form-control input-sm" type="text" value="<?php echo $ElemGrad; ?>" name="ElemGrad" required>   
                                        </div>
                                    </div>                                           
                                </div>
                                <div class="col-sm-6">
                                   <div class="form-group">
                                        <label>High School Completed</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                             <input type="text" value="<?php echo $HighComp; ?>" class="form-control input-sm" name="HighComp" required>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label>High  School Year Graduated</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                             <input class="form-control input-sm" type="text" value="<?php echo $HighGrad; ?>" name="HighGrad" required>
                                        </div>
                                    </div>                   
                                </div>         
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <button type="submit" name="submit" value="send" class="btn btn-warning btn-block"><i class="fa fa-edit"></i> <span>Update</span></button>
                </div>
            </div>
        </form>
        <!------/NewStudent------>    
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