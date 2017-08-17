<?php

session_start();

$exid = $_GET['exid'];
$qid= $_POST['eques'];

echo "$exid";
echo "$qid";

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,"login");

$result = mysqli_query($conn,"DELETE FROM `bank` WHERE `bank`.`eid` = $exid and `bank`.`qid` = $qid");

mysqli_close($conn);

if($result){	
	echo "
	deleted successfully
	";
}else{	
	echo "
	deletion unsuccessful
	";
}

header("Location: adminprofile.php");
exit();

?>