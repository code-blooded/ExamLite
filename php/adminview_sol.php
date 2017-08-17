<?php

session_start();
$exid = $_GET['exid'];
$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_select_db($conn,"login");

$result = mysqli_query($conn,"select `ques`,`ans`,`opa`,`opb`,`opc`,`opd` from `bank` where eid = '$exid'");

if(!$result){
	exit();
}
$count=1;
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
{
	$corrans=$row['ans'];
	$question=$row['ques'];
	$opta=$row['opa'];
	$optb=$row['opb'];
	$optc=$row['opc'];
	$optd=$row['opd'];
	echo $count.") ".$question."<br>";
	if($corrans=='a')
		echo " Answer: ".$corrans.") ".$opta."<br>";
	else if($corrans=='b')
		echo " Answer: ".$corrans.") ".$optb."<br>";
	else if($corrans=='c')
		echo " Answer: ".$corrans.") ".$optc."<br>";
	else if($corrans=='d')
		echo " Answer: ".$corrans.") ".$optd."<br>";
	echo "<br>";
	$count=$count+1;
}
mysqli_close($conn);
?>