<?php

session_start();
$_SESSION["username"] = "catlover24"; //admin
//$_SESSION["username"] = "football2005"; //user
//$_SESSION["username"] = "hacker-man72"; //banned

include "db_info/db_credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	

	$sql = "SELECT status FROM userinfo WHERE username='".$_SESSION["username"]."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION["status"] = $row["status"];
		echo $_SESSION["status"];
	}
	
}

//session_unset();
?>