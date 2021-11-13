<!DOCTYPE HTML>
<html> 
<head>
<link rel="stylesheet" href="mystyle.css">
</head>

<body>
<h1><br><br>LOGIN PAGE</h1>
</body>
<body>
<form action="login.php" method="post">
	<br><p class= "a"><b>USER_NAME</b>:<br><br> <input type="text" name="username" placeholder="Your name.." ><br><br></p>
	<p class="a"><b>PASSWORD</b> :<br><br> <input type="text" name="password" placeholder="Your password.."><br><br></p>
<input type="submit" value="Login"><br><br><br>
<p4 style="font-size:20px"><b>If you haven't registered please register.</b></p4><br><br>
</form>
<script >
	function go_to_register() {
			window.location = 'http://localhost/poovi/registration.php'; 		
	}

</script>
<button onclick="go_to_register()" id="a234">Register</button>
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET"){

}
else if($_SERVER["REQUEST_METHOD"] == "POST") {
 	$dbusername = $_POST["username"];
 	$dbpassword = $_POST["password"];
    if (empty($dbusername)||empty($dbpassword)) {
    	echo "<script>setTimeout(function(){ alert('Please fill your username and password') }, 500);</script>";
    	return;
	}

	$authenticated=authenticate($dbusername,$dbpassword);

	if($authenticated==TRUE){
		setcookie('username',$dbusername,time()+(604800*4),"/");
		header("Location: http://localhost/poovi/bio.php");
		exit();

	}
	else{
		echo "<script>setTimeout(function(){alert('Your username and Password is wrong ')},500);</script>";
	}
}

function authenticate($dbusername,$dbpassword){
	$servername = "localhost";
	$database = "social_media";
	$username = "root";
	$password = "";
	$conn = mysqli_connect($servername, $username, $password, $database);

	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
		mysqli_close($conn);
		return FALSE;
	}
	$sql = "SELECT * FROM instagram where user_name='$dbusername' and password='$dbpassword'";
	//SELECT column_name(s) FROM table_name WHERE column_name operator value
	if($result = mysqli_query($conn, $sql)){
	    if(mysqli_num_rows($result) > 0){
	    	mysqli_close($conn);
	        return TRUE;
	            		        
	    } 
	    else
	    {   
	    	mysqli_close($conn);
	    	return FALSE;
	    }
	} 
	else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	    mysqli_close($conn);
	    return FALSE;
	}
		 
}

				
 ?>
</body>
</html>