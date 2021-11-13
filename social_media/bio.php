<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="bio_style.css">
</head>
<body>

<br><h1>BIODATA PAGE</h1>


<script>
	function myFunction() {
		document.cookie = 'username' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		window.location = 'http://localhost/poovi/login.php';	
	}
	
</script>


<form action="bio.php" method="post">
	<p class= "a"><b>ABOUT</b> : <input type="text" name="about" placeholder="Your about.."><br></p>
</form>

<button onclick="myFunction()" id="b234">Logout</button><br><br>

<form action="delete.php" method="post">
<input type="submit" value='Delete my account' id="c1"><br><br>
</form>
<?php
$servername = "localhost";
$database = "social_media";
$username = "root";
$password = "";
$dbusername=$_COOKIE['username'];

$conn = mysqli_connect($servername, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	if(!isset($_COOKIE['username'])) {
  		header("Location: http://localhost/poovi/login.php");
		exit();
    } 
}

else if($_SERVER["REQUEST_METHOD"] == "POST") {
 	$about = $_POST["about"];
    if(empty($about)){
    	echo "<script>setTimeout(function(){ alert('Please fill your about!')}, 500);</script>";
    	return;
	}

	$query = "";
	if (aboutExists($dbusername) == TRUE) {
		$query = "update about set about='$about' where user_name='$dbusername'"; // update query
	} else {
		$query = "insert into about(about , user_name) values('$about','$dbusername')"; // insert query
	}
	execute_query($query);
}
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT about FROM about where user_name='$dbusername'";
		
if($result = mysqli_query($conn, $sql)){
	if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
				echo "<p><b>ABOUT</b> = " . $row["about"]. "<br></p>";
			}    		        
	}
}
$sql = "SELECT user_id,user_name,email,phone_number FROM instagram where user_name='$dbusername'";
if($result = mysqli_query($conn, $sql)){
	if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
    				echo "<p><b>USER_ID</b> = " . $row["user_id"]. "<br><br>" ."  <b>USER_NAME</b> = " . $row["user_name"]."<br><br>"." <b> EMAIL </b>= " . $row["email"]."<br><br>"."<b>PHONE_NUMBER</b> = " . $row["phone_number"]. "<br><br></p>" ;
			}    		        
	}
}
function aboutExists($dbusername) {
	$servername = "localhost";
	$database = "social_media";
	$username = "root";
	$password = "";

	$conn = mysqli_connect($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
    }
	$sql = "SELECT * FROM about where user_name='$dbusername'";
		
	if($result = mysqli_query($conn, $sql)){
		if(mysqli_num_rows($result) > 0){
	        return TRUE;       		        
		}
		else
	    {   
	    	return FALSE;
	    }
	} else {
		die("Query execution failed : " . $sql);
	}
}

function execute_query($query){
	$servername = "localhost";
	$database = "social_media";
	$username = "root";
	$password = "";

	$conn = mysqli_connect($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	if(mysqli_query($conn, $query)){
	echo "Records inserted successfully.";
	echo "<br>";
	}
	 else{
	echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
	}
}
?>


</body>
</html>