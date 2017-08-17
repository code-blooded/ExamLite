<?php

session_start();
$choice = $_POST['aaa'];

$exid = $_GET['exid'];
$qid = $_GET['qid'];

$_SESSION['exid'] = $exid;

if($choice=="Finish"){
	header('Location: score.php');
	exit();
}
else if($choice=="Next"){
	$conn = mysqli_connect("localhost","root","");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	mysqli_select_db($conn,"login");

	$rsesult = mysqli_query($conn,"select count(*) as `asd` from `bank` where `eid` = '$exid'");
	$rsow = mysqli_fetch_assoc($rsesult);

	mysqli_close($conn);

	if (isset($_POST['ans'])){
		$ans = $_POST['ans'];
	}
	else{
		if($rsow['asd'] == $qid){
			header('Location: score.php');
			exit();
		}
		$qid = $qid+1;
		echo "
		<script language='javascript'>
		location=\"exam.php?exid=".$exid."&qid=".$qid."\";
		</script>
		";
	exit();
	}

	$uid = $_SESSION['uname'];

	$conn = mysqli_connect("localhost","root","");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	mysqli_select_db($conn,"login");

	$result = mysqli_query($conn,"INSERT INTO `answered` (`uid`, `eid`, `qid`, `ans`) VALUES ('$uid', '$exid', '$qid','$ans')");

	if($result){
		if($rsow['asd'] == $qid){
			header('Location: score.php');
			exit();
		}
		$qid = $qid+1;
		mysqli_close($conn);
		echo "
		<script language='javascript'>
		location=\"exam.php?exid=".$exid."&qid=".$qid."\";
		</script>
		";

	}
	else{

		$result = mysqli_query($conn,"UPDATE `answered` SET `ans` = '$ans' WHERE `answered`.`uid` = '$uid' AND `answered`.`qid` = '$qid' AND `answered`.`eid` = '$exid'");
		mysqli_close($conn);
		if($rsow['asd'] == $qid){
			header('Location: score.php');
			exit();
		}
		$qid = $qid+1;
		echo "
		<script language='javascript'>
		location=\"exam.php?exid=".$exid."&qid=".$qid."\";
		</script>
		";
	}
	exit();
}
else{//Previous
	if (isset($_POST['ans'])){
	$ans = $_POST['ans'];
	}else{
		if($qid>1)
			$qid = $qid-1;
		echo "Hi
		<script language='javascript'>
			location=\"exam.php?exid=".$exid."&qid=".$qid."\";
		</script>
		";
		exit();
	}
	$uid = $_SESSION['uname'];
	$conn = mysqli_connect("localhost","root","");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_select_db($conn,"login");
	$result = mysqli_query($conn,"INSERT INTO `answered` (`uid`, `eid`, `qid`, `ans`) VALUES ('$uid', '$exid', '$qid','$ans')");

	if($result){

		if($qid>1)
			$qid = $qid-1;
		mysqli_close($conn);
		echo "
		<script language='javascript'>
		location=\"exam.php?exid=".$exid."&qid=".$qid."\";
		</script>
		";

	}
	else{

		$result = mysqli_query($conn,"UPDATE `answered` SET `ans` = '$ans' WHERE `answered`.`uid` = '$uid' AND `answered`.`qid` = '$qid' AND `answered`.`eid` = '$exid'");

		mysqli_close($conn);

		if($qid>1)
			$qid = $qid-1;
		echo "
		<script language='javascript'>
			location=\"exam.php?exid=".$exid."&qid=".$qid."\";
		</script>
		";
	}
	exit();
}

?>
