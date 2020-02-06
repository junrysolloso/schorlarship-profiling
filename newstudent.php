<!DOCTYPE html>
<html>
<head>
  	<title>Students Profiling | New Student</title>
    <?php
        include 'sessioncheck.php';
        require_once 'connection.php';
        if(isset($_POST['submit'])){
            extract($_POST);
            $FileSize = $_FILES['ProfilePic']['size'];
            $TempName = $_FILES['ProfilePic']['tmp_name'];
            $PicName = $_FILES['ProfilePic']['name'];
            $TargetDir = "upload/";
            $targetName = $TargetDir .basename($_FILES['ProfilePic']['name']);
            $FileType = pathinfo($targetName, PATHINFO_EXTENSION);
            if($FileType != "jpg" && $FileType != "png"){
                header('location: newstudent.php?message=FileType');
            }
            elseif($FileSize > 5000000){
                header('location: newstudent.php?message=FileSize');
            }
            else{
                move_uploaded_file($TempName, "upload/" .$PicName);
                $PicName = $_FILES['ProfilePic']['name'];               
                $sql1 = mysqli_query($Conn,"INSERT INTO `student_info`(`StId`, `IdNumber`, `Fname`, `Lname`, `Mname`, `DateBirth`, `Gender`, `CivilStatus`, `Address`, `EmailAdd`, `PhoneNo`, `ProfilePic`) VALUES ('','$IdNumber','$Fname','$Lname','$Mname','$DateBirth','$Gender','$CivilStatus','$Address','$EmailAdd','$PhoneNo','$PicName')");
                $query1 = mysqli_query($Conn,"SELECT MAX(StId) FROM student_info");
                while($r1 = mysqli_fetch_assoc($query1)){
                    $StudentId = $r1['MAX(StId)'];
                }
                $sql2 = mysqli_query($Conn,"INSERT INTO `parent_info`(`PaId`, `ParentName`, `ParentPhone`, `Municipality`) VALUES ('','$ParentName','$ParentPhone','$Municipality')");
                $slq3 = mysqli_query($Conn,"INSERT INTO `enroll_info`(`EnId`, `Course`, `YearLevel`, `AcademicYear`, `DropStatus`) VALUES ('','$Program','$YearLevel','$AcademicYear','NO')");       
                $sql4 = mysqli_query($Conn,"INSERT INTO `educ_info`(`EdId`, `ElemComp`, `HighComp`, `ElemGrad`, `HighGrad`) VALUES ('','$ElemComp','$HighComp','$ElemGrad','$HighGrad')");  
                $sql5 = mysqli_query($Conn,"INSERT INTO `applied_info`(`ApId`, `DateApplied`) VALUES ('','$DateApplied')"); 

                if(!$sql1 && !$sql2 && !$sql3 && !$sql4 && !$sql5){
                    header('location: newstudent.php?message=Failed');
                }else{
                    header('location: newstudent.php?message=Success');
                }    
            }
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
    <div class="content-wrapper" style="background-color: rgb(63, 71, 84);">
        <section class="content-header">
            <h1>
                <small style="color:silver"><i class="fa fa-plus"></i> <span>ADD NEW SCHOLAR</span></small>
                <a href="stop.php" class="btn pull-right"><i class="fa fa-sign-out"></i> <span>LOG OUT</span></a>
            </h1>
        </section>
        <hr>
        <section class="content container-fluid" style="height:560px ;overflow-y: auto">                   
        <!------NewStudent------>                    
        <form method="POST" enctype="multipart/form-data" action="#">
            <div class="row">
               <center>
					<div class="col-sm-12">
					   <?php error_reporting(0); if($_GET['message']=="Success"){?>
							<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
								<p>Data successfully save.</p> 
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
               		<div class="col-sm-12">
						<?php error_reporting(0); if($_GET['message']=="Other"){?>
							<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
								<p>Program save successfully.</p> 
							</div>
						<?php } ?> 
					</div>
              		<div class="col-sm-12">
						<?php error_reporting(0); if($_GET['message']=="CExist"){?>
							<div class="alert alert-danger alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
								<p>Program already exist.</p> 
							</div>
						<?php } ?> 
					</div>
               		<div class="col-sm-12">
						<div class="alert alert-warning alert-dismissible">
							<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a>
							<p>Please check your program in the combobox whether it exist otherwise click other button.</p> 
						</div>
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
                                    <img src="img/user.png" width="160px" height="160px" class="img-bordered-sm img-circle" alt="User Image">
                                </center>    
                            </div>
                            <div class="form-group">
                                <label>Picture</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input type="file" onrequest="CheckFile()" class="btn btn-default btn-sm" name="ProfilePic" required style="width:100%">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Firstname</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-angle-double-right"></i>
                                        </div>
                                        <input type="text" class="form-control input-sm" name="Fname" placeholder="Enter Firstname" required>
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
                                        <input type="text" class="form-control input-sm" name="Lname" placeholder="Enter Lastname" required>
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
                                        <input type="text" class="form-control input-sm" name="Mname" placeholder="Enter Middlename" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Civil Status</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <select class="form-control input-sm" name="CivilStatus" required>
                                        <option>Select Status</option>
                                        <option value="Single"> Single</option>
                                        <option value="Married"> Married</option>
                                        <option value="widow"> widow</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <select class="form-control input-sm" name="Gender" required>
                                        <option>Select Gender</option>
                                        <option value="Male"> Male</option>
                                        <option value="Female"> Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input type="email" class="form-control input-sm" name="EmailAdd" placeholder="Enter Email Address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input type="text" class="form-control input-sm" name="PhoneNo" placeholder="Enter Phone Number" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </div>
                                    <input type="Date" class="form-control input-sm" name="DateBirth" placeholder="Enter Select date" required>
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
                                            <input type="text" class="form-control input-sm" name="IdNumber" placeholder="Enter Id Number" required>
                                        </div>
                                    </div>
									<div class="form-group">
										<label>Program/Major</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-angle-double-right"></i>
											</div>
											<select class="form-control input-sm" name="Program" onchange="submit()" required>
												<?php include 'course.php';?>
											</select>
											<div class="input-group-btn">
												<button name="Other" type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-flat btn-outline input-sm"><i class="fa fa-plus-circle"></i> <span>Other</span></button>
											</div>
										</div>
									</div>
                                    <div class="form-group">
                                        <label>Year Level</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <select class="form-control" name="YearLevel" required>
                                                <?php include 'yearlevel.php';?>
                                            </select>
                                        </div>
                                    </div>                              
                                </div>
                                
                                <div class="col-sm-6">
                                   <div class="form-group">
                                        <label>Academic Year</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <select class="form-control input-sm" name="AcademicYear" required>
                                                <?php include 'academicyear.php';?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Date Applied</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                            <input type="Date" class="form-control input-sm" name="DateApplied" required>
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
                                            <input type="text" class="form-control input-sm" name="ParentName" placeholder="Enter Parent/Guardian Fullname" required>
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
                                            <input type="text" class="form-control input-sm" name="ParentPhone" placeholder="Enter Parent/Guardian Phone" required>
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
                                            <select class="form-control input-sm" name="Municipality" required>
                                                <?php include 'municipality.php';?>
                                            </select>
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
                                            <textarea type="text" class="form-control input-sm" name="Address" placeholder="Enter Address" required></textarea>
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
                                             <input type="text" class="form-control input-sm" name="ElemComp" placeholder="Enter Elementary School Address" required>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label>Elementary Year Graduated</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                             <select class="form-control input-sm" name="ElemGrad" required>
                                                <?php include 'year.php';?>
                                            </select>    
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
                                             <input type="text" class="form-control input-sm" name="HighComp" placeholder="Enter High School Address" required>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label>High  School Year Graduated</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </div>
                                             <select class="form-control input-sm" name="HighGrad" required>
                                                <?php include 'year.php';?>
                                            </select>
                                        </div>
                                    </div>                   
                                </div>         
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <button type="submit" name="submit" value="send" class="btn btn-info btn-block"><i class="fa fa-save"></i> <span>Save</span></button>
                </div>
            </div>
        </form>
        <!------/NewStudent------>        
        </section>
    </div>
    <form action="savecourse.php" method="post">
		<div class="modal modal-info fade" id="modal-info" style="color:silver">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true"><i class="fa fa-close"></i></span></button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> <span>Add Program/Course</span></h4>
					</div>
					<div class="modal-body">
					<span class="fa fa-ul"></span>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-angle-double-right"></i>
								</div>
								<input class="form-control" name="OtherCourse" type="text" placeholder="Program description example 'Bachelor of Science in Civil Engineering'" required>							
							</div>
						</div>				
					</div>
					<div class="modal-footer">
						<button type="submit" name="save" class="btn btn-flat btn-outline"><i class="fa fa-plus-circle"></i> <span>Save</span></button>
					</div>
				</div>
			</div>
		</div>
   	</form>
  	<!-------footer-------->
		<?php
		include 'footer.php';
		?> 
	<!-------footer-------->
		<?php
		function CheckFile(){
			$Check = $_REQUEST['ProfilePic'];
			if($Check.ok == "true"){
				$FileSize = $_FILES['ProfilePic']['size'];
				$TempName = $_FILES['ProfilePic']['tmp_name'];
				$PicName = $_FILES['ProfilePic']['name'];
				$TargetDir = "upload/";
				$targetName = $TargetDir .basename($_FILES['ProfilePic']['name']);
				$FileType = pathinfo($targetName, PATHINFO_EXTENSION);
				if($FileType != "jpg" && $FileType != "png"){
					header('location: newstudent.php?message=FileType');
				}
				elseif($FileSize > 5000000){
					header('location: newstudent.php?message=FileSize');
				}
			}
		}
		?>
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>