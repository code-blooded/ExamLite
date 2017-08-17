<?php

session_start();
$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db($conn,"login");
$username = $_SESSION['uname'];
$exid = $_SESSION['exid'];
$result = mysqli_query($conn,"select `ques`,`ans`,`eid`,`qid` from `bank` where eid = '$exid'");

if(!$result){
	exit();
}

while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$checkeid=$row['eid'];
	$checkqid=$row['qid'];
	$corrans=$row['ans'];
	$question=$row['ques'];
	$rresult = mysqli_query($conn,"select `ans` from answered where eid = '$checkeid' and qid = '$checkqid'");
	$rrow = mysqli_fetch_array($rresult);
	echo $question."<br>";
	if(!$rresult)
	{
		echo "unattempted<br>";
	}
	else
	{
		echo "Attempted ans:  ".$rrow['ans']." Correct ans: ".$corrans."<br>";
	}
}
mysqli_close($conn);
?>
