<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$servername = "localhost";
	$database = "social_media";
	$username = "root";
	$password = "";
	$dbusername=$_COOKIE['username'];
	$conn = mysqli_connect($servername, $username, $password, $database);

	if($conn === false){
	    die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$sql = "DELETE FROM instagram WHERE user_name='$dbusername'";
	if(mysqli_query($conn, $sql)){
	    echo "Records were deleted successfully.";
	    setcookie('username',$dbusername,time()-36000,"/");
	    header("Location: http://localhost/poovi/login.php");
	    exit();
	} else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
	 
	// Close connection
	mysqli_close($conn);
}



?>