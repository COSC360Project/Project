<?php

include "db_info/db_credentials.php";

$postid = $_POST["postid"];
$title = $_POST["title"];
$content = $_POST["content"];
$category = $_POST["category"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "UPDATE blogpost SET title=\"".$title."\",content=\"".$content."\",category=\"".$category."\" WHERE postid=\"".$postid."\"";
	mysqli_query($connection, $sql);
}
mysqli_close($connection);
?>