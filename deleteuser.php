<?php

include "db_info/db_credentials.php";

$username = $_POST["username"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "UPDATE userinfo SET username=\"[deleted-user]\",password=\"00000\",firstname=\"\",lastname=\"\",email=\"\",imageURL=\"\",status=0,joindate=\"0000-00-00\" WHERE username='".$username."'";
	mysqli_query($connection, $sql);
}
mysqli_close($connection);
?>

