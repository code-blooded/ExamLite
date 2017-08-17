<?php

session_start();

$is = $_SESSION['is'];

if(!$_SESSION['uname']){
	header('Location: sign_out.php');
	exit();
}

$education = $_GET['eeducation'];
$loc = $_GET['eloc'];
$phone = $_GET['ephone'];
$status = $_GET['estatus'];
$name = $_GET['ename'];


if(preg_match('/[^0-9]/i', $phone)) 
{
    $phone = null;
}

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$id = $_SESSION['uname'];

mysqli_select_db($conn,"login");

$result = mysqli_query($conn,"UPDATE `user_detail` SET `fname` = '$name', `phone` = '$phone',`status` = '$status',`education` = '$education',`loc` = '$loc' WHERE `uname` = '$id'");

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