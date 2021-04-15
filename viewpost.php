<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>MyBlogPost</title>
   <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<header id="masthead">
<?php
	//Display header based on if user is logged in, and their status
	include "header.php";
?>
</header>

<div id="main">
    <article id="left-sidebar">
        <h2>Browse Content by:</h2>
	    <p>Date:</p>
	    <p>Category:</p>
    </article>
    <article id="left-center">
    <h1>View Post</h1>
<?php

include "db_info/db_credentials.php";
$postid = $_GET["postid"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT * FROM blogpost WHERE postid='".$postid."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$authorid = $row["authorid"];
		$title = $row["title"];
		$content = $row["content"];
		$category = $row["category"];
		$authsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
		$authresult = mysqli_query($connection, $authsql);
		if ($authresult) {
			$authrow = mysqli_fetch_assoc($authresult);
			$username = $authrow["username"];
		}
		mysqli_free_result($authresult);
		
		echo "<h2>".$title."</h2>";
		echo "<p>Written by: ".$username."<p>";
		echo "<p>".$content."</p>";
		echo "<p>Category: ".$category."</p>";
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}

}
mysqli_close($connection);
?>
<h2>Comments: </h2>
<?php

include "db_info/db_credentials.php";
$postid = $_GET["postid"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT * FROM comment WHERE postid='".$postid."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		while($row = mysqli_fetch_assoc($result)){
			$authorid = $row["authorid"];
			$content = $row["content"];
			$date = $row["date"];
			$authsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
			$authresult = mysqli_query($connection, $authsql);
			if ($authresult) {
				$authrow = mysqli_fetch_assoc($authresult);
				$username = $authrow["username"];
			}
			mysqli_free_result($authresult);

			echo "<p>Written by: ".$username." on ".$date."<p>";
			echo "<p>".$content."</p>";
		}
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}

}
mysqli_close($connection);
?>

</article>
</div>

<footer>
<?php
	include "footer.html";
?>
</footer>

</body>
</html>
