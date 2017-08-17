<?php

session_start();

//get username and password
$username = $_POST['user'];
$password = $_POST['pass'];

$username = str_replace(")", ")/", $username);
$password = str_replace(")", ")/", $password);
$username = str_replace(";", ";/", $username);
$password = str_replace(";", ";/", $password);

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,"login");

$result = mysqli_query($conn,"select * from isadmin where username = '$username' and password = '$password'");
$row = mysqli_fetch_array($result);

mysqli_close($conn);

if($row['username'] == $username && $row['password'] == $password){
	$_SESSION['uname'] = $username;
	$_SESSION['pass']  = $password;
	$_SESSION['sname'] = $username;
	$_SESSION['is'] = 1;
	header('Location: adminprofile.php');
	exit();
}else{
	echo "
	<script language='javascript'>
		alert('Sorry try again!!');
		location=\"../html/admin_login.html\";
	</script>";
}

?>