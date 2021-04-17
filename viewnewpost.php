<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang = "en">
    <meta charset = "utf-8">
    <title>MyBlogPost</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header id="masthead">
        <?php include "header.php";?>
    </header>
</div>


<div id="main">
    <article id="left-sidebar">
	<h2>Browse Content by:</h2>
<?php
	include "rightsidebar.php";
?>
    </article>
    <article id="left-center">
    <h1>View Post</h1>
<?php

include "db_info/db_credentials.php";
$username = $_SESSION["username"];
$title = $_POST["title"];
$content = $_POST["comment"];
$category = $_POST["category"];
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
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}

}
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "INSERT INTO blogpost(authorid,title,content,date,category) VALUES ('".$authorid."','".$title."','".$content."','".$date."','".$category."')";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<p> Post Creation Successful</p>";
		echo "<h2>".$title."</h2>";
		echo "<p>Written by: ".$username."</p>";
		echo "<p>".$content."</p>";
		echo "<p>Category: ".$category."</p>";
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
}
mysqli_close($connection);

?>

<div id="commentsection">
<h2>Comments: </h2>
<div id="comments">
</div>
<?php
if(isset($_SESSION["username"]) && $_SESSION["status"] != -1){
	echo "<h2>Write a Comment: </h2>";
	echo "<textarea id=\"comment\" placeholder=\"Leave a comment\"></textarea>";
	echo "<button type=\"button\" value=\"commentcontent\" id=\"submitbutton\"/>Submit</button>";
	echo "</div>";
}
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