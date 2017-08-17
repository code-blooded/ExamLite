<?php

session_start();
$exid = $_GET['exid'];

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db($conn,"login");

$result1 = mysqli_query($conn,"select distinct `uid` from `answered` where eid= '$exid'");
if(mysqli_num_rows($result1) > 0 ){
	echo "<p>Username&nbsp;&nbsp;&nbsp;&nbsp;Score&nbsp;&nbsp;<br>";
while ($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC))
{
$username=$row1['uid'];
$result = mysqli_query($conn,"select `eid`,`qid`,`ans` from `answered` where uid='$username' and eid= '$exid'");
$sum=0;
if(mysqli_num_rows($result) > 0 ){

while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$checkeid=$row['eid'];
	$checkqid=$row['qid'];
	$checkans=$row['ans'];
	$rresult = mysqli_query($conn,"select `ans`,`mark` from bank where eid = '$checkeid' and qid = '$checkqid'");
	$rows = mysqli_fetch_array($rresult);
	if($rows['ans']==$checkans)
	{
		$sum=$sum+$rows['mark'];
	}
}
echo "&nbsp;".$username."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sum."<br><br>";
}
}
}
mysqli_close($conn);
?>
