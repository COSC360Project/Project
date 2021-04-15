
<?php
session_start();
include "db_info/db_credentials.php";

$username = $_SESSION["username"];
$postid = $_POST["postid"];
$comment = $_POST["content"];
$date = date("Y-m-d");

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT authorid FROM userinfo WHERE username='".$username."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$authorid = $row["authorid"];
	}	
}

if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "INSERT INTO comment(postid,authorid,content,date) VALUES ('".$postid."','".$authorid."','".$comment."','".$date."')";
	mysqli_query($connection, $sql);
}
mysqli_close($connection);
?>