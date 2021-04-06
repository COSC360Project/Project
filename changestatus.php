
<?php

include "db_info/db_credentials.php";

$username = $_POST["username"];
$status = $_POST["status"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "UPDATE userinfo SET status=".$status." WHERE username='".$username."'";
	mysqli_query($connection, $sql);
}
mysqli_close($connection);
?>

