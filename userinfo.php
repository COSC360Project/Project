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
<article id="right-sidebar">
<table>
	<tbody>
		<tr><td><a href="userinfo.php">User Profile</a></td></tr>
		<tr><td><a href="userinfoedit.php">Edit User Information</a></td></tr>
		<tr><td><a href="changepassword.php">Change Password</a></td></tr>
		<tr><td><a href="userinfomanageposts.php">Manage Posts</a></td></tr>
		<tr><td><a href="userinfodelete.php">Delete User</a></td></tr>
	</tbody>
</table>
</article>
<article id="center">
<h1>User Profile</h1>
<?php

include "db_info/db_credentials.php";
$username = $_SESSION["username"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT * FROM userinfo WHERE username='".$username."'";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		
		$row = mysqli_fetch_assoc($result);
		echo "<img class=\"resize\" src='".$row["imageURL"]."'/>";
		echo "<table id = \"userinfo\"><tbody>";
		echo "<tr><td>Author ID:</td><td>".$row["authorid"]."</td></tr>";
		echo "<tr><td>Username:</td><td>".$row["username"]."</td></tr>";
		echo "<tr><td>First Name:</td><td>".$row["firstname"]."</td></tr>";
		echo "<tr><td>Last Name:</td><td>".$row["lastname"]."</td></tr>";
		echo "<tr><td>Email:</td><td>".$row["email"]."</td></tr>";
		echo "<tr><td>Country:</td><td>".$row["country"]."</td></tr>";
		echo "<tr><td>Member Since:</td><td>".$row["joindate"]."</td></tr>";
		echo "</tbody></table>";
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
