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
<h1>Search Results</h1>
<?php

include "db_info/db_credentials.php";

$searchterm = $_POST["search-string"];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
$error = mysqli_connect_error();
if($error != null){
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}else{
	$sql = "SELECT * FROM userinfo WHERE MATCH(username,firstname,lastname,email) AGAINST ('%".$searchterm."%')";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		
		echo "<h2>User Search Results for '".$searchterm."'</h2>";
	
		echo "<table><tbody>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			if(strcmp($row["username"],"[deleted-user]")!=0){
				echo "<td>".$row["username"]."</td>";
				echo "<td>".$row["firstname"]."</td>";
				echo "<td>".$row["lastname"]."</td>";
				echo "<td>".$row["email"]."</td>";
				echo "<td><form method=\"get\" action=\"viewuser.php\"><button type=\"submit\" value=\"".$row["username"]."\" name=\"username\"/>View</button></form><button class=\"deleteuserbutton\" type=\"submit\" value=\"".$row["username"]."\" name=\"username\"/>Delete</button></td>";
				echo "</tr>";
			}
		}
		echo "</tbody></table>";
	}else{
		printf("Error: %s\n", mysqli_error($connection));
		exit();
	}
	
	$sql = "SELECT * FROM blogpost WHERE MATCH(title) AGAINST ('%".$searchterm."%')";
	$result = mysqli_query($connection, $sql);
	if ($result) {
		echo "<h2>Blogpost Search Results for '".$searchterm."'</h2>";
		echo "<table><tbody>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			
			echo "<td>";
			$authorid = $row["authorid"];
			$postsql = "SELECT username FROM userinfo WHERE authorid = ".$authorid;
			$postresult = mysqli_query($connection, $postsql);
				if ($postresult) {
					$postrow = mysqli_fetch_assoc($postresult);
					echo $postrow["username"];
				}
			mysqli_free_result($postresult);
			echo "</td>";
			
			echo "<td>".$row["title"]."</td>";
			echo "<td>".$row["date"]."</td>";

			echo "<td><input type=\"button\" value=\"View\"/><button class=\"deletebutton\" type=\"submit\" value=\"".$row["postid"]."\" name=\"username\"/>Delete</button></td>";
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
<script type="text/javascript">
	var deleteuserbutton = document.getElementsByClassName("deleteuserbutton");
	for (var i = 0; i < deleteuserbutton.length; i++){
		deleteuserbutton[i].addEventListener('click', function(){
		if (confirm("Are you sure you want to delete this user? This action cannot be undone.")) {
			var username = this.value;
			deleteuser(username);
		}
	});
	}
	function deleteuser(username){
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "deleteuser.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("username="+username);
		location.reload();
	}

	var deletebutton = document.getElementsByClassName("deletebutton");
	for (var i = 0; i < deletebutton.length; i++){
		deletebutton[i].addEventListener('click', function(){
		if (confirm("Are you sure you want to delete this Post? This action cannot be undone.")) {
			var postid = this.value;
			deletePost(postid);
		}
	});
	}
	function deletePost(postid){
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "deletepost.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("postid="+postid);
		location.reload();
	}

</script>
</article>
</div>

<footer>
<?php
	include "footer.html";
?>
</footer>

</body>
</html>
