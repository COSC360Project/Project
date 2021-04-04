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
	$sql = "SELECT authorid,username,country,imageURL,status FROM Userinfo";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<table><tbody>";
		while($row = mysqli_fetch_assoc($result)){echo "<tr>";
			echo "<td>".$row["username"]."</td>";
			echo "<td>".$row["country"]."</td>";
			echo "<td>";
			$authorid = $row["authorid"];
			$postsql = "SELECT COUNT(*) FROM blogpost WHERE authorid = ".$authorid;
			$postresult = mysqli_query($connection, $postsql);
				if ($postresult) {
					$postrow = mysqli_fetch_assoc($postresult);
					echo $postrow["COUNT(*)"];
				}
			mysqli_free_result($postresult);
			echo " Posts</td>";
			echo "<td>";
			$commentsql = "SELECT COUNT(*) FROM comment WHERE authorid = ".$authorid;
			$commentresult = mysqli_query($connection, $commentsql);
				if ($commentresult) {
					$commentrow = mysqli_fetch_assoc($commentresult);
					echo $commentrow["COUNT(*)"];
				}
			mysqli_free_result($commentresult);
			echo " Comments</td>";
			echo "<td>";
			if ($row["status"] == 1){
				echo "Administrator";
			}else if ($row["status"] == 0){
				echo "User";
			}else if ($row["status"] == -1){
				echo "Banned";
			}
			echo "</td>";
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
