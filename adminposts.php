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
		<tr><td><a href="adminsite.php">Manage Site</a></td></tr>
		<tr><td><a href="adminusers.php">Manage Users</a></td></tr>
		<tr><td><a href="adminposts.php">Manage Posts</a></td></tr>
		<tr><td><a href="admincomments.php">Manage Comments</a></td></tr>
	</tbody>
</table>
</article>
<article id="center">
<h1>Manage Posts</h1>
<?php

include "db_info/db_credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT postid,authorid,title,date,category FROM blogpost";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<table><tbody>";
		while($row = mysqli_fetch_assoc($result)){echo "<tr>";
			echo "<td>".$row["title"]."</td>";
			echo "<td>";
			$authorid = $row["authorid"];
			$authorsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
			$authorresult = mysqli_query($connection, $authorsql);
				if ($authorresult) {
					$authorrow = mysqli_fetch_assoc($authorresult);
					echo $authorrow["username"];
				}
			mysqli_free_result($authorresult);
			echo "</td>";
			echo "<td>".$row["date"]."</td>";
			echo "<td>".$row["category"]."</td>";
			echo "<td><input type=\"button\" value=\"View\"/><input type=\"button\" value=\"Delete\"/></td>";
			
			echo "</tr>";
		}
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
