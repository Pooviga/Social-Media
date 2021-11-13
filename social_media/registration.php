<html>
<head>
<link rel="stylesheet" href="reg_style.css">
</head>
<body>
	<h1><br><br><br>REGISTRATION PAGE</h1><br>
	<form action="registration.php" method="post">
	<p class="a"> <input type="text" name="username" placeholder="Username.."><br><br><br>
	<input type="text" name="password" placeholder="Set Password.."><br><br><br>
    <input type="text" name="email" placeholder="Email id.."><br><br><br>
    <input type="text" name="phonenumber" placeholder="Phone Number.."><br><br></p>
    <input type="submit" value="Register" id="a23"><br><br>

    </form>

    <script >
	function gobacktologinpage() {
			window.location = 'http://localhost/poovi/login.php'; 		
	}

</script>
<button onclick="gobacktologinpage()" id="a23">Login page</button><br>
<?php
 if ($_SERVER["REQUEST_METHOD"] == "GET"){


 }
 else if($_SERVER["REQUEST_METHOD"] == "POST"){
 	$dbusername = $_POST["username"];
 	$dbpassword = $_POST["password"];
 	$dbemail = $_POST["email"];
 	$dbphonenumber = $_POST["phonenumber"];
 	
    if (empty($dbusername)||empty($dbpassword)||empty($dbemail)||empty($dbphonenumber)) {
    	echo "Please fill the details correctly";
    	return;
	}
	$servername = "localhost";
	$database = "social_media";
	$username = "root";
	$password = "";
	$conn = mysqli_connect($servername, $username, $password, $database);

	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	$sql = "insert into instagram(user_name , password ,email ,phone_number)values('$dbusername','$dbpassword','$dbemail','$dbphonenumber')";

	if(mysqli_query($conn, $sql)){
    echo "Records inserted successfully.";
	} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
	mysqli_close($conn);
	}


function register($dbusername,$dbpassword,$dbemail,$dbphonenumber){
}




 ?>
</body>
</html>
