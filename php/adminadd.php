<?php

session_start();

$is = $_SESSION['is'];

if(!$_SESSION['uname']){
	header('Location: sign_out.php');
	exit();
}

$exid = $_GET['exid'];
$qid = $_POST['eid'];
$ques= $_POST['eques'];
$opa = $_POST['eopa'];
$opb = $_POST['eopb'];
$opc = $_POST['eopc'];
$opd = $_POST['eopd'];
$mark = $_POST['emark'];
$ans = $_POST['eans'];

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



mysqli_select_db($conn,"login");

$result = mysqli_query($conn,"INSERT INTO `bank` (`eid`, `qid`, `ques`,`opa`, `opb`,`opc`, `opd`, `ans`, `mark`) VALUES ('$exid', '$qid', '$ques', '$opa', '$opb', '$opc', '$opd', '$ans', '$mark')");

mysqli_close($conn);

if($result){
	if($is==0)
		header('Location: profile.php');
	else
		header('Location: adminprofile.php');
	exit();
}
else{
	exit();
}

exit();

?>