<?php

include "db_info/db_credentials.php";

$username = $_POST["username"];
$firstname = $_POST["firstName"];
$lastname = $_POST["lastName"];
$email = $_POST["email"];
$country = $_POST["country"];
$imageurl = $_POST["imageURL"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "UPDATE userinfo SET firstname=\"".$firstname."\",lastname=\"".$lastname."\",email=\"".$email."\",imageURL=\"".$imageurl."\",country=\"".$country."\" WHERE username='".$username."'";
	mysqli_query($connection, $sql);
}
mysqli_close($connection);
?>