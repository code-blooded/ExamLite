<?php

session_start();

$exid = $_GET['exid'];
$uid = $_SESSION['uname'];

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,"login");

$result = mysqli_query($conn,"INSERT INTO `registered` (`userid`, `examid`) VALUES ('$uid', '$exid')");

mysqli_close($conn);

if($result){
	
	echo "
	<script language='javascript'>
		alert('You have registered!');
		location=\"profile.php\";
	</script>
	";
	exit();
}else{	
	echo "
	<script language='javascript'>
		alert('Already registered!');
	</script>
	";
	exit();
}

?>