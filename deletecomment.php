<?php

include "db_info/db_credentials.php";

$commentid = $_POST["commentid"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "DELETE FROM comment WHERE commentid=".$commentid;
	mysqli_query($connection, $sql);
}
mysqli_close($connection);
?>