<?php
	date_default_timezone_set('Asia/Kolkata');
	session_start();
	if(!$_SESSION['uname']){
		header('Location: sign_out.php');
		exit();
	}
	$conn = mysqli_connect("localhost","root","");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_select_db($conn,"login");

	$id = $_SESSION['uname'];
	$result = mysqli_query($conn,"SELECT `fname`, `lname`, `phone`, `status`, `education`, `loc`, `img` FROM `user_detail` WHERE uname='$id'");

	if(!$result){
		echo "
		<script language='javascript'>
			alert('Failed!');
		</script>
		";
		exit();
	}
	$row = mysqli_fetch_assoc($result);
	if($row["fname"])
	$fname = $row["fname"];
	else
	$fname = $_SESSION["uname"];
	$lname = $row["lname"];
	$phone = $row["phone"];
	$status = $row["status"];
	$education = $row["education"];
	$loc = $row["loc"];
	$img = $row["img"];

	if($_SESSION['sname']){
		$id = $_SESSION['sname'];
	}else{
		$id = $_SESSION['uname'];
	}
	$sresult = mysqli_query($conn,"SELECT `fname`, `lname`, `phone`, `status`, `education`, `loc`,`img` FROM `user_detail` WHERE uname='$id'");

	mysqli_close($conn);

	if(!$result){
		echo "
		<script language='javascript'>
			alert('Failed!');
		</script>
		";
		exit();
	}
	$row = mysqli_fetch_assoc($sresult);
	if($row["fname"])
	$sfname = $row["fname"];
	else
	$sfname = $_SESSION["uname"];
	$slname = $row["lname"];
	$sphone = $row["phone"];
	$sstatus = $row["status"];
	$seducation = $row["education"];
	$sloc = $row["loc"];
	$simg = $row["img"];

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="refresh" content="60">
  <title>ExamLiTE | User Profile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Ex</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Exam</b>LiTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="sign_out.php" class="dropdown-toggle" >
              <span class="hidden-xs">Sign out</span>
            </a>

          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <!--<a href="#" data-toggle="control-sidebar"></a>-->
          </li>
        </ul>
      </div>
    </nav>
  </header>




  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $img;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $fname;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="search.php" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="query" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
		<a href="#" class="fa fa-angle-right"></a>
        <?php if($_SESSION['uname']==$_SESSION['sname']){
			echo "Update Profile <small><a href=\"../php/edit_profile.php\" class=\"fa fa-edit\"></a></small>";
		}else{
			echo "User Profile";
		}?>
      </h3>
    </section>
    <!-- Main content -->
    <section class="content">
		<ol class="content-header">
			<h4><a href="../php/profile.php"></i>Home</a></h4>
		</ol>
		<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $simg;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $sfname;?></h3>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                <?php echo $seducation;?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $sloc;?></p>

			  <hr>

			  <strong><i class="fa fa-mobile margin-r-5"></i> Phone</strong>

              <p class="text-muted">
			  <?php
				  if($sphone)
				  echo $sphone;
				  else
				  echo "**********";
			  ?></p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Status</strong>

              <p><?php echo $sstatus;?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->



        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#upcoming" data-toggle="tab">Upcoming Exams</a></li>
			  <li><a href="#past" data-toggle="tab">Past Exams</a></li>
            </ul>
            <div class="tab-content">
			<!-- wall contents go here -->
				<div id="upcoming" class="active tab-pane">
					<!--<div>
					<strong>Upcoming Exams</strong>
					<!--</div>-->
					<ul class="list-group list-group-unbordered">
						<?php
							$conn = mysqli_connect("localhost","root","");
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							mysqli_select_db($conn,"login");
							$result = mysqli_query($conn,"SELECT `id`, `name`, `date`, `start`, `end` FROM `exam`");
							mysqli_close($conn);
							if(!$result){
								echo "
								<script language='javascript'>
									alert('Failed!');
								</script>
								";
								exit();
							}

							while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
								$current = date("Y-m-d")." ".date("H:i:s");
								$ext = $rows["date"]." ".$rows["start"];
								$over = $rows["date"]." ".$rows["end"];
								//echo "$current";
								if(strtotime($current) > strtotime($over)):
									continue;
								endif;
							$start_date = new DateTime($current);
							$since_start = $start_date->diff(new DateTime($ext));
						?>
								<li class="list-group-item">
								<div class="row">
								<div class="col-md-3"><?php echo $rows["name"];?></div>
								<div class="col-md-3"><?php echo $rows["date"];?></div>
								<div class="col-md-3"><p id="demo1">
								<?php
									if($since_start->days > 1):
										echo $since_start->days." days left";
									elseif($since_start->days<=0 && strtotime($current) > strtotime($ext) && strtotime($current) < strtotime($over)):
										echo $since_start->h." hours to end : Ongoing";
									elseif($since_start->days<=0):
										echo $since_start->h." hours left";
									elseif($since_start->days==1):
										echo $since_start->days." day and ".$since_start->h." hours left";
									endif;
								?></p></div>
								<?php
									$connn = mysqli_connect("localhost","root","");
									if ($connn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									}
									mysqli_select_db($connn,"login");
									$exid = $rows["id"];
									$us = $_SESSION['uname'];
									$rresult = mysqli_query($connn,"SELECT `userid`, `examid` FROM `registered` WHERE userid = '$us' and examid = '$exid'");
									mysqli_close($connn);
									$rrows = mysqli_fetch_array($rresult,MYSQLI_ASSOC);
									if(!$rrows){
										//if(strtotime($current) > strtotime($ext) && strtotime($current) < strtotime($over)){
											//$_SESSION['exam']=$exid = $rows["id"];
										//echo "<div class=\"col-md-3 right\" style=\"text-align:right;\"><a href=\"exam.php?exid=".$exid."&qid=1\" class=\"btn btn-warning btn-xs\">Live</a></div>";
										//}else{
										echo "<div class=\"col-md-3 right\" style=\"text-align:right;\"><a href=\"exam_reg.php?exid=".$exid."\" class=\"btn btn-primary btn-xs\">Register</a></div>";
										//}
									}else{
										if(strtotime($current) > strtotime($ext) && strtotime($current) < strtotime($over)){
										echo "<div class=\"col-md-3 right\" style=\"text-align:right;\"><a href=\"exam.php?exid=".$exid."&qid=1\" class=\"btn btn-warning btn-xs\">Live</a></div>";
										}else{
										echo "<div class=\"col-md-3 right\" style=\"text-align:right;\"><a href=\"#\" class=\"btn btn-success btn-xs\">Registered</a></div>";
										}
									}

								?>
								</div>
								</li>
						<?php
							}
						?>
					</ul>
				</div>
				<div id="past" class="tab-pane">
					<!--<strong>Past Exams</strong>-->
					<ul class="list-group list-group-unbordered">

						<?php
							$conn = mysqli_connect("localhost","root","");
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							mysqli_select_db($conn,"login");
							$result = mysqli_query($conn,"SELECT `name`, `date`, `end` FROM `exam`");
							mysqli_close($conn);
							if(!$result){
								echo "
								<script language='javascript'>
									alert('Failed!');
								</script>
								";
								exit();
							}
						?>

						<?php
							while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
								$current = date("Y-m-d")." ".date("H:i:s");
								$ext = $rows["date"]." ".$rows["end"];
								if(strtotime($current) < strtotime($ext)):
									continue;
								endif;
								$start_date = new DateTime($current);
								$since_start = $start_date->diff(new DateTime($ext));
						?>
							<li class="list-group-item">
								<div class="row">
								<div class="col-md-4"><?php echo $rows["name"];?></div>
								<div class="col-md-4"></div>
								<div class="col-md-4 right" style="text-align:right;"><a href="score.php" class="btn btn-danger btn-xs">View Solution</a></div>

								</div>
							</li>
						<?php
							}
						?>
					</ul>
				</div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->






    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.1.1
    </div>
    <strong>Copyright &copy; 2016-2017 <a href="#">code_blooded</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Tab panes -->
    <div class="tab-content">

    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
</body>
</html>
