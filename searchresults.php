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
<?php
	include "rightsidebar.php";
?>
    </article>
    <article id="left-center">
    <h1>Search Results</h1>
<?php
include "db_info/db_credentials.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	if(isset($_GET["date"])){
		$date = $_GET["date"];
		$sql = "SELECT * FROM blogpost WHERE date LIKE '".$date."%'";
		$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "<table><tbody>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>".$row["title"]."</td>";
				echo "<td>";
				$authorid = $row["authorid"];
				$commentsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
				$commentresult = mysqli_query($connection, $commentsql);
				if ($commentresult) {
						$commentrow = mysqli_fetch_assoc($commentresult);
						echo $commentrow["username"];
				}
				mysqli_free_result($commentresult);
				echo "</td>";
				echo "<td>".$row["date"]."</td>";
				echo "<td>".$row["category"]."</td>";
				echo "<td><form method=\"get\" action=\"viewpost.php\"><button class=\"viewbutton\" type=\"submit\" formmethod=\"get\" value=\"".$row["postid"]."\" name=\"postid\"/>View</button></form></td>";
				
				echo "</tr>";
			}
			echo "</tbody></table>";
		}else{
			printf("Error: %s\n", mysqli_error($connection));
			exit();
		}
		
	}else if(isset($_GET["category"])){
		$cat = $_GET["category"];
		$sql = "SELECT * FROM blogpost WHERE category LIKE '".$cat."%'";
		$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "<table><tbody>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>".$row["title"]."</td>";
				echo "<td>";
				$authorid = $row["authorid"];
				$commentsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
				$commentresult = mysqli_query($connection, $commentsql);
				if ($commentresult) {
						$commentrow = mysqli_fetch_assoc($commentresult);
						echo $commentrow["username"];
				}
				mysqli_free_result($commentresult);
				echo "</td>";
				echo "<td>".$row["date"]."</td>";
				echo "<td>".$row["category"]."</td>";
				echo "<td><form method=\"get\" action=\"viewpost.php\"><button class=\"viewbutton\" type=\"submit\" formmethod=\"get\" value=\"".$row["postid"]."\" name=\"postid\"/>View</button></form></td>";
				
				echo "</tr>";
			}
			echo "</tbody></table>";
		}else{
			printf("Error: %s\n", mysqli_error($connection));
			exit();
		}
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
