<?php

session_start();

if(!$_SESSION['uname']){
	header('Location: sign_out.php');
	exit();
}

$target_dir = "../dist/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
		echo"
		<script language='javascript'>
		alert('This is not an image!');
		</script>";
        $uploadOk = 0;
    }
}

$id = $_SESSION['uname'];
$img = $target_file;

$conn = mysqli_connect("localhost","root","");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn,"login");

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	echo "
	<script language='javascript'>
		alert(\"Sorry, only JPG, JPEG, PNG & GIF files are allowed!\");
	</script>
	";
    $uploadOk = 0;
}

// Check file size 
/*if ($_FILES["fileToUpload"]["size"] > 500000) {
	echo "
	<script language='javascript'>
		alert(\"Sorry, your file is too large!\");
	</script>
	";
    $uploadOk = 0;
}*/

if($uploadOk==0){
	header('Location: edit_profile.php');
	exit();
}else{
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

		$result = mysqli_query($conn,"UPDATE `user_detail` SET `img` = '$img' WHERE `uname` = '$id'");
		$row = mysqli_fetch_array($result);

		mysqli_close($conn);
		header('Location: edit_profile.php');
		exit();
    }else{
		echo "
		<script language='javascript'>
			alert(\"Sorry, there was an error uploading your file!\");
			location=\"edit_profile.php\";
		</script>
		";
    }
}

exit();

?>
