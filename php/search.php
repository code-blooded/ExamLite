<?php

session_start();

if(!$_SESSION['uname']){
	header('Location: sign_out.php');
	exit();
}

$username = $_GET['query'];
$is = $_SESSION['is'];

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,"login");

$result = mysqli_query($conn,"select * from `user` where username = '$username'");
$row = mysqli_fetch_array($result);

mysqli_close($conn);

if($row['username'] == $username){
	$_SESSION['sname'] = $username;
	if($is==0)
		header('Location: profile.php');
	else
		header('Location: adminprofile.php');
	exit();
}else{
	echo "
	<script language='javascript'>
		alert('Search failed!');
		if(".$is."==0)
			location=\"profile.php\";
		else
			location=\"adminprofile.php\";
	</script>
	";
}

?>