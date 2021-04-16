<?php

session_start();
$_SESSION["username"] = "catlover24"; //admin
//$_SESSION["username"] = "football2005"; //user
//$_SESSION["username"] = "hacker-man72"; //banned
//$_SESSION["username"] = "dsmith72";

$_SESSION["postid"] = 1;
//$_SESSION["commentidArray"] = array(1,2,11);

include "db_info/db_credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	

	$sql = "SELECT status,imageURL FROM userinfo WHERE username='".$_SESSION["username"]."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION["status"] = $row["status"];
		$_SESSION["imageurl"] = $row["imageURL"];
		echo $_SESSION["status"];
	}
	
}

//session_unset();
?>