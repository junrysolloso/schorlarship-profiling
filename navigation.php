
<?php
    $index = "";
    $student = "";
    $newstudent = "";
    $studentlist = "";
    $status = "";
    $updateprofile = "";
    $updatestatus = "";
    $droplist = "";
    $print = "";
	$Hide = "hide";
	$AddUser = "";
	$Backup = "";
    $PageName = basename($_SERVER['PHP_SELF']);
    switch($PageName){
        case "index.php":
            $index = "active";
            break;
        case "studentslist.php":
            $student = "active";
            $studentlist ="active";
            break;
        case "droplist.php":
            $droplist = "active";
            break;
        case "updateprofile.php":
            $updateprofile = "active";
            break;
        case "updatestatus.php":
            $updatestatus = "active";
            break;
        case "newstudent.php":
            $student = "active";
            $newstudent = "active";
            break;
        case "printfilter.php":
            $print = "active";
            break;
        case "printpreview.php":
            $print = "active";
            break;
		case "printlist.php":
            $ProfileList = "active";
            break;
		case "adduser.php":
			$AddUser = "active";
			break;
		case "backup.php":
			$Backup = "active";
			break;
    }
	if($_SESSION['user'] == 1){
		$Hide = "";
	}
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <center>
                <img src="img/images%20(2).bmp" width="100px" height="100px" class="profile-user-img img-circle" alt="User Image">
            </center>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
        <span class="fa fa-ul"> </span>
        <span class="fa fa-ul"> </span>
        <span class="fa fa-ul"> </span>
        <span class="fa fa-ul"> </span>
        <li class="header"> <strong>MENU</strong></li>
        <li class="<?php echo $index;?>">
            <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </li>
        <li class="<?php echo $student;?><?php echo $updateprofile;?><?php echo $updatestatus;?> treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Scholar</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="<?php echo $newstudent;?>">
               <a href="newstudent.php"><i class="fa fa-plus"></i> <span>New Scholar</span>
                   <span class="pull-right-container">
                       <i class="fa fa-angle-right"></i>
                   </span>
               </a>
           </li>
            <li class="<?php echo $studentlist;?>">
                <a href="studentslist.php"><i class="fa fa-list"></i> <span>Scholars List</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
            </li>
			<li>
                <a href="#Updatemodal" data-dismiss="modal" data-toggle="modal"><i class="fa fa-pencil"></i> <span>Update All</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
            </li>
          </ul>
        </li>
        <li class="<?php echo $droplist;?>">
            <a href="droplist.php"><i class="fa fa-dropbox"></i> <span>Remove List</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-right"></i>
                </span>
            </a>
        </li>
		<li class="<?php echo $print;?> <?php echo $ProfileList?> treeview">
          <a href="#"><i class="fa fa-print"></i> <span>Reports</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="<?php echo $ProfileList?>">
				<a href="#ProfileList" data-toggle="modal" data-dismiss="modal"><i class="fa fa-check-circle"></i> <span>Profile List</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right"></i>
					</span>
				</a>
        	</li>
            <li class="<?php echo $print;?>">
				<a href="printpreview.php"><i class="fa fa-print"></i> <span>Scholars Total</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right"></i>
					</span>
				</a>
			</li>
          </ul>
        </li>
        <li class="<?php echo $Hide;?> <?php echo $AddUser;?> <?php echo $Backup;?> treeview">
          <a href="#"><i class="fa fa-gears"></i> <span>Utility</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="<?php echo $AddUser;?>">
				<a href="adduser.php"><i class="fa fa-user-plus"></i> <span>Add User</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right"></i>
					</span>
				</a>
        	</li>
            <li class="<?php echo $Backup;?>">
                <a href="backup.php"><i class="fa fa-database"></i> <span>Backup DB</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
            </li>
          </ul>
        </li>
      </ul>
    </section>
</aside>

<form action="updateall.php" method="post">
	<div class="modal modal-info fade" id="Updatemodal" style="color:silver">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true"><i class="fa fa-close"></i></span></button>
					<h4 class="modal-title"><i class="fa fa-check"></i> <span>Select to update</span></h4>
				</div>
				<div class="modal-body">
					<span class="fa fa-ul"></span>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-angle-double-right"></i>
								</div>
								<select name="Course" class="form-control" required>
									<?php include 'course.php'?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-angle-double-right"></i>
								</div>
								<select name="YearLevel" class="form-control" required>
									<option>Select Year Level</option>
									<option value="1st Year">1st Year</option>
									<option value="2nd Year">2nd Year</option>
									<option value="3rd Year">3rd Year</option>
								</select>
							</div>
						</div>
					</div>
				<div class="modal-footer">
					<button type="submit" name="save" class="btn btn-info btn-outline"><i class="fa fa-pencil"></i> <span>Update all</span></button>
				</div>
			</div>
		</div>
	</div>
</form>

<form action="previewlist.php" method="post">
	<div class="modal modal-info fade" id="ProfileList" style="color:silver">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true"><i class="fa fa-close"></i></span></button>
					<h4 class="modal-title"><i class="fa fa-print"></i> <span>Select to print</span></h4>
				</div>
				<div class="modal-body">
					<span class="fa fa-ul"></span>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-angle-double-right"></i>
								</div>
								<select name="Course" class="form-control" required>
									<?php include 'course.php'?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-angle-double-right"></i>
								</div>
								<select name="YearLevel" class="form-control" required>
									<?php include 'yearlevel.php'?>
								</select>
							</div>
						</div>
					</div>
				<div class="modal-footer">
					<button type="submit" name="print" type="submit" class="btn btn-info btn-outline"><i class="fa fa-print"></i> <span>Print</span></button>
				</div>
			</div>
		</div>
	</div>
</form>
