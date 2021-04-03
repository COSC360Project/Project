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
		<tr><td><a href="adminsite.php">Manage Site</a></td></tr>
		<tr><td><a href="adminusers.php">Manage Users</a></td></tr>
		<tr><td><a href="adminposts.php">Manage Posts</a></td></tr>
		<tr><td><a href="admincomments.php">Manage Comments</a></td></tr>
	</tbody>
</table>
</article>
<article id="center">
<h1>Manage Users</h1>

<?php

include "db_info/db_credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	
	$sql = "SELECT username,
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(($_POST["username"] != "")){
			$username = $_POST["username"];
			$sql = "SELECT username,firstName,lastName,email FROM users WHERE username='".$username."'";
			$result = mysqli_query($connection, $sql);
			if ($result) {
				$row = mysqli_fetch_assoc($result);
				if (strcmp($row["username"],$username) ==0){
					echo "<fieldset><legend>User: ".$username."</legend>";
					echo "<table>";
					echo "<tr><td>First Name:</td><td>".$row["firstName"]."</td></tr>";
					echo "<tr><td>Last Name:</td><td>".$row["lastName"]."</td></tr>";
					echo "<tr><td>Email:</td><td>".$row["email"]."</td></tr>";
					echo "</table></fieldset>";
				}else{
					echo "<p>The user does not exist!</p>";
				}	
			}else{
				printf("Error: %s\n", mysqli_error($connection));
				exit();
			}
		}else{
			echo "Error! Fields not set!";
		}
	}else{
		echo "Error! Bad GET request!";
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
