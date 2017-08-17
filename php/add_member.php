<?php

session_start();

//get username and password
$username = $_POST['uname'];
$email = $_POST['email'];
$password = $_POST['pass'];
$rpassword = $_POST['rpass'];

$password = sha1($password);

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn,"login");

$result = mysqli_query($conn,"INSERT INTO `user` (`username`, `password`, `email`) VALUES ('$username', '$password', '$email')");
$done = mysqli_query($conn,"INSERT INTO `user_detail` (`uname`) VALUES ('$username')");

mysqli_close($conn);

if($result){
	$_SESSION['uname'] = $username;
	$_SESSION['pass']  = $password;
	$_SESSION['sname'] = $username;
	header('Location: profile.php');
	exit();
}else{
	echo "
	<script language='javascript'>
		alert('User already exists!');
	</script>
	";
	exit();
}

?>
