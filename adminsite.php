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
<h1>Manage Site</h1>
<?php

include "db_info/db_credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	echo "<table><tbody>";
	$sql = "SELECT COUNT(*) FROM blogpost";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<tr><td>";
		$row = mysqli_fetch_assoc($result);
		echo $row["COUNT(*)"];
		mysqli_free_result($result);
		echo " Posts</td>";
		echo "</tr>";
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
	$sql = "SELECT COUNT(*) FROM comment";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<tr><td>";
		$row = mysqli_fetch_assoc($result);
		echo $row["COUNT(*)"];
		mysqli_free_result($result);
		echo " Comments</td>";
		echo "</tr>";
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
	$sql = "SELECT COUNT(*) FROM userinfo";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<tr><td>";
		$row = mysqli_fetch_assoc($result);
		echo $row["COUNT(*)"];
		mysqli_free_result($result);
		echo " Users from ";
		$countrysql = "SELECT COUNT(DISTINCT country) FROM userinfo";
		$countryresult = mysqli_query($connection, $countrysql);
		if ($countryresult) {
			$countryrow = mysqli_fetch_assoc($countryresult);
			echo $countryrow["COUNT(DISTINCT country)"];
			mysqli_free_result($countryresult);
			echo " Countries</td>";
			echo "</tr>";
		}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
		echo "</tr>";
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
	echo "<td><input type=\"button\" value=\"Restore\"/><input type=\"button\" value=\"Delete\"/></td>";
	echo "</tbody></table>";

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
